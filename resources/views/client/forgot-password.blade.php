@extends('layouts.client')

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

                            <form method="post" action="{{ route('send-otp') }}" class="customer-form">
                                @csrf
                                <h2 class="text-center fs-4 mb-3">Quên Mật Khẩu</h2>
                                <p class="text-center mb-4">Vui lòng nhập địa chỉ email của bạn bên dưới. Bạn sẽ nhận được liên kết để đặt lại mật khẩu của mình.</p>
                                <div class="form-row">
                                    <div class="form-group col-12 mb-4">
                                        <label for="CustomerEmail" class="d-none">Nhập email của bạn <span class="required">*</span></label>
                                        <input type="email" name="email" placeholder="Nhập email của bạn" id="CustomerEmail"
                                            value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required />
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end main content -->
    </div>
@endsection
