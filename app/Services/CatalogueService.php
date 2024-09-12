<?php

namespace App\Services;

use App\Models\Catalogue;
use Illuminate\Support\Str;

class CatalogueService
{
    public function getAllCatalogues()
    {
        return Catalogue::all();
    }

    public function storeCatalogue($data)
    {
        $slug = Str::slug($data['name']);
        $slug = $this->generateUniqueSlug($slug);

        $data['slug'] = $slug;

        return Catalogue::create($data);
    }

    public function updateCatalogue(Catalogue $catalogue, $data)
    {
        $slug = Str::slug($data['name']);
        $slug = $this->generateUniqueSlug($slug, $catalogue->id);

        $data['slug'] = $slug;

        return $catalogue->update($data);
    }

    public function deleteCatalogue(Catalogue $catalogue)
    {
        return $catalogue->delete();
    }

    protected function generateUniqueSlug($slug, $ignoreId = null)
    {
        $originalSlug = $slug;
        $count = 1;

        while (Catalogue::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
