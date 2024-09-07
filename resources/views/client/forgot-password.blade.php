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
                            <form method="post" action="#" class="customer-form">
                                <h2 class="text-center fs-4 mb-3">Forgot Password</h2>
                                <p class="text-center mb-4">Please enter your email address below. You will receive a link
                                    to reset your password.</p>
                                <div class="form-row">
                                    <div class="form-group col-12 mb-4">
                                        <label for="CustomerEmail" class="d-none">Enter your email <span
                                                class="required">*</span></label>
                                        <input type="email" name="customer[email]" placeholder="Enter your email"
                                            id="CustomerEmail" value="" required />
                                    </div>
                                    <div class="form-group col-12 mb-0">
                                        <div
                                            class="login-remember-forgot d-flex justify-content-between align-items-center">
                                            <input type="submit" class="btn btn-primary btn-lg" value="Password Reset" />
                                            <a href="{{route('login')}}" class="d-flex-justify-center btn-link"><i
                                                    class="icon anm anm-angle-left-r me-2"></i> Back to Login</a>
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
