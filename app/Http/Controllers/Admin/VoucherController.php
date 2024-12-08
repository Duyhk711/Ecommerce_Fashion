<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use App\Models\User;
use App\Models\Voucher;
use App\Notifications\NewVoucherNotification;
use App\Services\VoucherService;

class VoucherController extends Controller
{
    protected $voucherService;

    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
        $this->middleware('permission:xem danh sách khuyến mãi|Kích hoạt khuyến mại|Xóa khuyến mại|Chỉnh sửa khuyến mại|Thêm mới khuyến mại', ['only' => ['index']]);
        $this->middleware('permission:Xóa khuyến mại', ['only' => ['destroy']]);
        $this->middleware('permission:Chỉnh sửa khuyến mại', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Thêm mới khuyến mại', ['only' => ['create', 'store']]);
    }

    public function index()
    {
        $vouchers = $this->voucherService->getAllVouchers();

        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(VoucherRequest $request)
    {
        try {
            $data = $request->validated();
            $data['usage_limit'] = $data['usage_limit'] ?? null;
            if (Voucher::where('code', $data['code'])->exists()) {
                return redirect()
                    ->back()
                    ->withErrors(['code' => 'Mã giảm giá này đã tồn tại.'])
                    ->withInput();
            }
            if (
                isset($data['minimum_order_value']) &&
                $data['discount_value'] > $data['minimum_order_value']
            ) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'discount_value' => 'Giá trị giảm không thể lớn hơn giá trị đơn hàng tối thiểu.',
                    ])
                    ->withInput();
            }
            if (
                $data['discount_type'] === 'percentage' &&
                $data['discount_value'] > 20
            ) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'discount_value' => 'Giảm giá phần trăm tối đa là 20%.',
                    ])
                    ->withInput();
            }
            if (strtotime($data['end_date']) < strtotime($data['start_date'])) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'end_date' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
                    ])
                    ->withInput();
            }

            $voucher = $this->voucherService->storeVoucher($data);
            $this->voucherService->sendNewVoucherNotification($voucher);

            $users = User::all(); // Hoặc filter user theo tiêu chí cụ thể
            $message = "Mã giảm giá mới <strong>{$voucher->code}</strong> giảm {$voucher->discount_value}";
            if ($voucher->discount_type == 'fixed') {
                $message .= "K cho đơn hàng từ {$voucher->minimum_order_value}K! Click để nhận ngay ưu đãi!!";
            } elseif ($voucher->discount_type == 'percentage') {
                $message .= "% cho đơn hàng từ {$voucher->minimum_order_value}K! Click để nhận ngay ưu đãi!!";
            }
            $title = "Bạn đã nhận được voucher mới";
            foreach ($users as $user) {
                $user->notify(new NewVoucherNotification($voucher, $message, $title));
            }

            return redirect()
                ->route('admin.vouchers.index')
                ->with('success', 'Voucher mới đã được tạo thành công.');
        } catch (\Exception $e) {
            // Log::error('Error sending notification: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withErrors(['general' => 'Có lỗi xảy ra. Vui lòng thử lại sau.'])
                ->withInput();
        }
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(VoucherRequest $request, Voucher $voucher)
    {
        $this->voucherService->updateVoucher($voucher, $request->validated());
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        // Lấy voucher từ cơ sở dữ liệu
        $voucher = Voucher::find($id);

        // Kiểm tra xem voucher có tồn tại hay không
        if ($voucher) {
            $this->voucherService->deleteVoucher($voucher); // Gọi phương thức xóa mềm
            return redirect()->route('admin.vouchers.index')->with('success', 'Voucher đã được xóa thành công!');
        } else {
            return redirect()->route('admin.vouchers.index')->with('error', 'Voucher không tồn tại.');
        }
    }
    public function toggleActive(Voucher $voucher)
    {
        $this->voucherService->toggleActiveStatus($voucher);
        return redirect()->route('admin.vouchers.index')->with('success', 'Trạng thái voucher đã được cập nhật.');
    }

    public function toggleDeactive(Voucher $voucher)
    {
        $this->voucherService->toggleDeactiveStatus($voucher);
        return redirect()->route('admin.vouchers.index')->with('success', 'Trạng thái voucher đã được cập nhật.');
    }
}
