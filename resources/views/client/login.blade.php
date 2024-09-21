@extends('layouts.client')

@section('content')
    @include('client.component.page_header')
    <!--Main Content-->
    <div class="container">
        <div class="login-register pt-2">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <div class="inner h-100">
                        <form method="post" action="{{ route('postLogin') }}" class="customer-form">
                            @csrf
                            <h2 class="text-center fs-4 mb-3">Đăng Nhập</h2>
                            <p class="text-center mb-4">Nếu bạn đã có tài khoản, hãy đăng nhập.</p>
                            <p class=" text-muted"><small><span class="required"></span> (Các trường có dấu <span class="required">*</span> là bắt buộc.)</small></p>
                            <!-- Display success message -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Display error message -->
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- Display validation errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="email">Email <span class="required">*</span></label>
                                    <input type="email" name="email" placeholder="Email" id="email"
                                        value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="password">Mật khẩu <span class="required">*</span></label>
                                    <input type="password" name="password" placeholder="Mật khẩu"
                                        id="password" class="form-control @error('password') is-invalid @enderror"  required />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                        <div class="remember-check customCheckbox">
                                            <input id="remember" name="remember" type="checkbox" value="remember" />
                                            <label for="remember"> Ghi nhớ tôi</label>
                                        </div>
                                        {{-- <a href="{{ route('forgot-password') }}">Quên mật khẩu?</a> --}}
                                    </div>
                                </div>
                                <div class="form-group col-12 mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">Đăng Nhập</button>
                                </div>
                            </div>

                            <div class="login-divide"><span class="login-divide-text">HOẶC</span></div>

                            <p class="text-center fs-6 text-muted mb-3">Đăng nhập bằng tài khoản mạng xã hội</p>
                            <div class="login-social d-flex justify-content-center">
                                <a class="social-link facebook rounded-5 d-flex justify-content-center" href="#"><i
                                        class="icon anm anm-facebook-f me-2"></i> Facebook</a>
                                <a class="social-link google rounded-5 d-flex justify-content-center" href="#"><i
                                        class="icon anm anm-google-plus-g me-2"></i> Google</a>
                                <a class="social-link twitter rounded-5 d-flex justify-content-center" href="#"><i
                                        class="icon anm anm-twitter me-2"></i> Twitter</a>
                            </div>

                            <div class="login-signup-text mt-4 mb-2 fs-6 text-center text-muted">Bạn chưa có tài khoản?
                                <a href="{{ route('register') }}" class="btn-link">Đăng ký ngay</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
