<?php 

namespace App\Services;

use App\Models\Order;

class OrderService{
    public function getOrder(){
        return Order::with('items')->get();
    }

    public function getOrderDetail($id){
        return $order = Order::with([
            'user',
            'voucher',
            'address',
            'items.productVariant.variantAttributes.attributeValue',
            'items.productVariant.product',
            'items',
        ])->findOrFail($id);
    }
}

?>