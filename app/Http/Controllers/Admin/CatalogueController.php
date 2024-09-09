<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogueRequest;
use App\Models\Catalogue;
use App\Services\CatalogueService;
use Illuminate\Support\Str;

class CatalogueController extends Controller
{
    protected $catalogueService;

    const PATH_VIEW = 'admin.catalogues.';

    public function __construct(CatalogueService $catalogueService)
    {
        $this->catalogueService = $catalogueService;
    }

    public function index()
    {
        $catalogues = $this->catalogueService->getAllCatalogues();
        return view(Self::PATH_VIEW . __FUNCTION__, compact('catalogues'));
    }

    public function create()
    {
        $parentCatalogues = $this->catalogueService->getAllCatalogues()->whereNull('parent_id')->pluck('name', 'id');
        return view(Self::PATH_VIEW . __FUNCTION__, compact('parentCatalogues'));
    }

    public function store(CatalogueRequest $request)
    {
        $this->catalogueService->storeCatalogue($request->validated());
        return redirect()->route('admin.catalogues.index')->with('success', 'Danh mục đã được tạo thành công.');
    }

    public function edit(Catalogue $catalogue)
    {
        $parentCatalogues = $this->catalogueService->getAllCatalogues()->whereNull('parent_id')->pluck('name', 'id');
        return view(Self::PATH_VIEW . __FUNCTION__, compact('catalogue', 'parentCatalogues'));
    }

    public function update(CatalogueRequest $request, Catalogue $catalogue)
    {
        $this->catalogueService->updateCatalogue($catalogue, $request->validated());
        return redirect()->route('admin.catalogues.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    public function destroy(Catalogue $catalogue)
    {
        $this->catalogueService->deleteCatalogue($catalogue);
        return redirect()->route('admin.catalogues.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
