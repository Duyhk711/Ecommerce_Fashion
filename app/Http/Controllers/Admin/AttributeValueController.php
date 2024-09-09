<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Services\AttributeValueService;

class AttributeValueController extends Controller
{
    protected $attributeValueService;

    const PATH_VIEW = 'admin.attribute_values.';

    public function __construct(AttributeValueService $attributeValueService)
    {
        $this->attributeValueService = $attributeValueService;
    }

    public function index()
    {
        $attributeValues = $this->attributeValueService->getAllAttributeValues();
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributeValues'));
    }

    public function create()
    {
        $attributes = Attribute::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributes'));
    }

    public function store(AttributeValueRequest $request)
    {
        $this->attributeValueService->createAttributeValues($request->validated());
        // dd($request);
        return redirect()->route('admin.attribute_values.index')->with('success', 'Các giá trị thuộc tính đã được tạo thành công.');
    }

    public function edit(AttributeValue $attributeValue)
    {
        $attributes = Attribute::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributeValue', 'attributes'));
    }

    public function update(AttributeValueRequest $request, AttributeValue $attributeValue)
    {
        $this->attributeValueService->updateAttributeValue($attributeValue, $request->validated());
        return redirect()->route('admin.attribute_values.index')->with('success', 'Cập nhật giá trị thuộc tính thành công.');
    }

    public function destroy(AttributeValue $attributeValue)
    {
        $this->attributeValueService->deleteAttributeValue($attributeValue);
        return redirect()->route('admin.attribute_values.index')->with('success', 'Xóa giá trị thuộc tính thành công.');
    }
}
