<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Dashmix - Đặt Lại Mật Khẩu</title>
    <link rel="shortcut icon" href="{{ asset('admin/media/favicons/favicon.png') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('admin/css/dashmix.min.css') }}">
</head>
<body>
    <div id="page-container">
        <main id="main-container">
            <div class="bg-image" style="background-image: url('{{ asset('admin/media/photos/photo16@2x.jpg') }}');">
                <div class="row g-0 justify-content-center bg-black-75">
                    <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                        <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                            <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                                <div class="mb-2 text-center">
                                    <h2 class="text-uppercase fw-bold fs-4">Đặt Lại Mật Khẩu</h2>
                                    <p class="text-muted">Nhập mật khẩu mới của bạn dưới đây.</p>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="post" action="{{ route('admin.reset-password') }}" class="customer-form">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="password">Mật khẩu mới<span class="required">*</span></label>
                                        <div class="input-group input-group-lg">
                                            <input type="password" name="password" placeholder="Nhập mật khẩu mới" id="password" class="form-control"/>
                                        </div>
                                        {{-- @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                    <div class="mb-4">
                                        <label for="password_confirmation">Xác nhận mật khẩu<span class="required">*</span></label>
                                        <div class="input-group input-group-lg">
                                            <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" id="password_confirmation" class="form-control"  />
                                        </div>
                                        {{-- @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                        @enderror --}}
                                    </div>
                                    <div class="text-center mb-4">
                                        <input type="submit" class="btn btn-hero btn-primary" value="Đặt lại mật khẩu" />
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('admin.loginAdmin') }}" class="d-flex justify-content-center btn-link">
                                            <i class="icon anm anm-angle-left-r me-2"></i> Trở về Đăng Nhập
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script>
    <script src="{{ asset('admin/js/lib/jquery.min.js') }}"></script>
</body>
</html>
