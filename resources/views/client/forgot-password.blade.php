@extends('layouts.client')
@section('title')
    Thay đổi mật khẩu
@endsection
@section('content')
    @include('client.component.page_header')
    <div class="container" style="max-width: 80%;">
        <!--Main Content-->
        <div class="container">
            <div class="login-register">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                        <div class="inner h-100">
                            <!-- Display Success or Error Messages -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- Hiển thị form dựa trên giá trị của method -->
                            @if (!request('method') || request('method') == 'email')
                                <!-- Form gửi OTP qua Email -->
                                <form method="post" action="{{ route('send-otp') }}" class="customer-form">
                                    @csrf
                                    <h2 class="text-center fs-4 mb-3">Gửi OTP qua Email</h2>
                                    <p class="text-center mb-4">Vui lòng nhập số điện thoại của bạn bên dưới để nhận mã OTP.</p>
                                    <div class="form-row">
                                        <div class="form-group col-12 mb-4">
                                            <label for="CustomerEmail">Nhập email của bạn <span class="required">*</span></label>
                                            <input type="email" name="email" placeholder="Nhập email của bạn" id="CustomerEmail"
                                                value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required />
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            {{-- <div class="text-right">
                                                <small><a href="{{ url()->current() }}?method=phone">Gửi OTP qua Số Điện Thoại</a></small>
                                            </div> --}}
                                        </div>
                                        <div class="form-group col-12 mb-0">
                                            <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                                <input type="submit" class="btn btn-primary btn-lg" value="Đặt lại mật khẩu" />
                                                <a href="{{ route('login') }}" class="d-flex justify-content-center btn-link">
                                                    {{-- <i class="icon anm anm-angle-left-r me-2"></i> --}}
                                                    Quay lại Đăng Nhập
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Dòng chuyển sang gửi OTP bằng số điện thoại -->

                                </form>
                            @elseif (request('method') == 'phone')
                                <!-- Form gửi OTP qua Số Điện Thoại -->
                                <form method="post" action="" class="customer-form">
                                    @csrf
                                    <h2 class="text-center fs-4 mb-3">Gửi OTP qua Số Điện Thoại</h2>
                                    <p class="text-center mb-4">Vui lòng nhập số điện thoại của bạn bên dưới để nhận mã OTP.</p>
                                    <div class="form-row">
                                        <div class="form-group col-12 mb-4">
                                            <label for="CustomerPhone">Nhập số điện thoại của bạn <span class="required">*</span></label>
                                            <input type="text" name="phone" placeholder="Nhập số điện thoại của bạn" id="CustomerPhone"
                                                value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" required />
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="text-right">
                                                <small><a href="{{ url()->current() }}?method=email">Gửi OTP qua Email</a></small>
                                            </div>
                                        </div>
                                        <div class="form-group col-12 mb-0">
                                            <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                                <input type="submit" class="btn btn-primary btn-lg" value="Đặt lại mật khẩu" />
                                                <a href="{{ route('login') }}" class="d-flex justify-content-center btn-link">
                                                    <i class="icon anm anm-angle-left-r me-2"></i> Quay lại Đăng Nhập
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Dòng chuyển sang gửi OTP bằng email -->
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end main content -->
    </div>
@endsection
