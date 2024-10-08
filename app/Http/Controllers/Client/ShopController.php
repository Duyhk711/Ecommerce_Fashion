<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Services\Client\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function index(Request $request)
    {
        $categories = $this->shopService->getCategories();
        $colorValues = $this->shopService->getColorValues();
        $sizeValues = $this->shopService->getSizeValues();

        $perPage = $this->shopService->getPerPage($request);
        $sortBy = $this->shopService->getSortBy($request);

        // Lưu vào session
        session(['perPage' => $perPage, 'sortBy' => $sortBy]);

        // Lấy sản phẩm từ database
        $products = $this->shopService->getShopProducts(session('perPage'), session('sortBy'));

        return view('client.shop', compact('products', 'categories', 'colorValues', 'sizeValues'));
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