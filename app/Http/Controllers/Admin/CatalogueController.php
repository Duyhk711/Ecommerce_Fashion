<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogueRequest;
use App\Models\Catalogue;
use App\Services\CatalogueService;
use Illuminate\Support\Facades\Storage;

class CatalogueController extends Controller
{
    protected $catalogueService;

    const PATH_VIEW = 'admin.catalogues.';

    public function __construct(CatalogueService $catalogueService)
    {
        $this->catalogueService = $catalogueService;

        $this->middleware('permission:xem danh sách danh mục|Xóa danh mục|Chỉnh sửa danh mục|Thêm mới danh mục|Kích hoạt danh mục', ['only' => ['index']]);
        $this->middleware('permission:Xóa danh mục', ['only' => ['destroy']]);
        $this->middleware('permission:Chỉnh sửa danh mục', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Thêm mới danh mục', ['only' => ['create', 'store']]);
    }

    public function index()
    {
        $catalogues = $this->catalogueService->getAllCatalogues();
        return view(Self::PATH_VIEW . __FUNCTION__, compact('catalogues'));
    }

    public function create()
    {
        $parentCatalogues = $this->catalogueService->getAllCatalogues()
            ->whereNull('parent_id')
            ->pluck('name', 'id');

        return view(Self::PATH_VIEW . 'create', compact('parentCatalogues'));
    }

    public function store(CatalogueRequest $request)
    {
        // Handle image upload
        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('catalogue_covers', 'public');
        }

        // Add the cover path to validated data
        $validatedData = $request->validated();
        $validatedData['cover'] = $coverPath;

        $this->catalogueService->storeCatalogue($validatedData);

        return redirect()->route('admin.catalogues.index')->with('success', 'Danh mục đã được tạo thành công.');
    }

    public function edit(Catalogue $catalogue)
    {
        $parentCatalogues = $this->catalogueService->getAllCatalogues()->whereNull('parent_id')->pluck('name', 'id');
        return view(Self::PATH_VIEW . __FUNCTION__, compact('catalogue', 'parentCatalogues'));
    }

    public function update(CatalogueRequest $request, Catalogue $catalogue)
    {
        // Xử lý việc tải ảnh bìa nếu có
        if ($request->hasFile('cover')) {
            // Xóa ảnh bìa cũ nếu có
            if ($catalogue->cover && Storage::disk('public')->exists($catalogue->cover)) {
                Storage::disk('public')->delete($catalogue->cover);
            }

            // Tải ảnh bìa mới lên
            $coverPath = $request->file('cover')->store('catalogue_covers', 'public');
            $request->merge(['cover' => $coverPath]);
        }

        // Cập nhật danh mục với dữ liệu từ request
        $this->catalogueService->updateCatalogue($catalogue, $request->validated());

        return redirect()->route('admin.catalogues.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    public function destroy(Catalogue $catalogue)
    {
        // Delete cover image if exists
        if ($catalogue->cover && Storage::disk('public')->exists($catalogue->cover)) {
            Storage::disk('public')->delete($catalogue->cover);
        }

        $this->catalogueService->deleteCatalogue($catalogue);
        return redirect()->route('admin.catalogues.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
    public function activate(Catalogue $catalogue)
    {

        // Kích hoạt danh mục hiện tại
        $catalogue->is_active = true;
        $catalogue->save();

        return redirect()->route('admin.catalogues.index')
            ->with('success', 'Danh mục đã được kích hoạt thành công');
    }
    public function deactivate(Catalogue $catalogue)
    {
        if (!$catalogue->parent_id) {
            // $childrens = $this->catalogueService->getAllCatalogues()->where('parend_id', $catalogue->id);

            Catalogue::where('parent_id', $catalogue->id)->update(['is_active' => false]);
        }

        // Kích hoạt danh mục hiện tại
        $catalogue->is_active = false;
        $catalogue->save();

        return redirect()->route('admin.catalogues.index')
            ->with('success', 'Danh mục đã bỏ kích hoạt thành công');
    }
}
