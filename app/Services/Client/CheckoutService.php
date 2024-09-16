<?php

namespace App\Services\Client;


use App\Models\ProductVariant;

class CheckoutService
{
    public function reduceQuantity(ProductVariant $productVariant, $quantity)
    {
        // Trừ số lượng
        $productVariant->stock -= $quantity;

        // Lưu thay đổi vào cơ sở dữ liệu
        $productVariant->save();
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