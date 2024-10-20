<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use App\Models\Voucher;
use App\Services\VoucherService;

use Illuminate\Http\Request;

class VoucherController extends Controller
{
    protected $voucherService;

    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
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
        $this->voucherService->storeVoucher($request->validated());
        return redirect()->route('admin.vouchers.create')->with('success', 'Voucher mới đã được tạo thành công.');
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
}
