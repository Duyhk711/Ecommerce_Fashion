<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
        $this->middleware('permission:Kích hoạt banner|Xóa banner|Chỉnh sửa banner|Thêm mới banner|xem danh sách banner', ['only' => ['index']]);
        $this->middleware('permission:Xóa banner', ['only' => ['destroy']]);
        $this->middleware('permission:Chỉnh sửa banner', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Thêm mới banner', ['only' => ['create', 'store']]);
    }

    public function index()
    {
        $banners = Banner::with('images')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(BannerRequest $request)
    {
        // dd($request->all());
        $this->bannerService->storeBanner($request->all());

        return redirect()->route('admin.banners.index')->with('success', 'Banner được tạo mới thành công');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $message = $this->bannerService->update($request, $id);
        return redirect()->route('admin.banners.index')->with('success', $message);
    }

    public function destroy(Banner $banner)
    {
        $this->bannerService->deleteBanner($banner);

        return redirect()->route('admin.banners.index')->with('success', 'Banner được xóa thành công');
    }
    public function activate(Banner $banner)
    {
        if ($banner->type == 'main') {
            Banner::where('type', 'main')->update(['is_active' => false]);
        } else if ($banner->type == 'sub') {
            Banner::where('type', 'sub')->where('position', $banner->position)->update(['is_active' => false]);
        }

        $banner->is_active = true;
        $banner->save();

        return redirect()->route('admin.banners.index')->with('success', 'Banner được kích hoạt thành công');
    }
}
