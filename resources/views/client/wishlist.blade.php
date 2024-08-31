
    @extends('layouts.client')

    @section('content')
    <div class="page-header text-center">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                    <div class="page-title">
                        <h1>Wishlist Style2</h1>
                    </div>
                    <!--Breadcrumbs-->
                    <div class="breadcrumbs"><a href="index.html" title="Back to the home page">Home</a><span class="main-title"><i class="icon anm anm-angle-right-l"></i>Wishlist Style2</span></div>
                    <!--End Breadcrumbs-->
                </div>
            </div>
        </div>
    </div>
    <!--End Page Header-->

    <!--Main Content-->
    <div class="container">
        <!--Wishlist Form-->
        <div class="alert alert-success py-2 alert-dismissible fade show cart-alert" role="alert">
            There are <span class="text-primary fw-600">5</span> products in this wishlist
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <form action="#" method="post">
            <div class="wishlist-table table-content table-responsive">
                <table class="table align-middle text-nowrap table-bordered">
                    <thead class="thead-bg">
                        <tr>
                            <th class="product-name text-start" colspan="2">Product</th>
                            <th class="product-price text-center">Price</th>
                            <th class="stock-status text-center">Stock Status</th>
                            <th class="product-subtotal text-center">Add to Cart</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="product-thumbnail">
                                <a class="product-img" href="product-layout1.html"><img class="image rounded-0 blur-up lazyload" data-src="assets/images/products/product1-120x170.jpg" src="assets/images/products/product1-120x170.jpg" alt="Product" title="Product" width="120" height="170" /></a>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#quickview_modal"><i class="icon anm anm-search-plus-l"></i></button>
                            </td>
                            <td class="product-details">
                                <p class="product-name mb-0">Oxford Cuban Shirt</p>
                                <p class="variant-cart my-1 text-muted">Black / XL</p>
                                <button type="button" class="btn remove-icon close-btn position-static me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><i class="icon anm anm-times-r"></i></button>
                            </td>
                            <td class="product-price text-center"><span class="amount fw-500">$143.00</span></td>
                            <td class="product-stock text-center"><span class="text-in-stock">in stock</span></td>
                            <td class="product-action text-center">
                                <button type="button" class="btn btn-secondary text-nowrap" data-bs-toggle="modal" data-bs-target="#quickshop_modal">Select Options</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="product-thumbnail">
                                <a class="product-img" href="product-layout1.html"><img class="image rounded-0 blur-up lazyload" data-src="assets/images/products/product2-120x170.jpg" src="assets/images/products/product2-120x170.jpg" alt="Product" title="Product" width="120" height="170" /></a>
                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#quickview_modal"><i class="icon anm anm-search-plus-l"></i></button>
                            </td>
                            <td class="product-details">
                                <p class="product-name mb-0">Cuff Beanie Cap</p>
                                <p class="variant-cart my-1 text-muted">Maroon / M</p>
                                <button type="button" class="btn remove-icon close-btn position-static me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><i class="icon anm anm-times-r"></i></button>
                            </td>
                            <td class="product-price text-center"><span class="amount fw-500">$128.00</span></td>
                            <td class="product-stock text-center"><span class="text-out-stock">Out Of stock</span></td>
                            <td class="product-action text-center">
                                <button type="button" class="btn btn-secondary soldOutBtn disabled text-nowrap" data-bs-toggle="modal" data-bs-target="#addtocart_modal">Out Of stock</button>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </form>
        <!--End Wishlist Form-->
    </div>
    @endsection


