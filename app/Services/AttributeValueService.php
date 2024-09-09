<?php

namespace App\Services;

use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;

class AttributeValueService
{
    public function getAllAttributeValues()
    {
        return AttributeValue::with('attribute')->get();
    }

    public function createAttributeValues(array $data)
{
    $attributeValues = [];
    foreach ($data['attribute_id'] as $index => $attributeId) {
        if (isset($data['value'][$index])) {
            $attributeValue = [
                'attribute_id' => $attributeId,
                'value' => $data['value'][$index],
            ];

            if (isset($data['color_code'][$index])) {
                $attributeValue['color_code'] = $data['color_code'][$index];
            }

            $attributeValues[] = $attributeValue;

            if (isset($data['additional_value'][$index])) {
                foreach ($data['additional_value'][$index] as $additionalValue) {
                    if (!empty($additionalValue)) {
                        $attributeValues[] = [
                            'attribute_id' => $attributeId,
                            'value' => $additionalValue,
                        ];
                    }
                }
            }
        }
    }

    return AttributeValue::insert($attributeValues);
}


public function updateAttributeValue(AttributeValue $attributeValue, array $data)
{
    // Nếu có mã màu trong dữ liệu, thêm nó vào mảng cập nhật
    $updateData = [
        'value' => $data['value'],
    ];

    if (isset($data['color_code'])) {
        $updateData['color_code'] = $data['color_code'];
    }

    return $attributeValue->update($updateData);
}


    public function deleteAttributeValue(AttributeValue $attributeValue)
    {
        return $attributeValue->delete();
    }
}
