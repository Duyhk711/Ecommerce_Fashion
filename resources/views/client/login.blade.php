@extends('layouts.client')
@section('title')
    Đăng nhập
@endsection
@section('css')
    <style>
        .login-social {
            margin-top: 20px;
        }

        .social-link {
            display: inline-block;
            width: 220px;
            margin: 0 10px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .social-link i {
            font-size: 18px;
            margin-right: 8px;
        }

        .otp-email {
            background-color: #4CAF50; /* Green */
            border: 1px solid #4CAF50;
        }

        .otp-email:hover {
            background-color: #45a049;
            border-color: #45a049;
        }

        .otp-phone {
            background-color: #2196F3; /* Blue */
            border: 1px solid #2196F3;
        }

        .otp-phone:hover {
            background-color: #1976D2;
            border-color: #1976D2;
        }

        /* Icon adjustments for better spacing */
        .social-link .icon {
            vertical-align: middle;
        }
    </style>
@endsection

@section('content')
    @include('client.component.page_header')
    <!--Main Content-->
    <div class="container">
        <div class="login-register pt-2">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <div class="inner h-100">
                        <form method="post" action="{{ route('postLogin') }}" class="customer-form" id="loginForm">
                            @csrf
                            <h2 class="text-center fs-4 mb-3">Đăng Nhập</h2>
                            <p class="text-center mb-4">Nếu bạn đã có tài khoản, hãy đăng nhập.</p>
                            <p class="text-muted"><small><span class="required"></span> (Các trường có dấu <span class="required">*</span> là bắt buộc.)</small></p>

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
                                        id="password" class="form-control @error('password') is-invalid @enderror" required />
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
                                        <a href="{{ route('forgot-password') }}">Quên mật khẩu?</a>
                                    </div>
                                </div>
                                <div class="form-group col-12 mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">Đăng Nhập</button>
                                </div>
                            </div>

                            <div class="login-divide"><span class="login-divide-text">HOẶC</span></div>

                            <p class="text-center fs-6 text-muted mb-3">Đăng nhập bằng:</p>
                            <div class="login-social d-flex justify-content-center">
                                <a class="social-link otp-email rounded-5 d-flex justify-content-center" href="{{ route('login-otp-email') }}">
                                    <i class="icon anm anm-envelope me-2 mt-1"></i> OTP Email
                                </a>
                                {{-- <a class="social-link otp-phone rounded-5 d-flex justify-content-center" href=" {{route('login-otp-phone')}} ">
                                    <i class="icon anm anm-phone me-2"></i> OTP qua Điện thoại
                                </a> --}}
                                <a class="social-link google rounded-5 d-flex justify-content-center" href="{{route('google.login')}} "><i class="icon anm anm-google-plus-g me-2 mt-1"></i> Google</a>
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

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Ngăn chặn form submit mặc định

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Kiểm tra tính hợp lệ của email và password
            if (!email || !password) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng điền đầy đủ thông tin!',
                });
                return;
            }

            // Gửi AJAX request
            fetch("{{ route('postLogin') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ email, password })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        // Hiển thị thông báo lỗi từ server
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: data.message || 'Có lỗi xảy ra. Vui lòng thử lại.',
                        });
                    });
                }
                return response.json();
            })
            .then(data => {

                if (data.success) {
                    window.location.href = data.redirect;
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Email hoặc mật khẩu không chính xác!',
                });
                console.error('Error:', error);
            });
        });
    </script>
@endsection
