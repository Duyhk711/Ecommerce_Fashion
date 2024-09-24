<!DOCTYPE html>
<html class="no-js" lang="en">

<!-- Mirrored from www.annimexweb.com/items/hema/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Aug 2024 15:16:15 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- CSS MENU --}}
    <link rel="stylesheet" href="{{asset('client/css/menu.css')}}">
    <!-- Title Of Site -->
    <title>Hema - Multipurpose eCommerce Bootstrap 5 Html Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('client/images/favicon.png') }}" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('client/css/plugins.css') }} ">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('client/css/style-min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/responsive.css') }}">
    @yield('css')
</head>

<body class="template-index index-demo1">
    <!--Page Wrapper-->
    <div class="page-wrapper">
        <!--Marquee Text-->
        {{-- <div class="topbar-slider clearfix">
            <div class="container-fluid">
                <div class="marquee-text">
                    <div class="top-info-bar d-flex">
                        <div class="flex-item center">
                            <a href="#">
                                <span> <i class="anm anm-worldwide"></i> BUY ONLINE PICK UP IN STORE</span>
                                <span> <i class="anm anm-truck-l"></i> FREE WORLDWIDE SHIPPING ON ALL ORDERS ABOVE
                                    $100</span>
                                <span> <i class="anm anm-redo-ar"></i> EXTENDED RETURN UNTIL 30 DAYS</span>
                            </a>
                        </div>
                        <div class="flex-item center">
                            <a href="#">
                                <span> <i class="anm anm-worldwide"></i> BUY ONLINE PICK UP IN STORE</span>
                                <span> <i class="anm anm-truck-l"></i> FREE WORLDWIDE SHIPPING ON ALL ORDERS ABOVE
                                    $100</span>
                                <span> <i class="anm anm-redo-ar"></i> EXTENDED RETURN UNTIL 30 DAYS</span>
                            </a>
                        </div>
                        <div class="flex-item center">
                            <a href="#">
                                <span> <i class="anm anm-worldwide"></i> BUY ONLINE PICK UP IN STORE</span>
                                <span> <i class="anm anm-truck-l"></i> FREE WORLDWIDE SHIPPING ON ALL ORDERS ABOVE
                                    $100</span>
                                <span> <i class="anm anm-redo-ar"></i> EXTENDED RETURN UNTIL 30 DAYS</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--End Marquee Text-->

        @include('client.component.header')

        <div id="page-content">
            <!-- Body Container -->

            {{-- main content --}}
                @yield('content')
            {{-- end main --}}
            <!-- End Body Container -->
        </div>
        @include('client.component.footer')


        @include('client.component.menubar_mobile')


        <!--Scoll Top-->
        <div id="site-scroll"><i class="icon anm anm-arw-up"></i></div>
        <!--End Scoll Top-->

        @include('client.component.mini_cart')

        @yield('modal')


        <!-- Including Jquery/Javascript -->
         <!-- Main JS -->
         <script src="{{ asset('client/js/main.js') }}"></script>
        <!-- Plugins JS -->
        <script src="{{ asset('client/js/plugins.js') }}"></script>
       
        @yield('js')

    </div>
    <!--End Page Wrapper-->
</body>

<!-- Mirrored from www.annimexweb.com/items/hema/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Aug 2024 15:17:37 GMT -->

</html>
