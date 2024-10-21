@extends('layouts.client')

@section('content')
@include('client.component.page_header')
<div class="container" style="max-width: 80%;">
        <!--Main Content-->
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-3 mb-4 mb-lg-0">
                    <!-- Dashboard sidebar -->
                    <div class="dashboard-sidebar bg-block">
                        <div class="profile-top text-center mb-4 px-3">
                            <div class="profile-image mb-3">
                                <img class="rounded-circle blur-up lazyload"
                                     data-src="{{ !empty($currentUser->avatar) ? asset('storage/' . $currentUser->avatar) : asset('client/images/users/default-avatar.jpg') }}"
                                     src="{{ !empty($currentUser->avatar) ? asset('storage/' . $currentUser->avatar) : asset('client/images/users/default-avatar.jpg') }}"
                                     alt="user" style="width: 130px; height: 130px; object-fit: cover;" />
                            </div>
                            <div class="profile-detail">
                                <h3 class="mb-1">{{Auth::user()->name}}</h3>
                                <p class="text-muted">{{Auth::user()->name}}</p>
                            </div>
                        </div>
                        <div class="dashboard-tab">
                            <ul class="nav nav-tabs flex-lg-column border-bottom-0" id="top-tab" role="tablist">
                                <li class="nav-item">
                                    <a href="{{ route('myaccount') }}" class="nav-link">Thông tin tài khoản</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('address') }}" class="nav-link">Địa chỉ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('my.order') }}" class="nav-link">Đơn hàng của tôi</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('order.tracking') }}" class="nav-link">Theo dõi đơn hàng</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ route('my.wishlist') }}" class="nav-link">Danh sách yêu thích</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('voucher') }}" class="nav-link">Mã ưu đãi</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('profile') }}" class="nav-link">Hồ sơ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('logout') }}" class="nav-link">Đăng xuất</a>
                                </li>
                               
                                
                            </ul>
                        </div>

                    </div>
                    <!-- End Dashboard sidebar -->
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="dashboard-content tab-content h-100" id="top-tabContent">
                        <!-- Account Info -->
                        @yield('account-info')
                        <!-- End Account Info -->

                        <!-- Address Book -->
                       @yield('address')
                        <!-- End Address Book -->

                        <!-- My Orders -->
                        @yield('my-order')
                        <!-- End My Orders -->

                        <!-- Orders tracking -->
                        @yield('order-tracking')
                        <!-- End Orders tracking -->

                        <!-- My Wishlist -->
                        @yield('my-wishlist')
                        <!-- End My Wishlist -->

                        <!-- Saved Cards -->

                        <!-- End Saved Cards -->

                        <!-- Profile -->
                       @yield('profile')
                        <!-- End Profile -->

                        <!-- Security -->

                        <!-- End Security -->
                    </div>
                </div>
            </div>
        </div>
        <!--End Main Content-->
    </div>



@endsection
