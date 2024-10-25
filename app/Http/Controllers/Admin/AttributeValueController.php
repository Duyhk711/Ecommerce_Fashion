<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Services\AttributeValueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // return view('admin.attribute_values.creat2', compact('attributes'));
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributes'));
    }

    public function store(Request $request)
    {
        // Lấy dữ liệu từ request
        $attributeIds = $request->input('attribute_id');
        $values = $request->input('value');
        $colorCodes = $request->input('color_code');

        // Gọi service để lưu các giá trị thuộc tính
        $this->attributeValueService->storeAttributeValues($attributeIds, $values, $colorCodes);

        // Phản hồi lại nếu thành công
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
        // Gọi hàm service để xoá
        $deleted = $this->attributeValueService->deleteAttributeValue($attributeValue);

        // Kiểm tra kết quả từ service
        if (!$deleted) {
            return redirect()->route('admin.attribute_values.index')
                ->with('error', 'Không thể xóa vì đã có sản phẩm sử dụng giá trị và thuộc tính này.');
        }

        // Nếu xoá thành công
        return redirect()->route('admin.attribute_values.index')
            ->with('success', 'Xóa giá trị thuộc tính thành công.');
    }
}
