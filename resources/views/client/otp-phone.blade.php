@extends('layouts.client')
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
            background-color: #4CAF50;
            border: 1px solid #4CAF50;
        }

        .otp-email:hover {
            background-color: #45a049;
            border-color: #45a049;
        }

        /* Icon adjustments for better spacing */
        .social-link .icon {
            vertical-align: middle;
        }

        /* Modal custom styles */
        .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            /* Full height */
        }

        .modal-content {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
                        <form method="POST" action="{{ route('send.otp.phone') }}" class="customer-form">
                            @csrf
                            <h2 class="text-center fs-4 mb-3">Đăng Nhập bằng OTP qua số điện thoại</h2>
                            <p class="text-center mb-4">Vui lòng nhập số điện thoại để nhận mã OTP.</p>
                            <p class=" text-muted"><small><span class="required"></span> (Các trường có dấu <span
                                        class="required">*</span> là bắt buộc.)</small></p>

                            <!-- Display success message -->
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
                                    <label for="phone">Số điện thoại <span class="required">*</span></label>
                                    <input type="text" name="phone" placeholder="Số điện thoại" id="phone"
                                           value="{{ old('phone') }}"
                                           class="form-control @error('phone') is-invalid @enderror" required />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div id="recaptcha-container"></div>
                                <div class="form-group col-12 mb-0 mt-3 ">
                                    <button type="button" class="btn btn-primary btn-lg w-100" id="sendOtpButton">Gửi
                                        OTP</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for OTP input -->
    <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpModalLabel">Nhập Mã OTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('verify-otp-email') }}">
                        @csrf
                        <div class="form-group">
                            <label for="otp">Mã OTP <span class="required">*</span></label>
                            <input type="text" name="otp" placeholder="Nhập mã OTP" id="otp"
                                   class="form-control @error('otp') is-invalid @enderror" required />
                            @error('otp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Xác nhận OTP</button>
                    </form>
                    <div class="mt-3 text-center">
                        <span id="otpTimer">Bạn chưa nhận được OTP? Vui lòng thử lại mã <span id="timeRemaining">60</span> giây</span>
                        <br>
                        <button id="resendOtpButton" class="btn btn-link mt-2" disabled>Gửi lại OTP</button>
                    </div>
                </div>`
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-auth-compat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyAKJcQ5FML4b9N5vBqEn3qDS7Ox4qoUDNI",
            authDomain: "polyshop-e638c.firebaseapp.com",
            projectId: "polyshop-e638c",
            storageBucket: "polyshop-e638c.appspot.com",
            messagingSenderId: "586602343726",
            appId: "1:586602343726:web:ed370e205e440baa72debf",
            measurementId: "G-11REHLJF8V"
        };
        firebase.initializeApp(firebaseConfig);

        let recaptchaVerifier;

        function render() {
            recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                size: 'normal',
                callback: (response) => {
                    // Khi người dùng đã tích vào reCAPTCHA
                    document.getElementById('sendOtpButton').disabled = false; // Kích hoạt nút gửi OTP
                },
                'expired-callback': () => {
                    // Khi reCAPTCHA hết hạn, vô hiệu hóa nút gửi OTP
                    document.getElementById('sendOtpButton').disabled = true;
                }
            });
            recaptchaVerifier.render();
        }

        document.addEventListener('DOMContentLoaded', function() {
            render();
            document.getElementById('sendOtpButton').disabled = true; // Khởi tạo nút gửi OTP là vô hiệu hóa
        });
    </script>

    <script>
        document.getElementById('sendOtpButton').addEventListener('click', function () {
            const phoneInput = document.getElementById('phone').value;
            const formattedPhone = validateAndFormatPhone(phoneInput);

            if (formattedPhone) {
                fetch("{{ route('send.otp.phone') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ phone: formattedPhone })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Thành công', data.message, 'success');
                        $('#otpModal').modal('show');
                        startOtpTimer();
                    } else {
                        Swal.fire('Lỗi', data.message, 'error');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });

        document.getElementById('resendOtpButton').addEventListener('click', function () {
            Swal.fire({
                title: 'Đang gửi lại mã OTP...',
                text: 'Vui lòng chờ trong giây lát!',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            fetch("{{ route('resend.otp.phone') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();
                if (data.success) {
                    otpExpiryTime = 60;
                    startOtpTimer();
                    $('#otpModal').modal('show');
                } else {
                    Swal.fire('Lỗi', data.message, 'error');
                }
            })
            .catch(error => console.error('Error:', error));
        });

        function startOtpTimer() {
            let timeRemaining = 60;
            const interval = setInterval(() => {
                document.getElementById('timeRemaining').innerText = timeRemaining;
                timeRemaining--;
                if (timeRemaining < 0) {
                    clearInterval(interval);
                    document.getElementById('resendOtpButton').disabled = false;
                }else{
                    document.getElementById('resendOtpButton').disabled = true;
                }
            }, 1000);
        }

        function validateAndFormatPhone(phone) {
            const phonePattern = /^(0|\+84)[0-9]{9,10}$/; // Kiểm tra định dạng số điện thoại có mã quốc gia hoặc số bắt đầu bằng 0
            if (phonePattern.test(phone)) {
                // Nếu số điện thoại bắt đầu bằng 0, chuyển đổi sang mã quốc gia
                if (phone.startsWith('0')) {
                    return '+84' + phone.slice(1); // Chuyển đổi sang mã quốc gia Việt Nam
                }
                return phone; // Đã có mã quốc gia
            }
            Swal.fire('Lỗi', 'Số điện thoại không hợp lệ!', 'error');
            return null;
        }



    </script>

    <script>
        document.getElementById('otpModal form').addEventListener('submit', function (e) {
            e.preventDefault(); // Ngăn form reload trang
            const otpInput = document.getElementById('otp').value;

            fetch("{{ route('verifyOtpPhone') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ otp: otpInput })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success', data.message, 'success');
                    $('#otpModal').modal('hide'); // Đóng modal khi OTP đúng
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => console.error('Error:', error));
        });

    </script>
@endsection
