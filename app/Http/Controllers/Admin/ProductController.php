<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Catalogue;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $query = Product::with(['catalogue', 'mainImage', 'variants.variantAttributes.attribute', 'variants.variantAttributes.attributeValue']);

        $products = $query->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $data = $this->productService->getCreateData();

        return view('admin.products.create', $data);
    }

    public function store(Request $request)
    {
        try {
            $this->productService->storeProduct($request);

            return redirect()->route('admin.products.index')->with('success', 'Product and images saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to save product: ' . $e->getMessage());
        }
    }

    public function show(Product $product)
    {
        $product->load('variants.variantAttributes.attribute', 'variants.variantAttributes.attributeValue', 'images', 'catalogue');

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'variants.attributes.values', 'catalogue']);

        $catalogues = Catalogue::all();

        $attributes = Attribute::with('values')->get();

        return view('admin.products.edit', compact('product', 'catalogues', 'attributes'));
    }

    public function update(Request $request, $id) {}

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        foreach ($product->variants as $variant) {
            foreach ($variant->images as $image) {
                $image->delete();
            }
            $variant->delete();
        }

        foreach ($product->images as $image) {
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Sản phẩm và các biến thể đã được xóa mềm thành công.');
    }

    public function getAttributes()
    {
        $attributes = Attribute::select('id', 'name')->get();
        return response()->json($attributes);
    }

    public function getAttributeValues($attributeId)
    {
        $attribute = Attribute::with('values')->findOrFail($attributeId);

        return response()->json([
            'id' => $attribute->id,
            'name' => $attribute->name,
            'attribute_values' => $attribute->values
        ]);
    }

    public function getProductAttributes($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $attributes = Attribute::with('values')->get();

        $selectedAttributes = Attribute::with(['values' => function ($query) use ($productId) {
            $query->join('variant_attributes', 'attribute_values.id', '=', 'variant_attributes.attribute_value_id')
                ->where('variant_attributes.product_variant_id', $productId);
        }])->get();

        return response()->json([
            'attributes' => $attributes->map(function ($attribute) use ($selectedAttributes) {
                $selectedAttribute = $selectedAttributes->firstWhere('id', $attribute->id);
                return [
                    'id' => $attribute->id,
                    'name' => $attribute->name,
                    'attribute_values' => $attribute->values, // Tất cả các giá trị có thể chọn
                    'selected_values' => $selectedAttribute ? $selectedAttribute->values->pluck('id')->toArray() : [] // Giá trị đã được chọn
                ];
            })
        ]);
    }
}
