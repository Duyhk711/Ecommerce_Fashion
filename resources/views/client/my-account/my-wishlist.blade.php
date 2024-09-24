@extends('client.my-account')
@section('my-wishlist')
<div>
    <div class="orders-card mt-0 h-100">
        <div class="top-sec d-flex-justify-center justify-content-between mb-4">
            <h2 class="mb-0">My Wishlist</h2>
        </div>

        <div class="table-bottom-brd table-responsive">
            <table class="table align-middle text-center order-table">
                <thead>
                    <tr class="table-head text-nowrap">
                        <th scope="col">Image</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Product Details</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img class="blur-up lazyload" data-src="{{asset('client/images/products/product1-120x170.jpg')}}" src="{{asset('client/images/products/product1-120x170.jpg')}}" width="50" alt="product" title="product" /></td>
                        <td><span class="id">#12301</span></td>
                        <td><span class="name">Oxford Cuban Shirt</span></td>
                        <td><span class="price fw-500">$99.00</span></td>
                        <td><a href="cart-style1.html" class="btn btn-md text-nowrap">Add to Cart</a></td>
                    </tr>
                    <tr>
                        <td><img class="blur-up lazyload" data-src="{{asset('client/images/products/product2-120x170.jpg')}}" src="{{asset('client/images/products/product2-120x170.jpg')}}" width="50" alt="product" title="product" /></td>
                        <td><span class="id">#12302</span></td>
                        <td><span class="name">Cuff Beanie Cap</span></td>
                        <td><span class="price fw-500">$128.00</span></td>
                        <td><a href="cart-style1.html" class="btn btn-md text-nowrap">Add to Cart</a></td>
                    </tr>
                    <tr>
                        <td><img class="blur-up lazyload" data-src="{{asset('client/images/products/product3-120x170.jpg')}}" src="{{asset('client/images/products/product3-120x170.jpg')}}" width="50" alt="product" title="product" /></td>
                        <td><span class="id">#12303</span></td>
                        <td><span class="name">Flannel Collar Shirt</span></td>
                        <td><span class="price fw-500">$114.00</span></td>
                        <td><a href="cart-style1.html" class="btn btn-md text-nowrap">Add to Cart</a></td>
                    </tr>
                    <tr>
                        <td><img class="blur-up lazyload" data-src="{{asset('client/images/products/product4-120x170.jpg')}}" src="{{asset('client/images/products/product4-120x170.jpg')}}" width="50" alt="product" title="product" /></td>
                        <td><span class="id">#12304</span></td>
                        <td><span class="name">Cotton Hooded Hoodie</span></td>
                        <td><span class="price fw-500">$198.00</span></td>
                        <td><a href="cart-style1.html" class="btn btn-md text-nowrap">Add to Cart</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
