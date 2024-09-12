<?php
namespace App\Services;

use App\Models\Banner;
use App\Models\BannerImage;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    use ImageUploadTrait;

    public function storeBanner($data)
    {
        // banner mới
        $banner = Banner::create([
            'type' => $data['type'],
            'position' => $data['type'] == 'sub' ? $data['position'] : null,
            'description' => $data['description'],
            'is_active' => $data['is_active'] ?? false,
        ]);

        // Upload và lưu ảnh 
        if (!empty($data['images'])) {
            foreach ($data['images'] as $image) {
                $path = $this->uploadFile($image, 'banners');
                $banner->images()->create(['image' => $path]);
            }
        }

        return $banner;
    }

    public function updateBanner(Banner $banner, $data)
    {
        // Cập nhật thông tin banner
        $banner->update([
            'type' => $data['type'],
            'position' => $data['type'] == 'sub' ? $data['position'] : null,
            'description' => $data['description'],
            'is_active' => $data['is_active'] ?? false,
        ]);

        // Xóa ảnh 
        if (!empty($data['remove_images'])) {
            $this->removeImages($data['remove_images']);
        }

        // Upload và lưu ảnh mới nếu có
        if (!empty($data['images'])) {
            foreach ($data['images'] as $image) {
                $path = $this->uploadFile($image, 'banners');
                $banner->images()->create(['image' => $path]);
            }
        }

        return $banner;
    }

    public function removeImages(array $imageIds)
    {
        $images = BannerImage::whereIn('id', $imageIds)->get();
        foreach ($images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }
    }

    public function deleteBanner(Banner $banner)
    {
        foreach ($banner->images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }

        $banner->delete();
    }
}
