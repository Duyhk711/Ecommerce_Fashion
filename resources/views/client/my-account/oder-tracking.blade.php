@extends('client.my-account')
@section('order-tracking')
<div>
    <div class="orders-card mt-0 h-100">
        <div class="top-sec d-flex-justify-center justify-content-between mb-4">
            <h2 class="mb-0">Orders tracking</h2>
        </div>

        <form class="orderstracking-from" method="post" action="#">
            <p class="mb-3">To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
            <div class="row align-items-center">
                <div class="form-group col-md-5 col-lg-5">
                    <label for="orderId" class="d-none">Order ID <span class="required-f">*</span></label>
                    <input name="orderId" placeholder="Order ID" value="" id="orderId" type="text" required>
                </div>
                <div class="form-group col-md-5 col-lg-5">
                    <label for="billingEmail" class="d-none">Billing email <span class="required-f">*</span></label>
                    <input name="billingEmail" placeholder="Billing email" value="" id="billingEmail" type="text" required>
                </div>
                <div class="form-group col-md-2 col-lg-2">
                    <button type="submit" class="btn rounded w-100"><span>Track</span></button>
                </div>
            </div>
        </form>

        <div class="row mt-2">
            <div class="col-sm-12">
                <h3>Status for order no: 000123</h3>
                <!-- Status Order -->
                <div class="row mt-3">
                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <div class="product-img mb-3 mb-sm-0">
                            <img class="rounded-0 blur-up lazyload" data-src="{{asset('client/images/products/orders-tracking-product.jpg')}}" src="{{asset('client/images/products/orders-tracking-product.jpg')}}" alt="product" title="" width="545" height="700" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-9 col-sm-8">
                        <div class="tracking-detail d-flex-center">
                            <ul>
                                <li>
                                    <div class="left"><span>Order name</span></div>
                                    <div class="right"><span>Cuff Beanie Cap</span></div>
                                </li>
                                <li>
                                    <div class="left"><span>customer number</span></div>
                                    <div class="right"><span>000123</span></div>
                                </li>
                                <li>
                                    <div class="left"><span>order date</span></div>
                                    <div class="right"><span>14 Nov 2021</span></div>
                                </li>
                                <li>
                                    <div class="left"><span>Ship Date</span></div>
                                    <div class="right"><span>16 Nov 2021</span></div>
                                </li>
                                <li>
                                    <div class="left"><span>shipping address</span></div>
                                    <div class="right"><span>55 Gallaxy Enque, 2568 steet, 23568 NY</span></div>
                                </li>
                                <li>
                                    <div class="left"><span>Carrier</span></div>
                                    <div class="right"><span>Ipsum</span></div>
                                </li>
                                <li>
                                    <div class="left"><span>carrier tracking number</span></div>
                                    <div class="right"><span>000123</span></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 mt-4 mt-lg-0">
                        <div class="tracking-map map-section ratio ratio-16x9 h-100">
                            <iframe src="https://www.google.com/maps/embed?pb=" allowfullscreen="" height="650"></iframe>
                        </div>
                    </div>
                </div>
                <!-- End Status Order -->
                <!-- Tracking Steps -->
                <div class="tracking-steps nav mt-5 mb-4 clearfix">
                    <div class="step done"><span>order placed</span></div>
                    <div class="step done"><span>preparing to ship</span></div>
                    <div class="step current"><span>shipped</span></div>
                    <div class="step"><span>delivered</span></div>
                </div>
                <!-- End Tracking Steps -->
                <!-- Order Table -->
                <div class="table-bottom-brd table-responsive">
                    <table class="table align-middle text-center order-table">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Description</th>
                                <th scope="col">Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>14 May 2023</td>
                                <td>08.00 AM</td>
                                <td><span class="badge rounded-pill bg-success custom-badge">Shipped</span></td>
                                <td>Canada</td>
                            </tr>
                            <tr>
                                <td>15 May 2023</td>
                                <td>12.00 AM</td>
                                <td><span class="badge rounded-pill bg-dark custom-badge">Shipping info received</span></td>
                                <td>California</td>
                            </tr>
                            <tr>
                                <td>16 May 2023</td>
                                <td>10.00 AM</td>
                                <td><span class="badge rounded-pill bg-secondary custom-badge">Origin scan</span></td>
                                <td>Landon</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End Order Table -->
            </div>
        </div>
    </div>
</div>
@endsection
