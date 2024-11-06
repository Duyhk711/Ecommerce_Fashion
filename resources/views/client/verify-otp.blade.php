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
                                            class="form-control @error('otp') is-invalid @enderror" value="{{ old('otp') }}" required />
                                        @error('otp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 mb-0">
                                        <div class="login-remember-forgot d-flex justify-content-between align-items-center">
                                            <input type="submit" class="btn btn-primary btn-lg" value="Xác Minh" />
                                            <a href="{{ route('send-otp') }}" class="d-flex justify-content-center btn-link">
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
@endsection
