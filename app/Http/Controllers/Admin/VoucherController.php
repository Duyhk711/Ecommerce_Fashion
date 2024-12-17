<?php

namespace App\Http\Controllers\Admin;

use App\Events\CreateNewVoucherNotify;
use App\Models\User;
use App\Models\Voucher;
use App\Services\VoucherService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use App\Notifications\CreateNewVoucherAdmin;
use App\Notifications\NewVoucherNotification;

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
                $data['discount_value'] >= $data['minimum_order_value']
            ) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'discount_value' => 'Giá trị giảm không thể lớn hơn hoặc bằng giá trị đơn hàng tối thiểu.',
                    ])
                    ->withInput();
            }
            if (
                $data['discount_type'] === 'percentage' &&
                $data['discount_value'] > 100
            ) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'discount_value' => 'Giảm giá phần trăm tối đa là 100%.',
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
            broadcast(new CreateNewVoucherNotify($voucher))->toOthers();

            $users = User::all(); // Hoặc filter user theo tiêu chí cụ thể
            $message = "Mã giảm giá mới <strong>{$voucher->code}</strong> giảm ";
            if ($voucher->discount_type == 'fixed') {
                $discountValue = number_format($voucher->discount_value * 1000, 0, '.', '.');
                $minimumOrderValue = number_format($voucher->minimum_order_value * 1000, 0, '.', '.');

                $message .= "{$discountValue}₫ cho đơn hàng từ {$minimumOrderValue}₫! Click để nhận ngay ưu đãi!!";
            } elseif ($voucher->discount_type == 'percentage') {
                $minimumOrderValue = number_format($voucher->minimum_order_value * 1000, 0, '.', '.');

                $message .= "{$voucher->discount_value}% cho đơn hàng từ {$minimumOrderValue}₫! Click để nhận ngay ưu đãi!!";
            }
            $title = "Bạn đã nhận được voucher mới";
            foreach ($users as $user) {
                $user->notify(new NewVoucherNotification($voucher, $message, $title));
                $user->notify(new CreateNewVoucherAdmin($voucher, "Có mã giảm giá mới!", $title));
            }
            return redirect()
                ->route('admin.vouchers.index')
                ->with('success', 'Voucher mới đã được tạo thành công.');
        } catch (\Exception $e) {
            Log::debug('Exception occurred: ' . $e->getMessage());
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
        try {
            // Lấy dữ liệu đã validate
            $data = $request->validated();

            // Kiểm tra điều kiện bổ sung nếu cần
            if (
                isset($data['minimum_order_value']) &&
                $data['discount_value'] >= $data['minimum_order_value']
            ) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'discount_value' => 'Giá trị giảm không thể lớn hơn hoặc bằng giá trị đơn hàng tối thiểu.',
                    ])
                    ->withInput();
            }

            if (
                $data['discount_type'] === 'percentage' &&
                $data['discount_value'] > 100
            ) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'discount_value' => 'Giảm giá phần trăm tối đa là 100%.',
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

            // Gọi service để xử lý cập nhật voucher
            $this->voucherService->updateVoucher($voucher, $data);

            // Chuyển hướng với thông báo thành công
            return redirect()->route('admin.vouchers.index')->with('success', 'Voucher đã được cập nhật thành công.');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật voucher: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withErrors(['general' => 'Có lỗi xảy ra. Vui lòng thử lại sau.'])
                ->withInput();
        }
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
