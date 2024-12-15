<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateProductRequest;
use App\Notifications\CreateProduct;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware('permission:xem danh sách sản phâm|Xóa sản phẩm|Chỉnh sửa sản phẩm|Thêm mới sản phẩm|Khôi phục sản phẩm', ['only' => ['index', 'show']]);
        $this->middleware('permission:Xóa sản phẩm', ['only' => ['destroy']]);
        $this->middleware('permission:Chỉnh sửa sản phẩm', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Thêm mới sản phẩm', ['only' => ['create', 'store']]);
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
        // dd($request->all());
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
        $variantIds = $product->variants->pluck('id')->toArray();

        $orderData = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->selectRaw('
            COUNT(DISTINCT orders.id) as total_orders,
            SUM(order_items.quantity * IFNULL(order_items.variant_price_sale, order_items.variant_price_regular)) as total_revenue
        ')
            ->whereIn('order_items.product_variant_id', $variantIds)
            ->whereNull('orders.deleted_at')
            ->first();

        $totalStock = DB::table('product_variants')
            ->where('product_id', $product->id)
            ->sum('stock');

        $comments = DB::table('comments')->join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.product_id', $product->id)
            ->select('comments.*', 'users.name as user_name')
            ->get();

        $totalReviews = $comments->count();

        $averageRating = $comments->avg('rating');

        $ratingsCount = [
            5 => $comments->where('rating', 5)->count(),
            4 => $comments->where('rating', 4)->count(),
            3 => $comments->where('rating', 3)->count(),
            2 => $comments->where('rating', 2)->count(),
            1 => $comments->where('rating', 1)->count(),
        ];

        return view('admin.products.show', compact('product', 'totalStock', 'orderData', 'comments', 'totalReviews', 'averageRating', 'ratingsCount'));
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
            ], [
                'price_regular.required' => 'Giá bán là bắt buộc.',
                'price_regular.numeric' => 'Giá bán phải là một số.',
                'price_sale.required' => 'Giá khuyến mãi là bắt buộc.',
                'price_sale.numeric' => 'Giá khuyến mãi phải là một số.',
                'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá bán.',
                'stock.required' => 'Số lượng là bắt buộc.',
                'stock.integer' => 'Số lượng phải là một số nguyên.',
                'stock.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
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
