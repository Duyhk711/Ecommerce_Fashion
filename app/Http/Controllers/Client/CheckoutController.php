<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Client\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function renderCheckout(Request $request)
    {

        if (Auth::check()) {
            $dataAddress = $this->checkoutService->getAddresses();
            if ($request->has('address')) {
                $address = $dataAddress->where('id', $request->input('address'))->first();
                // dd($dataAddress, $request->input('address'), $address);
            } else {
                $address = $dataAddress->where('is_default', 1)->first();
                // dd($dataAddress, $address);
            }

            // dd($address);
            $dataCart = $this->checkoutService->getCart();
        } else {
            $dataAddress = [];
            $address = '';
            $dataCart = session('cart', []);
        }
        // dd($dataCart);
        return view('client.checkout', compact('dataAddress', 'dataCart', 'address'));

    }

    public function storeCheckout(Request $request)
    {
        dd($request);
    }
}
