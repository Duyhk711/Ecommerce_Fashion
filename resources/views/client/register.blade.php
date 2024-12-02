@extends('layouts.client')
@section('title')
    Đăng kí
@endsection
@section('content')
    @include('client.component.page_header')
    <!--Main Content-->
    <div class="container">
        <div class="login-register pt-2">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <div class="inner h-100">
                        <form method="post" action="{{ route('postRegister') }}" class="customer-form" enctype="multipart/form-data">
                            @csrf
                            <h2 class="text-center fs-4 mb-3">Đăng Ký Tài Khoản</h2>
                            <p class="text-center mb-4">Nếu bạn đã có tài khoản với chúng tôi, vui lòng đăng nhập.</p>

                            <!-- Ghi chú cho các trường bắt buộc -->
                            <p class=" text-muted"><small><span class="required"></span> (Các trường có dấu <span class="required">*</span> là bắt buộc.)</small></p>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="name">Tên người dùng <span class="required">*</span></label>
                                    <input type="text" name="name" placeholder="Tên người dùng" id="CustomerName" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="email">Email <span class="required">*</span></label>
                                    <input type="email" name="email" placeholder="Email" id="CustomerEmail" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="phone">Số điện thoại <span class="required">*</span></label>
                                    <input type="phone" name="phone" placeholder="Số điện thoại" id="CustomerPhone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="password">Mật khẩu <span class="required">*</span></label>
                                    <input type="password" name="password" placeholder="Mật khẩu" id="CustomerPassword" class="form-control @error('password') is-invalid @enderror" />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="password_confirmation">Xác nhận mật khẩu <span class="required">*</span></label>
                                    <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" id="CustomerPasswordConfirmation" class="form-control @error('password_confirmation') is-invalid @enderror" />
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="form-group col-12">
                                    <label for="profile_picture">Ảnh đại diện</label>
                                    <input type="file" name="avatar" id="ProfilePicture" accept="image/*" class="form-control-file" />
                                    <div id="imagePreview" class="image-preview" style="margin-top: 10px; display: flex; justify-content: center; border-radius: 50%;  padding: 5px;">
                                        <!-- Hình ảnh xem trước sẽ được hiển thị ở đây -->
                                    </div>
                                </div> --}}
                                <div class="form-group col-12">
                                    <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                        {{-- <div class="remember-check customCheckbox">
                                            <input id="remember" name="remember" type="checkbox" value="remember" />
                                            <label for="remember">Ghi nhớ tôi</label>
                                        </div> --}}
                                        {{-- <a href="{{ route('forgot-password') }}">Quên mật khẩu?</a> --}}
                                    </div>
                                </div>
                                <div class="form-group col-12 mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">Đăng ký</button>
                                </div>
                            </div>

                            {{-- <div class="login-divide"><span class="login-divide-text">HOẶC</span></div>

                            <p class="text-center fs-6 text-muted mb-3">Đăng nhập bằng tài khoản mạng xã hội</p>
                            <div class="login-social d-flex justify-content-center">
                                <a class="social-link facebook rounded-5 d-flex justify-content-center" href="#"><i class="icon anm anm-facebook-f me-2 mt-1"></i> Facebook</a>
                                <a class="social-link google rounded-5 d-flex justify-content-center" href="{{route('google.login')}} "><i class="icon anm anm-google-plus-g me-2 mt-1"></i> Google</a>
                                <a class="social-link twitter rounded-5 d-flex justify-content-center" href="#"><i class="icon anm anm-twitter me-2 mt-1"></i> Twitter</a>
                            </div> --}}

                            <div class="login-signup-text mt-4 mb-2 fs-6 text-center text-muted">Bạn đã có tài khoản?
                                <a href="{{ route('login') }}" class="btn-link">Đăng nhập ngay</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
