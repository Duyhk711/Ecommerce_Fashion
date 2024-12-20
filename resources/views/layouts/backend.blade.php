<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title')</title>
    <meta name="storage-url" content="{{ Storage::url('') }}">
    <meta name="description"
        content="Dashmix - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('admin/media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png"
        href="{{ asset('admin/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('admin/media/favicons/apple-touch-icon-180x180.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Modules -->

    @yield('css')
    @vite(['resources/sass/main.scss', 'resources/js/dashmix/app.js'])
    @vite(['resources/js/new_order_notify_admin.js'])
    @vite(['resources/js/new_user_notify_admin.js'])

</head>

<body>

    <div id="page-container"
        class="sidebar-o enable-page-overlay side-scroll page-header-fixed main-content-narrow fs-sm side-trans-enabled page-header-dark">
        <!-- Side Overlay-->
        <aside id="side-overlay">
            <!-- Side Header -->
            <div class="bg-image"
                style="background-image: url('{{ asset('admin/media/various/bg_side_overlay_header.jpg') }}');">
                <div class="bg-primary-op">
                    <div class="content-header">
                        <!-- User Avatar -->
                        <a class="img-link me-1" href="javascript:void(0)">
                            <img class="img-avatar img-avatar48" src="{{ asset('admin/media/avatars/avatar10.jpg') }}"
                                alt="">
                        </a>
                        <!-- END User Avatar -->

                        <!-- User Info -->
                        <div class="ms-2">
                            <a class="text-white fw-semibold" href="javascript:void(0)">George Taylor</a>
                            <div class="text-white-75 fs-sm">Full Stack Developer</div>
                        </div>
                        <!-- END User Info -->

                        <!-- Close Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="ms-auto text-white" href="javascript:void(0)" data-toggle="layout"
                            data-action="side_overlay_close">
                            <i class="fa fa-times-circle"></i>
                        </a>
                        <!-- END Close Side Overlay -->
                    </div>
                </div>
            </div>
            <!-- END Side Header -->

            <!-- Side Content -->
            <div class="content-side">
                <div class="block pull-x mb-0">
                    <!-- Sidebar -->
                    <div class="block-content block-content-sm block-content-full bg-body">
                        <span class="text-uppercase fs-sm fw-bold">Sidebar</span>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row g-sm text-center">
                            <div class="col-6 mb-1">
                                <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout"
                                    data-action="sidebar_style_dark" href="javascript:void(0)">Dark</a>
                            </div>
                            <div class="col-6 mb-1">
                                <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout"
                                    data-action="sidebar_style_light" href="javascript:void(0)">Light</a>
                            </div>
                        </div>
                    </div>
                    <!-- END Sidebar -->

                    <!-- Header -->
                    <div class="block-content block-content-sm block-content-full bg-body">
                        <span class="text-uppercase fs-sm fw-bold">Header</span>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row g-sm text-center mb-2">
                            <div class="col-6 mb-1">
                                <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout"
                                    data-action="header_style_dark" href="javascript:void(0)">Dark</a>
                            </div>
                            <div class="col-6 mb-1">
                                <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout"
                                    data-action="header_style_light" href="javascript:void(0)">Light</a>
                            </div>
                            <div class="col-6 mb-1">
                                <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout"
                                    data-action="header_mode_fixed" href="javascript:void(0)">Fixed</a>
                            </div>
                            <div class="col-6 mb-1">
                                <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout"
                                    data-action="header_mode_static" href="javascript:void(0)">Static</a>
                            </div>
                        </div>
                    </div>
                    <!-- END Header -->

                    <!-- Content -->
                    <div class="block-content block-content-sm block-content-full bg-body">
                        <span class="text-uppercase fs-sm fw-bold">Content</span>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row g-sm text-center">
                            <div class="col-6 mb-1">
                                <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout"
                                    data-action="content_layout_boxed" href="javascript:void(0)">Boxed</a>
                            </div>
                            <div class="col-6 mb-1">
                                <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout"
                                    data-action="content_layout_narrow" href="javascript:void(0)">Narrow</a>
                            </div>
                            <div class="col-12 mb-1">
                                <a class="d-block py-3 bg-body-dark fw-semibold text-dark" data-toggle="layout"
                                    data-action="content_layout_full_width" href="javascript:void(0)">Full Width</a>
                            </div>
                        </div>
                    </div>
                    <!-- END Content -->
                </div>
                <div class="block pull-x mb-0">
                    <!-- Content -->
                    <div class="block-content block-content-sm block-content-full bg-body">
                        <span class="text-uppercase fs-sm fw-bold">Heading</span>
                    </div>
                    <div class="block-content">
                        <p>
                            Content..
                        </p>
                    </div>
                    <!-- END Content -->
                </div>
            </div>
            <!-- END Side Content -->
        </aside>
        <!-- END Side Overlay -->

        <!-- Sidebar -->
        <nav id="sidebar" aria-label="Main Navigation">
            <!-- Side Header -->
            <div class="bg-header-dark">
                <div class="content-header bg-white-5">
                    <!-- Logo -->
                    <a class="fw-semibold text-white tracking-wide" href="{{route('admin.dashboard')}}">
                        <span class="smini-visible">
                            {{-- D<span class="opacity-75">x</span> --}}
                            Poly
                        </span>
                        <span class="smini-hidden">
                            Poly<span class="opacity-75">Fashion</span>
                        </span>
                    </a>
                    <!-- END Logo -->

                    <!-- Options -->
                    <div>
                        <!-- Toggle Sidebar Style -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <!-- Class Toggle, functionality initialized in Helpers.dmToggleClass() -->
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                            data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on"
                            onclick="Dashmix.layout('sidebar_style_toggle');Dashmix.layout('header_style_toggle');">
                            <i class="fa fa-toggle-on" id="sidebar-style-toggler"></i>
                        </button>
                        <!-- END Toggle Sidebar Style -->

                        <!-- Dark Mode -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                            data-target="#dark-mode-toggler" data-class="far fa"
                            onclick="Dashmix.layout('dark_mode_toggle');">
                            <i class="far fa-moon" id="dark-mode-toggler"></i>
                        </button>
                        <!-- END Dark Mode -->

                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout"
                            data-action="sidebar_close">
                            <i class="fa fa-times-circle"></i>
                        </button>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Options -->
                </div>
            </div>
            <!-- END Side Header -->

            <!-- Sidebar Scrolling -->
            <div class="js-sidebar-scroll  ">
                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('admin/dashboard') ? ' active' : '' }}"
                                href="/admin/dashboard">
                                <i class="nav-main-link-icon fa fa-location-arrow"></i>
                                <span class="nav-main-link-name">Dashboard</span>
                                {{-- <span class="nav-main-link-badge badge rounded-pill bg-primary">5</span> --}}
                            </a>
                        </li>
                        {{-- <li class="nav-main-heading">Various</li> --}}
                        {{-- SAN PHAM --}}

                        @if (Auth::user()->can('xem danh sách sản phâm') ||
                                Auth::user()->can('Xóa sản phẩm') ||
                                Auth::user()->can('Chỉnh sửa sản phẩm') ||
                                Auth::user()->can('Thêm mới sản phẩm') ||
                                Auth::user()->can('Khôi phục sản phẩm') ||
                                Auth::user()->can('xem danh sách danh mục') ||
                                Auth::user()->can('Xóa danh mục') ||
                                Auth::user()->can('Chỉnh sửa danh mục') ||
                                Auth::user()->can('Thêm mới danh mục') ||
                                Auth::user()->can('Kích hoạt danh mục'))
                            <li
                                class="nav-main-item{{ request()->is('admin/products*') || request()->is('admin/catalogues') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                    aria-haspopup="true"
                                    aria-expanded="{{ request()->is('admin/products*') || request()->is('admin/products') ? 'true' : 'false' }}"
                                    href="#">
                                    <i class="nav-main-link-icon fa fa-box"></i>
                                    <span class="nav-main-link-name">Quản lý Sản phẩm</span>
                                </a>
                                <ul
                                    class="nav-main-submenu{{ request()->is('admin/products*') || request()->is('admin/products') ? ' show' : '' }}">
                                    @if (Auth::user()->can('xem danh sách sản phâm') ||
                                            Auth::user()->can('Xóa sản phẩm') ||
                                            Auth::user()->can('Chỉnh sửa sản phẩm') ||
                                            Auth::user()->can('Thêm mới sản phẩm') ||
                                            Auth::user()->can('Khôi phục sản phẩm'))
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('admin/products') ? ' active' : '' }}"
                                                href="{{ route('admin.products.index') }}">
                                                <span class="nav-main-link-name">Sản phẩm</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->can('xem danh sách danh mục') ||
                                            Auth::user()->can('Xóa danh mục') ||
                                            Auth::user()->can('Chỉnh sửa danh mục') ||
                                            Auth::user()->can('Thêm mới danh mục') ||
                                            Auth::user()->can('Kích hoạt danh mục'))
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('admin/catalogues') ? ' active' : '' }}"
                                                href="{{ route('admin.catalogues.index') }}">
                                                <span class="nav-main-link-name">Danh mục sản phẩm</span>
                                            </a>
                                        </li>
                                    @endif


                                </ul>
                            </li>
                        @endif


                        {{-- THUOC TINH --}}
                        @if (Auth::user()->can('xem danh sách thuộc tính') ||
                                Auth::user()->can('Thêm mới thuộc tính') ||
                                Auth::user()->can('xem danh sách giá trị thuộc tính') ||
                                Auth::user()->can('Chỉnh sửa giá trị thuộc tính') ||
                                Auth::user()->can('Xóa giá trị thuộc tính') ||
                                Auth::user()->can('Thêm mới giá trị thuộc tính'))
                            <li
                                class="nav-main-item{{ request()->is('admin/attributes*') || request()->is('admin/attribute_values') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                    aria-haspopup="true"
                                    aria-expanded="{{ request()->is('admin/attributes*') ? 'true' : 'false' }}"
                                    href="#">
                                    <i class="nav-main-link-icon fa fa-tags"></i>
                                    <span class="nav-main-link-name">Quản lý Thuộc tính</span>
                                </a>
                                <ul class="nav-main-submenu{{ request()->is('admin/attributes*') ? ' show' : '' }}">
                                    @if (Auth::user()->can('xem danh sách thuộc tính') || Auth::user()->can('Thêm mới thuộc tính'))
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('admin/attributes') ? ' active' : '' }}"
                                                href="{{ route('admin.attributes.index') }}">
                                                <span class="nav-main-link-name">Thuộc tính biến thể</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::user()->can('xem danh sách giá trị thuộc tính') ||
                                            Auth::user()->can('Chỉnh sửa giá trị thuộc tính') ||
                                            Auth::user()->can('Xóa giá trị thuộc tính') ||
                                            Auth::user()->can('Thêm mới giá trị thuộc tính'))
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('admin/attribute_values') ? ' active' : '' }}"
                                                href="{{ route('admin.attribute_values.index') }}">
                                                <span class="nav-main-link-name">Giá trị thuộc tính</span>
                                            </a>
                                        </li>
                                    @endif


                                </ul>
                            </li>
                        @endif

                        @if (Auth::user()->can('xem danh sách khách hàng') ||
                                Auth::user()->can('xem danh sách nhân viên') ||
                                Auth::user()->can('xem danh sách vai trò'))
                            {{-- USER --}}
                            <li
                                class="nav-main-item{{ request()->is('admin/clients*') || request()->is('admin/roles') || request()->is('admin/staffs') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                    aria-haspopup="true"
                                    aria-expanded="{{ request()->is('admin/customers*') ? 'true' : 'false' }}"
                                    href="#">
                                    <i class="nav-main-link-icon fa fa-users"></i>
                                    <span class="nav-main-link-name">Quản lý Người dùng</span>
                                </a>
                                <ul class="nav-main-submenu{{ request()->is('admin/users*') ? ' show' : '' }}">
                                    @can('xem danh sách khách hàng')
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('admin/clients') ? ' active' : '' }}"
                                                href="{{ route('admin.users.clients') }}">
                                                <span class="nav-main-link-name">Khách hàng</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('xem danh sách nhân viên')
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('admin/staffs') ? ' active' : '' }}"
                                                href="{{ route('admin.users.staffs') }}">
                                                <span class="nav-main-link-name">Nhân viên</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('phân quyền')
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('admin/roles') ? ' active' : '' }}"
                                                href="{{ route('admin.users.roles') }}">
                                                <span class="nav-main-link-name">Vai trò</span>
                                            </a>
                                        </li>
                                    @endcan



                                </ul>
                            </li>
                        @endif

                        {{-- DON HANG --}}
                        @if (Auth::user()->can('xem danh sách đơn hàng') || Auth::user()->can('xem danh sách khuyến mãi'))
                            <li
                                class="nav-main-item{{ request()->is('admin/orders*') || request()->is('admin/vouchers*') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                    aria-haspopup="true"
                                    aria-expanded="{{ request()->is('admin/orders*') ? 'true' : 'false' }}"
                                    href="#">
                                    <i class="nav-main-link-icon fa fa-receipt"></i>
                                    <span class="nav-main-link-name">Quản lý Đơn hàng</span>
                                </a>
                                <ul class="nav-main-submenu{{ request()->is('admin/orders*') ? ' show' : '' }}">
                                    @can('xem danh sách đơn hàng')
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('admin/orders') ? ' active' : '' }}"
                                                href="{{ route('admin.orders.index') }}">
                                                <span class="nav-main-link-name">Đơn hàng</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('xem danh sách khuyến mãi')
                                        <li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('admin/vouchers') ? ' active' : '' }}"
                                                href="{{ route('admin.vouchers.index') }}">
                                                <span class="nav-main-link-name">Khuyến mãi</span>
                                            </a>
                                        </li>
                                    @endcan


                                </ul>
                            </li>
                        @endif



                        {{-- BANNER --}}
                        @can('xem danh sách banner')
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/banners') ? ' active' : '' }}"
                                    href="{{ route('admin.banners.index') }}">
                                    <i class="nav-main-link-icon fa fa-image"></i>
                                    <span class="nav-main-link-name">Quản lý banner</span>
                                </a>
                            </li>
                        @endcan

                        {{-- COMMENT --}}
                        @can('xem danh sách bình luận')
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/comments') ? ' active' : '' }}"
                                    href="{{ route('admin.comments.index') }}">
                                    <i class="nav-main-link-icon fa fa-comments"></i>
                                    <span class="nav-main-link-name">Quản lý bình luận</span>
                                </a>
                            </li>
                        @endcan


                        {{-- MESSAGE --}}
                        @can('xem tin nhắn khách hàng')
                            <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('admin/chats') ? ' active' : '' }}"
                                    href="{{ route('admin.admin.chats') }}">
                                    <i class="nav-main-link-icon fa fa-envelope"></i>
                                    <span class="nav-main-link-name">Tin nhắn</span>
                                </a>
                            </li>
                        @endcan

                        {{-- THONGKE --}}
                        @can('xem thống kê')
                            <li class="nav-main-item{{ request()->is('admin/statistics*') ? ' open' : '' }}">
                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                    aria-expanded="{{ request()->is('admin/statistics*') ? 'true' : 'false' }}"
                                    href="#">
                                    <i class="nav-main-link-icon fa fa-keyboard"></i>
                                    <span class="nav-main-link-name">Thống kê</span>
                                </a>
                                {{-- <ul class="nav-main-submenu{{ request()->is('admin/statistics*') ? ' show' : '' }}">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/statistics') ? ' active' : '' }}"
                                            href="{{ route('admin.statistics.index') }}">
                                            <span class="nav-main-link-name">Thống kê</span>
                                        </a>
                                    </li>
                                </ul> --}}
                                <ul class="nav-main-submenu{{ request()->is('admin/statistics*') ? ' show' : '' }}">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/statistics') ? ' active' : '' }}"
                                            href="{{ route('admin.statistics.revenues') }}">
                                            <span class="nav-main-link-name">Doanh thu</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav-main-submenu{{ request()->is('admin/statistics*') ? ' show' : '' }}">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/statistics') ? ' active' : '' }}"
                                            href="{{ route('admin.statistics.orders') }}">
                                            <span class="nav-main-link-name">Đơn hàng</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav-main-submenu{{ request()->is('admin/statistics*') ? ' show' : '' }}">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/statistics') ? ' active' : '' }}"
                                            href="{{ route('admin.statistics.vouchers') }}">
                                            <span class="nav-main-link-name">Khuyến mãi</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav-main-submenu{{ request()->is('admin/statistics*') ? ' show' : '' }}">
                                    <li class="nav-main-item">
                                        <a class="nav-main-link{{ request()->is('admin/statistics') ? ' active' : '' }}"
                                            href="{{ route('admin.statistics.customer') }}">
                                            <span class="nav-main-link-name">Khách hàng</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan



                        {{-- <li class="nav-main-heading">More</li> --}}
                        <li class="nav-main-item">
                            <a class="nav-main-link" href="/">
                                <i class="nav-main-link-icon fa fa-globe"></i>
                                <span class="nav-main-link-name">Website</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- END Sidebar Scrolling -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="space-x-1">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                    <button type="button" class="btn btn-alt-secondary" data-toggle="layout"
                        data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- END Toggle Sidebar -->

                    <!-- Open Search Section -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    {{-- <button type="button" class="btn btn-alt-secondary" data-toggle="layout"
                        data-action="header_search_on">
                        <i class="fa fa-fw opacity-50 fa-search"></i> <span
                            class="ms-1 d-none d-sm-inline-block">Search</span>
                    </button> --}}
                    <!-- END Open Search Section -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="space-x-1">
                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-user d-sm-none"></i>
                            @if (Auth::check())
                                <span class="d-none d-sm-inline-block">Xin chào: {{ Auth::user()->name }}</span>
                            @else
                                <span class="d-none d-sm-inline-block">Admin</span>
                            @endif

                            <i class="fa fa-fw fa-angle-down opacity-50 ms-1 d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                            <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3">
                                Tùy chọn
                            </div>
                            <div class="p-2">
                                <a class="dropdown-item" href="{{ route('admin.account-profile') }}">
                                    <i class="far fa-fw fa-user me-1"></i> Profile
                                </a>

                                <div role="separator" class="dropdown-divider"></div>

                                <!-- Toggle Side Overlay -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="layout"
                                    data-action="side_overlay_toggle">
                                    <i class="far fa-fw fa-building me-1"></i> Cài đặt
                                </a>
                                <!-- END Side Overlay -->

                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="far fa-fw fa-arrow-alt-circle-left me-1"></i> Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('admin.logoutAdmin') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END User Dropdown -->

                    <!-- Notifications Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-alt-secondary" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-bell"></i>
                            <span class="notification-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                @if(auth()->check())
                                    @php
                                        $adminNotifications = auth()->user()->unreadNotifications->where('data.category', 'admin');
                                    @endphp
                                    {{ $adminNotifications->count() }}
                                @else
                                    0
                                @endif
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-notifications-dropdown">
                            <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3">
                                Thông báo
                            </div>
                            <style>
                                .read {
                                    background-color: #ffffff !important;
                                }
                                .unread {
                                    background-color: rgb(255, 250, 244) !important;
                                }
                            </style>
                            <ul class="nav-items my-2" style="max-height: 325px; overflow-y: auto; width: 300px;">
                                @if(auth()->check())
                                    @php
                                        $adminNotifications = auth()->user()->notifications->where('data.category', 'admin');
                                        $type = auth()->user()->notifications;
                                    @endphp
                                    @if($adminNotifications->count() > 0)
                                    @foreach($adminNotifications as $notification)
                                        @php
                                            // Xác định icon dựa vào loại thông báo
                                            if ($notification->type === 'App\Notifications\CreateNewVoucherAdmin') {
                                                $icon = '<i class="fa fa-fw fa-plus-circle text-primary"></i>'; // Icon cho CreateNewVoucherAdmin
                                            } elseif ($notification->type === 'App\Notifications\CreateNewOrder') {
                                                $icon = '<i class="far fa-fw fa-file-alt me-1"></i>';
                                            } elseif ($notification->type === 'App\Notifications\NewUser') {
                                                $icon = '<i class="fa fa-fw fa-user-plus text-info"></i>';
                                            } elseif ($notification->type === 'App\Notifications\CreateProduct') {
                                                $icon = '<i class="fa fa-fw fa-plus-circle text-primary"></i>';
                                            } else {
                                                $icon = '<i class="fa fa-info-circle"></i>'; // Icon mặc định
                                            }
                                        @endphp

                                        <li class="{{ $notification->read_at ? 'read' : 'unread' }}" data-id="{{ $notification->id }}">
                                            <a class="d-flex text-dark py-2 mark-as-read" href="{{ $notification->data['link'] }}" data-url="{{ route('notifications.markAsRead', $notification->id) }}">
                                                <div class="flex-shrink-0 mx-3 mt-2">
                                                    {!! $icon !!}
                                                </div>
                                                <div class="flex-grow-1 fs-sm pe-2">
                                                    <div class="fw-semibold" style="max-width: 200px; word-wrap: break-word; white-space: pre-wrap; display: block;">{!! $notification->data['message'] !!}</div>
                                                    <div class="text-muted">{{ $notification->created_at->format('d-m-Y') }}</div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                    @else
                                        <li>Hiện tại bạn không có thông báo nào.</li> <!-- Nếu không có thông báo -->
                                    @endif
                                @endif
                                {{-- <li>
                                    <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 mx-3">
                                            <i class="fa fa-fw fa-user-plus text-info"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm pe-2">
                                            <div class="fw-semibold">New Subscriber was added! You now have 2580!
                                            </div>
                                            <div class="text-muted">10 min ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 mx-3">
                                            <i class="fa fa-fw fa-times-circle text-danger"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm pe-2">
                                            <div class="fw-semibold">Server backup failed to complete!</div>
                                            <div class="text-muted">30 min ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 mx-3">
                                            <i class="fa fa-fw fa-exclamation-circle text-warning"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm pe-2">
                                            <div class="fw-semibold">You are running out of space. Please consider
                                                upgrading your plan.</div>
                                            <div class="text-muted">1 hour ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="d-flex text-dark py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 mx-3">
                                            <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm pe-2">
                                            <div class="fw-semibold">New Sale! + $30</div>
                                            <div class="text-muted">2 hours ago</div>
                                        </div>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                    <!-- END Notifications Dropdown -->

                    <!-- Toggle Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-alt-secondary" data-toggle="layout"
                        data-action="side_overlay_toggle">
                        <i class="far fa-fw fa-list-alt"></i>
                    </button>
                    <!-- END Toggle Side Overlay -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header bg-header-dark">
                <div class="content-header">
                    <form class="w-100" action="/dashboard" method="POST">
                        @csrf
                        <div class="input-group">
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-alt-primary" data-toggle="layout"
                                data-action="header_search_off">
                                <i class="fa fa-fw fa-times-circle"></i>
                            </button>
                            <input type="text" class="form-control border-0" placeholder="Search or hit ESC.."
                                id="page-header-search-input" name="page-header-search-input">
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->

            <!-- Header Loader -->
            <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-header-dark">
                <div class="bg-white-10">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-sun fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            @yield('content')
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="bg-body-light">
            <div class="content py-0">
                <div class="row fs-sm">
                    <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-end">
                        Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
                            target="_blank">pixelcave</a>
                    </div>
                    <div class="col-sm-6 order-sm-1 text-center text-sm-start">
                        <a class="fw-semibold" target="_blank">Dashmix</a> &copy;
                        <span data-toggle="year-copy"></span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    @yield('modal')
    <!-- END Page Container -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <!-- toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                toastr.success(
                    '{{ session('success') }}',
                    'Thành công', {
                        positionClass: 'toast-top-right',
                        timeOut: 3000
                    }
                );
            @endif

            @if (session('error'))
                toastr.error(
                    '{{ session('error') }}',
                    'Lỗi', {
                        positionClass: 'toast-top-right',
                        timeOut: 3000
                    }
                );
            @endif
        });
    </script>

</body>
@yield('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.mark-as-read');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.dataset.url; // URL để đánh dấu đã đọc
                const redirectLink = this.getAttribute('href'); // URL của thông báo
                const notificationItem = this.closest('li'); // Phần tử thông báo

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Đổi class để thay đổi background
                        notificationItem.classList.remove('unread');
                        notificationItem.classList.add('read');

                        // Giảm số lượng thông báo chưa đọc
                        const countElement = document.querySelector('.notification-count');
                        const currentCount = parseInt(countElement.textContent.trim());
                        if (currentCount > 0) {
                            countElement.textContent = currentCount - 1;
                        }

                        // Chuyển trang sau khi đánh dấu
                        window.location.href = redirectLink;
                    }
                });
            });
        });
    });

</script>

</html>
