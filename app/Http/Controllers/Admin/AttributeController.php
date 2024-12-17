<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Services\AttributeService;

class AttributeController extends Controller
{
    protected $attributeService;

    const PATH_VIEW = 'admin.attributes.';

    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
        $this->middleware('permission:xem danh sách thuộc tính|Thêm mới thuộc tính', ['only' => ['index']]);
        $this->middleware('permission:Thêm mới thuộc tính', ['only' => ['create', 'store']]);
    }

    public function index()
    {
        $attributes = $this->attributeService->getAllAttributes();
        return view(Self::PATH_VIEW . __FUNCTION__, compact('attributes'));
    }

    public function create()
    {
        return view(Self::PATH_VIEW . __FUNCTION__);
    }

    public function store(AttributeRequest $request)
    {
        $this->attributeService->storeAttribute($request->validated());
        return redirect()->route('admin.attributes.index')->with('success', 'Tạo thuộc tính thành công.');
    }

    public function show(Attribute $attribute)
    {
        return view(Self::PATH_VIEW . __FUNCTION__, compact('attribute'));
    }

    public function edit(Attribute $attribute)
    {
        return view(Self::PATH_VIEW . __FUNCTION__, compact('attribute'));
    }

    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $this->attributeService->updateAttribute($attribute, $request->validated());
        return redirect()->route('admin.attributes.index')->with('success', 'Cập nhật thuộc tính thành công.');
    }

    public function destroy(Attribute $attribute)
    {
        $this->attributeService->deleteAttribute($attribute);
        return redirect()->route('admin.attributes.index')->with('success', 'Xóa thuộc tính thành công.');
    }
}
