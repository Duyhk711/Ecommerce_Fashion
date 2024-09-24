<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('catalogue')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $catalogues = Catalogue::all();
        $attributes = Attribute::with('values')->get();

        // Tạo SKU random trực tiếp
        $sku = 'PRD-' . Str::upper(Str::random(8)); // PRD-XXXXXXXX

        return view('admin.products.create', compact('catalogues', 'attributes', 'sku'));
    }

    // public function store(Request $request)
    // {
    //    // Xác thực dữ liệu
    // $validatedData = $request->validate([
    //     'name' => 'required|string|max:255',
    //     'sku' => 'required|string|max:255|unique:products',
    //     'catalogue_id' => 'required|exists:catalogues,id',
    //     'price_regular' => 'required|numeric',
    //     // thêm các quy tắc khác cho dữ liệu sản phẩm
    // ]);

    // // Tạo sản phẩm mới
    // $product = Product::create([
    //     'name' => $validatedData['name'],
    //     'sku' => $validatedData['sku'],
    //     'catalogue_id' => $validatedData['catalogue_id'],
    //     'price_regular' => $validatedData['price_regular'],
    //     // thêm các trường khác nếu cần
    // ]);

    //     // Lưu các hình ảnh sản phẩm
    //     if ($request->has('images')) {
    //         foreach ($request->images as $image) {
    //             ProductImage::create([
    //                 'product_id' => $product->id,
    //                 'image' => $image,
    //                 'is_main' => false,
    //             ]);
    //         }
    //     }

    //     // Lưu các biến thể sản phẩm
    //     if ($request->has('variants')) {
    //         foreach ($request->variants as $variantData) {
    //             $variant = ProductVariant::create([
    //                 'product_id' => $product->id,
    //                 'sku' => $variantData['sku'],
    //                 'price_regular' => $variantData['price_regular'],
    //                 'price_sale' => $variantData['price_sale'],
    //                 'stock' => $variantData['stock'],
    //                 'image' => $variantData['image'],
    //             ]);

    //             // Lưu các thuộc tính biến thể
    //             if (isset($variantData['attributes'])) {
    //                 foreach ($variantData['attributes'] as $attributeId => $attributeValueId) {
    //                     VariantAttribute::create([
    //                         'product_variant_id' => $variant->id,
    //                         'attribute_id' => $attributeId,
    //                         'attribute_value_id' => $attributeValueId,
    //                     ]);
    //                 }
    //             }
    //         }
    //     }

    //     return redirect()->route('products.index')->with('success', 'Product created successfully.');
    // }

    public function edit($id)
    {
        $product = Product::with(['productImages', 'productVariants.variantAttributes'])->findOrFail($id);
        $catalogues = Catalogue::all();
        $attributes = Attribute::with('attributeValues')->get();
        return view('products.edit', compact('product', 'catalogues', 'attributes'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku,' . $id,
            'catalogue_id' => 'required|exists:catalogues,id',
            'price_regular' => 'required|numeric',
            // thêm các rule khác cho dữ liệu sản phẩm
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        // Cập nhật hình ảnh sản phẩm
        if ($request->has('images')) {
            $product->productImages()->delete();
            foreach ($request->images as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $image,
                    'is_main' => false,
                ]);
            }
        }

        // Cập nhật biến thể sản phẩm
        if ($request->has('variants')) {
            $product->productVariants()->delete();
            foreach ($request->variants as $variantData) {
                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'sku' => $variantData['sku'],
                    'price_regular' => $variantData['price_regular'],
                    'price_sale' => $variantData['price_sale'],
                    'stock' => $variantData['stock'],
                    'image' => $variantData['image'],
                ]);

                // Cập nhật thuộc tính biến thể
                if (isset($variantData['attributes'])) {
                    foreach ($variantData['attributes'] as $attributeId => $attributeValueId) {
                        VariantAttribute::create([
                            'product_variant_id' => $variant->id,
                            'attribute_id' => $attributeId,
                            'attribute_value_id' => $attributeValueId,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
