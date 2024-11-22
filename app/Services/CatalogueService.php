<?php

namespace App\Services;

use App\Models\Catalogue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CatalogueService
{
    public function getAllCatalogues()
    {
        // Lấy các danh mục cha và kèm theo danh mục con (nếu có)
        return Catalogue::whereNull('parent_id') // Lấy các danh mục cha (parent_id = null)
            ->with('children') // Lấy các danh mục con
            ->get();
    }
    public function storeCatalogue($data)
    {
        // Kiểm tra xem 'cover' có tồn tại trong dữ liệu không và là file tải lên
        if (isset($data['cover']) && $data['cover'] instanceof \Illuminate\Http\UploadedFile) {
            // Xử lý ảnh bìa nếu có
            $data['cover'] = $this->uploadCover($data['cover']);
        }

        // Tạo slug từ tên và đảm bảo tính duy nhất
        $slug = Str::slug($data['name']);
        $slug = $this->generateUniqueSlug($slug);

        // Thêm slug vào dữ liệu
        $data['slug'] = $slug;

        // Đảm bảo trạng thái mặc định là không hoạt động nếu không có giá trị
        $data['is_active'] = isset($data['is_active']) ? (bool) $data['is_active'] : false;

        // Tạo mới danh mục
        return Catalogue::create($data);
    }

    public function updateCatalogue(Catalogue $catalogue, $data)
    {
        // Xử lý ảnh bìa nếu có ảnh mới được cung cấp
        if (isset($data['cover'])) {
            // Xóa ảnh bìa cũ nếu có
            if ($catalogue->cover) {
                Storage::disk('public')->delete($catalogue->cover);
            }

            // Tải ảnh bìa mới lên
            $data['cover'] = $this->uploadCover($data['cover']);
        }

        // Tạo slug mới cho danh mục
        $slug = Str::slug($data['name']);
        $slug = $this->generateUniqueSlug($slug, $catalogue->id);
        $data['slug'] = $slug;

        // Cập nhật danh mục
        return $catalogue->update($data);
    }

    public function deleteCatalogue(Catalogue $catalogue)
    {
        // Xóa hình ảnh bìa nếu tồn tại
        if ($catalogue->cover) {
            Storage::disk('public')->delete($catalogue->cover);
        }

        // Xóa mềm catalogue
        return $catalogue->delete(); // Xóa mềm thay vì xóa vĩnh viễn
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

    protected function uploadCover($cover)
    {
        // Tải ảnh lên thư mục 'covers' trong ổ đĩa công cộng
        $path = $cover->store('covers', 'public');
        return $path;
    }
}
