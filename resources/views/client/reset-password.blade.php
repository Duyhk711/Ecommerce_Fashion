    @extends('layouts.client')
    @section('title')
        Lấy lại mật khẩu
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
                                <form method="post" action="{{ route('reset-password') }}" class="customer-form">
                                    @csrf
                                    <h2 class="text-center fs-4 mb-3">Đặt Lại Mật Khẩu</h2>
                                    <p class="text-center mb-4">Nhập mật khẩu mới của bạn dưới đây.</p>
                                    <div class="form-row">
                                        <div class="form-group col-12 mb-4">
                                            <label for="password">Mật khẩu mới<span class="required">*</span></label>
                                            <input type="password" name="password" placeholder="Nhập mật khẩu mới" id="password" class="form-control"  />
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12 mb-4">
                                            <label for="password_confirmation">Xác nhận mật khẩu<span class="required">*</span></label>
                                            <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" id="password_confirmation" class="form-control" />
                                        </div>
                                        <div class="form-group col-12 mb-0">
                                            <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                                <input type="submit" class="btn btn-primary btn-lg" value="Đặt lại mật khẩu" />
                                                <a href="{{ route('login') }}" class="d-flex justify-content-center btn-link">
                                                    <i class="icon anm anm-angle-left-r me-2"></i> Trở về Đăng Nhập
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
