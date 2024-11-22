<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- CSS MENU --}}
    <link rel="stylesheet" href="{{ asset('client/css/menu.css') }}">
    <!-- Title Of Site -->
    <title>Fashion Poly Shop</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('client/images/title.png') }}" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('client/css/plugins.css') }} ">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('client/css/style-min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    @yield('css')
</head>

<body class="template-index index-demo1">
    <!--Page Wrapper-->
    <div class="page-wrapper">

        @include('client.component.header')

        <div id="page-content">
            <!-- Body Container -->

            {{-- main content --}}
            @yield('content')
            {{-- end main --}}
            <!-- End Body Container -->
        </div>

        @include('client.component.footer')


        <!--Scoll Top-->
        <div id="site-scroll"><i class="icon anm anm-arw-up"></i></div>
        <!--End Scoll Top-->

        @yield('modal')


        <!-- Including Jquery/Javascript -->
        <!-- Main JS -->
        <!-- Plugins JS -->
        <script src="{{ asset('client/js/plugins.js') }}"></script>

        <script src="{{ asset('client/js/main.js') }}"></script>
        @yield('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function filterCate() {
                let selectedCategories = [];

                // Lấy các danh mục đã chọn
                document.querySelectorAll('.category-filter.selected').forEach(item => {
                    selectedCategories.push(item.getAttribute('data-id'));
                });
                let params = new URLSearchParams();
                if (selectedCategories.length) {
                    params.append('categories', selectedCategories);
                }

                // Điều hướng đến URL mới với các tham số
                window.location.href = '/filterproduct?' + params.toString();
            }

            function validateCheckout(event) {
                const checkBox = document.getElementById('prTearm');

                if (!checkBox.checked) {
                    event.preventDefault(); // Prevent navigation
                    // Hiển thị popup lỗi với SweetAlert2
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Vui lòng đồng ý với các điều khoản và điều kiện trước khi tiến hành thanh toán.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
            }
        </script>

    </div>
    <!--End Page Wrapper-->
</body>

</html>
