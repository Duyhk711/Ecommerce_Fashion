<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\BannerImage;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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
            foreach ($data['images'] as $index => $image) {
                $path = $this->uploadFile($image, 'banners');
                $link = $data['link'][$index] ?? null;  // Lấy link tương ứng với ảnh
                $banner->images()->create([
                    'image' => $path,
                    'link' => $link,  // Lưu link vào cột `link`
                ]);
            }
        }

        return $banner;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:main,sub',
            'position' => 'nullable|in:top,middle,bottom',
            'description' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link.*' => 'nullable|max:255',
        ]);

        $banner = Banner::findOrFail($id);
        $banner->type = $request->type;
        $banner->position = $request->position;
        $banner->description = $request->description;
        $banner->save();

        $removedImageIds = json_decode($request->input('removed_image_ids'), true);
        if (!empty($removedImageIds)) {
            BannerImage::whereIn('id', $removedImageIds)->delete();
        }

        if ($request->has('images')) {
            foreach ($request->images as $index => $file) {
                if ($file) {
                    $path = $file->store('banners');

                    if (isset($banner->images[$index])) {
                        Storage::delete($banner->images[$index]->image);
                        $banner->images[$index]->image = $path;
                    } else {
                        $bannerImage = new BannerImage();
                        $bannerImage->banner_id = $banner->id;
                        $bannerImage->image = $path;
                        $bannerImage->link = $request->link[$index] ?? null;
                        $bannerImage->save();
                    }
                }
            }
        }

        foreach ($request->link as $index => $link) {
            if (isset($banner->images[$index])) {
                $banner->images[$index]->link = $link;
                $banner->images[$index]->save();
            }
        }

        return 'Cập nhật banner thành công.';
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
