<?php

namespace App\Services\Client;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutService
{
    public function reduceQuantity(ProductVariant $productVariant, $quantity)
    {
        // Trừ số lượng
        $productVariant->stock -= $quantity;

        // Lưu thay đổi vào cơ sở dữ liệu
        $productVariant->save();
    }

    public function getAddresses()
    {

        $addresses = Address::where('user_id', Auth::user()->id)->get();
        return $addresses;
    }

    public function getCart()
    {

        $user_id = Auth::user()->id;
        // dd($user_id);
        if (!session()->has('cart')) {
            $cartItems = CartItem::with(['productVariant.product', 'productVariant.variantAttributes.attributeValue.attribute'])
                ->get();
        } else {
            $cartItems = session()->get('cart');
        }

        return $cartItems;
    }

    public function store(Request $request){
        
    }

    public function updateOrder()
    {
        //
    }

    public function updateOrderItem()
    {
        //
    }

}