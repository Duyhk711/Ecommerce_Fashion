<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Favorite;
use App\Services\Client\HomeService;
use App\Services\Client\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $shopService;
    protected $homeService;

    public function __construct(ShopService $shopService, HomeService $homeService)
    {
        $this->shopService = $shopService;
        $this->homeService = $homeService;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $pageTitle = 'Cửa Hàng';
        $categories = $this->shopService->getCategories();
        $colorValues = $this->shopService->getColorValues();
        $sizeValues = $this->shopService->getSizeValues();

        $perPage = $this->shopService->getPerPage($request);
        $sortBy = $this->shopService->getSortBy($request);

        // Lưu vào session
        session(['perPage' => $perPage, 'sortBy' => $sortBy]);

        // Lấy sản phẩm từ database
        $products = $this->shopService->getShopProducts(session('perPage'), session('sortBy'));
        $ratings = $this->homeService->getRatingsForRelatedProducts($products);

        // sp yeu thich
        foreach ($products as $product) {
            $product->isFavorite = $user ? Favorite::where('user_id', $user->id)
                                                 ->where('product_id', $product->id)
                                                 ->exists() : false;
        }
        return view('client.shop', compact('products', 'categories', 'colorValues', 'sizeValues', 'ratings'));
    }
    public function filterShop(Request $request)
    {
        $categories = $this->shopService->getCategories();
        $colorValues = $this->shopService->getColorValues();
        $sizeValues = $this->shopService->getSizeValues();

        $perPage = $this->shopService->getPerPage($request);
        $sortBy = $this->shopService->getSortBy($request);

        // Lưu vào session
        session(['perPage' => $perPage, 'sortBy' => $sortBy]);

        // dd($categories);
        $products = $this->shopService->getFilteredProducts($request, session('perPage'), session('sortBy'));
        $filter = 'filter';

        return view('client.shop', compact('products', 'categories', 'colorValues', 'sizeValues', 'filter'));
    }
}
