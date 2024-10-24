<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
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

        $products = $this->productService->listProducts($searchTerm);

        foreach ($products as $product) {
            $product->total_stock = $product->variants->sum('stock');
            $product->variant_count = $product->variants->count();
        }

        return view('admin.products.index', compact('products', 'searchTerm'));
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

        // Truyền dữ liệu ra view
        return view('admin.products.edit', $data);
    }


    public function update(UpdateProductRequest $request, $id)
    {
        try {
            // Gọi service để cập nhật sản phẩm
            $this->productService->updateProduct($id, $request->validated(), $request);

            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

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

        return redirect()->route('admin.products.index')->with('success', 'Xóa giá sản phẩm thành công.');
    }

    public function updateVariant(Request $request)
    {
        $variantsData = $request->input('variants');
    
        // Xác thực dữ liệu cho từng biến thể
        foreach ($variantsData as $variantId => $data) {
            // Thực hiện xác thực cho từng biến thể
            $validator = Validator::make($data, [
                'price_regular' => 'required|numeric',
                'price_sale' => 'required|numeric|lt:price_regular', // Giá sale phải nhỏ hơn giá gốc
                'stock' => 'required|integer|min:0', // Thêm xác thực cho tồn kho nếu cần
            ]);
    
            // Nếu xác thực không thành công, trả về lỗi
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Xác thực dữ liệu không thành công.',
                    'errors' => $validator->errors(),
                ], 422); // Mã trạng thái 422 Unprocessable Entity
            }
    
            // Cập nhật thông tin biến thể nếu xác thực thành công
            $variant = ProductVariant::find($variantId);
            if ($variant) {
                $variant->price_regular = $data['price_regular'];
                $variant->price_sale = $data['price_sale'];
                $variant->stock = $data['stock'];
                $variant->save();
            }
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Biến thể sản phẩm đã được cập nhật thành công!'
        ]);
    }
    
}
