<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductVariantController extends Controller
{
    public function edit($id)
    {
        $variant = ProductVariant::findOrFail($id);
        return response()->json($variant);
    }

    public function update(Request $request, $id)
    {
        $variant = ProductVariant::findOrFail($id);

        // Validate dữ liệu đầu vào
        $request->validate([
            'sku' => 'required|string|max:255',
            'price_regular' => 'required|numeric',
            'price_sale' => 'nullable|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image',
        ]);

        $variant->sku = $request->sku;
        $variant->price_regular = $request->price_regular;
        $variant->price_sale = $request->price_sale;
        $variant->stock = $request->stock;

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            Storage::delete($variant->image);
            // Lưu ảnh mới
            $path = $request->file('image')->store('variants', 'public');
            $variant->image = $path;
        }

        $variant->save(); // Lưu thay đổi


        return redirect()->back()->with('success', 'Biến thể đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $variant = ProductVariant::findOrFail($id);

        if ($variant->image) {
            Storage::delete($variant->image);
        }

        $variant->delete();

        return redirect()->back()->with('success', 'Biến thể đã được xóa thành công.');
    }
}
