<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\Catalogue;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        // Tìm kiếm theo tên sản phẩm hoặc SKU
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('sku', 'like', '%' . $search . '%');
        }
    
        // Phân trang sản phẩm
        $products = $query->paginate(10);
    
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $catalogues = Catalogue::all();
        $attributes = Attribute::with('values')->get();
        $sku = 'PRD-' . Str::upper(Str::random(8)); 

        return view('admin.products.create', compact('catalogues', 'attributes', 'sku'));
    }

    public function store(Request $request)
    {
        $productData = json_decode($request->input('productData'), true);

        $response = $this->productService->storeProduct($productData, $request);

        return response()->json(['message' => $response['message']], $response['status']);
    }



    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}

    public function getAttributes()
    {
        // Chỉ lấy thuộc tính mà không lấy giá trị thuộc tính
        $attributes = Attribute::select('id', 'name')->get();
        return response()->json($attributes);
    }

    // Lấy giá trị thuộc tính theo ID thuộc tính
    public function getAttributeValues($attributeId)
    {
        // Lấy thuộc tính cùng với giá trị của nó
        $attribute = Attribute::with('values')->findOrFail($attributeId);

        return response()->json([
            'id' => $attribute->id,
            'name' => $attribute->name,
            'attribute_values' => $attribute->values
        ]);
    }
}
