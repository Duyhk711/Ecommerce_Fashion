<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\ProductService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $catalogueId = $request->input('catalogue_id');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $stockStatus = $request->input('stock_status');
        $catalogues = Catalogue::all();

        $products = $this->productService->listProducts($searchTerm, $catalogueId, $minPrice, $maxPrice, $stockStatus);

        foreach ($products as $product) {
            $product->total_stock = $product->variants->sum('stock');
            $product->variant_count = $product->variants->count();
        }
        $deletedProducts = Product::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->get();

        return view('admin.products.index', compact('products', 'searchTerm', 'catalogueId', 'minPrice', 'maxPrice', 'stockStatus', 'deletedProducts', 'catalogues'));
    }

    public function create()
    {
        $data = $this->productService->getCreateData();

        return view('admin.products.create', $data);
    }

    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $this->productService->storeProduct($validatedData, $request);

            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Product $product)
    {
        $product->load('variants.variantAttributes.attribute', 'variants.variantAttributes.attributeValue', 'images', 'catalogue');

        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $data = $this->productService->getProductForEdit($id);

        return view('admin.products.edit', $data);
    }


    public function update(UpdateProductRequest $request, $id)
    {
        // dd($request->all());
        try {
            $this->productService->updateProduct($id, $request->validated(), $request);

            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $this->productService->softDeleteProduct($id);

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công.');
    }

    public function restore($id)
    {
        $this->productService->restoreProduct($id);

        return redirect()->route('admin.products.index')->with('success', 'Khôi phục sản phẩm thành công.');
    }


    public function updateVariant(Request $request)
    {
        $variantsData = $request->input('variants');
        $product = null;
        foreach ($variantsData as $variantId => $data) {
            $validator = Validator::make($data, [
                'price_regular' => 'required|numeric',
                'price_sale' => 'required|numeric|lt:price_regular',
                'stock' => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Xác thực dữ liệu không thành công.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $variant = ProductVariant::find($variantId);
            if ($variant) {
                $variant->price_regular = $data['price_regular'];
                $variant->price_sale = $data['price_sale'];
                $variant->stock = $data['stock'];
                $variant->save();

                if ($product === null) {
                    $product = $variant->product;
                }
            }
        }
        if ($product) {
            $totalStock = $product->variants->sum('stock');


            return response()->json([
                'status' => 'success',
                'message' => 'Biến thể sản phẩm đã được cập nhật thành công!',
                'total_stock' => $totalStock,
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Sản phẩm không tồn tại.',
        ], 404);
    }
}
