<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductDetailService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productDetailService;

    public function __construct(ProductDetailService $productDetailService){
        $this->productDetailService = $productDetailService;
    }
    

    public function getProductDetail($id){
        $data = $this->productDetailService->getProductDetail($id);
        // dd($data['uniqueAttributes']);
        return view('client.product-detail', 
            [   
                'uniqueAttributes' => $data['uniqueAttributes'],
                'variantDetails' => $data['variantDetails'],
                'product' => $data['product'],
                'totalStock' => $data['totalStock'],
                'relatedProducts' => $data['relatedProducts']
            ]
        );
    }
}
