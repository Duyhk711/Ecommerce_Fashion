@extends('client.my-account')

@section('i4')
<div class="profile-image mb-3">
    <img class="rounded-circle blur-up lazyload"
         data-src="{{ !empty($currentUser->avatar) ? asset('storage/' . $currentUser->avatar) : asset('client/images/users/default-avatar.jpg') }}"
         src="{{ !empty($currentUser->avatar) ? asset('storage/' . $currentUser->avatar) : asset('client/images/users/default-avatar.jpg') }}"
         alt="user" style="width: 130px; height: 130px; object-fit: cover;" />
</div>
<div class="profile-detail">
    <h3 class="mb-1">{{$currentUser->name}}</h3>
    <p class="text-muted">{{$currentUser->email}}</p>
</div>
@endsection

@section('account-info')
<div class="tab-pane fade h-100 show active" id="info">
    <div class="account-info h-100">
        <div class="welcome-msg mb-4">
            <h2>Xin chào, <span class="text-primary">{{$currentUser->name}}</span></h2>
        </div>

        <div class="row g-3 row-cols-lg-3 row-cols-md-3 row-cols-sm-3 row-cols-1 mb-4">
            <div class="counter-box">
                <div class="bg-block d-flex-center flex-nowrap">
                    <img class="blur-up lazyload" data-src="{{asset('client/images/icons/sale.png')}}" src="{{asset('client/images/icons/sale.png')}}" alt="icon" width="64" height="64" />
                    <div class="content">
                        <h3 class="fs-5 mb-1 text-primary">{{$totalOrder}}</h3>
                        <p>Tổng số đơn hàng</p>
                    </div>
                </div>
            </div>
            <div class="counter-box">
                <div class="bg-block d-flex-center flex-nowrap">
                    <img class="blur-up lazyload" data-src="{{asset('client/images/icons/homework.png')}}" src="{{asset('client/images/icons/homework.png')}}" alt="icon" width="64" height="64" />
                    <div class="content">
                        <h3 class="fs-5 mb-1 text-primary">12</h3>
                        <p>Đơn hàng đang xử lí</p>
                    </div>
                </div>
            </div>
            <div class="counter-box">
                <div class="bg-block d-flex-center flex-nowrap">
                    <img class="blur-up lazyload" data-src="{{asset('client/images/icons/order.png')}}" src="{{asset('client/images/icons/order.png')}}" alt="icon" width="64" height="64" />
                    <div class="content">
                        <h3 class="fs-5 mb-1 text-primary">10</h3>
                        <p>Đơn hàng đã nhận</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="account-box">
            <h3 class="mb-3">Thông tin tài khoản</h3>
           <div class="box-info mb-4">
                <div class="box-title d-flex-center">
                    <h4>Thông tin liên hệ</h4>
                    <a href="{{route('profile')}}" class="btn-link ms-auto">Chỉnh sửa</a>
                </div>
                    <div class="box-content mt-3">
                        <h5>Tên: {{$currentUser->name}}</h5>
                        <p class="mb-2">Email: {{$currentUser->email}}</p>
                        <p class="mb-2">Số điện thoại: {{$currentUser->phone}}</p>
                        <p><a href="#" class="btn-link">Đổi mật khẩu</a></p>
                    </div>
                </div>
            </div>

            <div class="box-info mb-4">
                <div class="box-title d-flex-center">
                    <h4>Địa chỉ</h4>
                    <a href="{{route('address')}}" class="btn-link ms-auto">Chỉnh sửa</a>
                </div>
                <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1">
                    @if($defaultAddress)
                        <div class="box-content mt-3">
                            <h5>Địa chỉ mặc định:</h5>
                            <address>
                                {{ $defaultAddress->address_line1 }}<br>
                                {{ $defaultAddress->address_line2 }}<br>
                                {{ $defaultAddress->ward }}, {{ $defaultAddress->district }}, {{ $defaultAddress->city }}<br>
                                <p>Mobile: <a href="tel:{{ $defaultAddress->customer_phone }}">{{ $defaultAddress->customer_phone }}</a></p>
                            </address>
                        </div>
                    @else
                        <div class="box-content mt-3">
                            <h5>Địa chỉ giao hàng mặc định</h5>
                            <p class="mb-2">Bạn chưa thiết lập địa chỉ giao hàng mặc định.</p>
                            <p><a href="{{route('address')}}" class="btn-link">Chỉnh sửa địa chỉ</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
