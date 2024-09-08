<?php

namespace App\Services;

use App\Models\Attribute;
use Illuminate\Support\Str;

class AttributeService
{
    public function getAllAttributes()
    {
        return Attribute::all();
    }

    public function storeAttribute($data)
    {
        return Attribute::create($this->prepareData($data));
    }

    public function updateAttribute(Attribute $attribute, $data)
    {
        return $attribute->update($this->prepareData($data));
    }

    public function deleteAttribute(Attribute $attribute)
    {
        return $attribute->delete();
    }

    // TAO SLUG TU TEN
    private function prepareData($data)
    {
        return [
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ];
    }
}
