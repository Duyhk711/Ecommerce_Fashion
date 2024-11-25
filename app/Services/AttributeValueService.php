<?php

namespace App\Services;

use App\Models\AttributeValue;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AttributeValueService
{
    public function getAllAttributeValues()
    {
        return AttributeValue::with('attribute')->get();
    }

    public function storeAttributeValues(array $attributeIds, array $values, array $colorCodes)
    {
        foreach ($values as $index => $value) {
            // Kiểm tra nếu color_code là "null" thì gán giá trị null
            $colorCode = $colorCodes[$index] === "null" ? null : $colorCodes[$index];

            // Lưu từng bản ghi vào bảng attribute_values
            DB::table('attribute_values')->insert([
                'attribute_id' => $attributeIds[$index],
                'value' => $value,
                'color_code' => $colorCode,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function updateAttributeValue(array $validatedData, AttributeValue $attributeValue)
    {
        $attributeValue->update([
            'attribute_id' => $validatedData['attribute_id'],
            'value' => $validatedData['value'],
            'color_code' => $validatedData['color_code'] ?? $attributeValue->color_code,
        ]);
    }

    public function deleteAttributeValue(AttributeValue $attributeValue)
    {
        // Kiểm tra xem giá trị thuộc tính có đang được sử dụng trong variant_attributes không
        $isUsed = DB::table('variant_attributes')
            ->where('attribute_value_id', $attributeValue->id)
            ->exists();

        if ($isUsed) {
            // Trả về false nếu không thể xoá do đang được sử dụng
            return false;
        }

        try {
            // Thực hiện xoá nếu không có bản ghi tham chiếu
            $attributeValue->delete();
            return true;
        } catch (QueryException $e) {
            // Trả về false nếu có lỗi trong quá trình xoá
            return false;
        }
    }
}
