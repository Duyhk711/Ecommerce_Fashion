<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Dashmix - Bootstrap 5 Admin Template &amp; UI Framework</title>
    <meta name="description" content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="index, follow">
    <link rel="shortcut icon" href="{{ asset('admin/media/favicons/favicon.png') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('admin/css/dashmix.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    {{-- @yield('css')
    @vite(['resources/sass/main.scss', 'resources/js/dashmix/app.js']) --}}
</head>

<body>
<div id="page-container">
    <main id="main-container">
        <div class="bg-image" style="background-image: url('{{ asset('admin/media/photos/photo19@2x.jpg') }}');">
            <div class="row g-0 justify-content-center bg-primary-dark-op">
                <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                    <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                        <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
                            <div class="mb-2 text-center">
                                <a class="link-fx fw-bold fs-1" href="#">
                                    <span class="smini-visible">
                                        {{-- D<span class="opacity-75">x</span> --}}
                                        Poly
                                    </span>
                                    <span class="smini-hidden">
                                        Poly<span class="opacity-75">Fashion</span>
                                    </span>
                                </a>
                                <p class="text-uppercase fw-bold fs-sm text-muted">Đăng nhập</p>
                            </div>
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
                            <form class="js-validation-signin" action="{{ route('admin.postAdminLogin') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <div class="input-group input-group-lg">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="login-username" name="email" placeholder="Email" value="{{ old('email') }}" >
                                        <span class="input-group-text">
                                            <i class="fa fa-user-circle"></i>
                                        </span>
                                    </div>
                                    @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mb-4">
                                    <div class="input-group input-group-lg">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="login-password" name="password" placeholder="Password" >
                                        <span class="input-group-text">
                                            <i class="fa fa-asterisk"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-start mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="login-remember-me" name="login-remember-me" checked>
                                        <label class="form-check-label" for="login-remember-me">Ghi nhớ mật khẩu</label>
                                    </div>
                                    <div class="fw-semibold fs-sm py-1">
                                        <a href="{{ route('admin.forgot-password') }}">Quên mật khẩu</a>
                                    </div>
                                </div>
                                <div class="text-center mb-4">
                                    <button type="submit" class="btn btn-hero btn-primary">
                                        <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> Đăng nhập
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="block-content bg-body">
                            <div class="d-flex justify-content-center text-center push">
                                <a class="item item-circle item-tiny me-1 bg-default" data-toggle="theme" data-theme="default" href="#"></a>
                                <a class="item item-circle item-tiny me-1 bg-xwork" data-toggle="theme" data-theme="{{ asset('admin/css/themes/xwork.min.css') }}" href="#"></a>
                                <a class="item item-circle item-tiny me-1 bg-xmodern" data-toggle="theme" data-theme="{{ asset('admin/css/themes/xmodern.min.css') }}" href="#"></a>
                                <a class="item item-circle item-tiny me-1 bg-xeco" data-toggle="theme" data-theme="{{ asset('admin/css/themes/xeco.min.css') }}" href="#"></a>
                                <a class="item item-circle item-tiny me-1 bg-xsmooth" data-toggle="theme" data-theme="{{ asset('admin/css/themes/xsmooth.min.css') }}" href="#"></a>
                                <a class="item item-circle item-tiny me-1 bg-xinspire" data-toggle="theme" data-theme="{{ asset('admin/css/themes/xinspire.min.css') }}" href="#"></a>
                                <a class="item item-circle item-tiny me-1 bg-xdream" data-toggle="theme" data-theme="{{ asset('admin/css/themes/xdream.min.css') }}" href="#"></a>
                                <a class="item item-circle item-tiny me-1 bg-xpro" data-toggle="theme" data-theme="{{ asset('admin/css/themes/xpro.min.css') }}" href="#"></a>
                                <a class="item item-circle item-tiny bg-xplay" data-toggle="theme" data-theme="{{ asset('admin/css/themes/xplay.min.css') }}" href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="{{ asset('admin/js/dashmix.app.min.js')}}"></script>
<script src="{{ asset('admin/js/lib/jquery.min.js')}}"></script>
<script src="{{ asset('admin/js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('admin/js/pages/op_auth_signin.min.js')}}"></script>


</body>
</html>
