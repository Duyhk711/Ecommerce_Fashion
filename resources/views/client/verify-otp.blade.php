@extends('layouts.client')
@section('title')
    Xác thực OTP
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
                            <form method="post" action="{{ route('verify-otp') }}" class="customer-form">
                                @csrf
                                <h2 class="text-center fs-4 mb-3">Nhập Mã Xác Minh</h2>

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
                                    <div class="form-group col-12 mb-4">
                                        <label for="otp">Mã xác minh<span class="required">*</span></label>
                                        <input type="text" name="otp" placeholder="Nhập mã xác minh" id="otp"
                                            class="form-control @error('otp') is-invalid @enderror"
                                            value="{{ old('otp') }}" required />
                                        @error('otp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <div id="resend-container" class="mt-3">
                                            <span id="countdown" class="text-muted">Gửi lại mã sau: <strong>60</strong>
                                                giây</span>
                                            <button id="resend-button" class="btn btn-link p-0 d-none">Gửi lại mã</button>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 mb-0">
                                        <div
                                            class="login-remember-forgot d-flex justify-content-between align-items-center">
                                            <input type="submit" class="btn btn-primary btn-lg" value="Xác Minh" />
                                            <a href="{{ route('send-otp') }}"
                                                class="d-flex justify-content-center btn-link">
                                                <i class="icon anm anm-angle-left-r me-2"></i> Quay lại Gửi OTP
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countdownElement = document.getElementById('countdown');
            const resendButton = document.getElementById('resend-button');
            let timeLeft = 10; // Thời gian đếm ngược (giây)

            // Bộ đếm thời gian
            const timer = setInterval(() => {
                timeLeft--;
                countdownElement.innerHTML = `Gửi lại mã sau: <strong>${timeLeft}</strong> giây`;
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    countdownElement.classList.add('d-none'); // Ẩn đếm ngược
                    resendButton.classList.remove('d-none'); // Hiện nút gửi lại mã
                }
            }, 1000);

            // Xử lý sự kiện khi bấm nút gửi lại mã
            resendButton.addEventListener('click', function(e) {
                e.preventDefault();
                resendButton.classList.add('d-none'); // Ẩn nút gửi lại mã
                countdownElement.classList.remove('d-none'); // Hiện lại đếm ngược
                timeLeft = 60; // Đặt lại thời gian đếm ngược

                // Gửi yêu cầu gửi lại mã OTP
                fetch('{{ route('resend-otp') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            email: '{{ session('email') }}' // Lấy email từ session nếu nó đã được lưu từ lúc gửi OTP lần đầu
                        })

                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            countdownElement.innerHTML =
                                `Gửi lại mã sau: <strong>${timeLeft}</strong> giây`;
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: 'Mã OTP đã được gửi lại!',
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Thất bại',
                                text: data.message || 'Có lỗi xảy ra!',
                            });
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: 'Không thể gửi lại mã OTP. Vui lòng thử lại.',
                        });
                    });

                // Bắt đầu lại bộ đếm
                const newTimer = setInterval(() => {
                    timeLeft--;
                    countdownElement.innerHTML =
                    `Gửi lại mã sau: <strong>${timeLeft}</strong> giây`;
                    if (timeLeft <= 0) {
                        clearInterval(newTimer);
                        countdownElement.classList.add('d-none');
                        resendButton.classList.remove('d-none');
                    }
                }, 1000);
            });
        });
    </script>
@endsection
