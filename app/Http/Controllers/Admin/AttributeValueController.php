<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Services\AttributeValueService;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    protected $attributeValueService;

    const PATH_VIEW = 'admin.attribute_values.';

    public function __construct(AttributeValueService $attributeValueService)
    {
        $this->attributeValueService = $attributeValueService;
        $this->middleware('permission:xem danh sách giá trị thuộc tính|Chỉnh sửa giá trị thuộc tính|Xóa giá trị thuộc tính|Thêm mới banner|Thêm mới giá trị thuộc tính', ['only' => ['index']]);
        $this->middleware('permission:Xóa giá trị thuộc tính', ['only' => ['destroy']]);
        $this->middleware('permission:Chỉnh sửa giá trị thuộc tính', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Thêm mới giá trị thuộc tính', ['only' => ['create', 'store']]);
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

    public function store(Request $request)
    {
        $attributeIds = $request->input('attribute_id');
        $values = $request->input('value');
        $colorCodes = $request->input('color_code');

        $this->attributeValueService->storeAttributeValues($attributeIds, $values, $colorCodes);

        return redirect()->route('admin.attribute_values.index')->with('success', 'Các giá trị thuộc tính đã được tạo thành công.');
    }

    public function edit(AttributeValue $attributeValue)
    {
        $attributes = Attribute::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributeValue', 'attributes'));
    }

    public function update(UpdateAttributeValueRequest $request, AttributeValue $attributeValue)
    {
        $validated = $request->validated();
        $this->attributeValueService->updateAttributeValue($validated, $attributeValue);

        return redirect()->route('admin.attribute_values.index')->with('success', 'Cập nhật giá trị thành công.');
    }

    public function destroy(AttributeValue $attributeValue)
    {
        $deleted = $this->attributeValueService->deleteAttributeValue($attributeValue);

        if (!$deleted) {
            return redirect()->route('admin.attribute_values.index')
                ->with('error', 'Không thể xóa vì đã có sản phẩm sử dụng giá trị và thuộc tính này.');
        }

        return redirect()->route('admin.attribute_values.index')
            ->with('success', 'Xóa giá trị thuộc tính thành công.');
    }
}
