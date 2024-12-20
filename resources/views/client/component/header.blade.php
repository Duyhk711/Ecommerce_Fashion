 <!--Marquee Text-->
 <div class="topbar-slider clearfix">
     <div class="container-fluid">
         <div class="marquee-text">
             <div class="top-info-bar d-flex">
                 <div class="flex-item center">
                     <a href="#">
                         <span> <i class="anm anm-worldwide"></i> BUY ONLINE PICK UP IN STORE</span>
                         <span> <i class="anm anm-truck-l"></i> MIỄN PHÍ VẬN CHUYỂN</span>
                         <span> <i class="anm anm-redo-ar"></i> THỜI GIAN HOÀN TRẢ KÉO DÀI ĐẾN 30 NGÀY</span>
                     </a>
                 </div>
                 <div class="flex-item center">
                     <a href="#">
                         <span> <i class="anm anm-worldwide"></i> MUA HÀNG TRỰC TUYẾN, NHẬN TẠI CỬA HÀNG</span>
                         <span> <i class="anm anm-truck-l"></i> MIỄN PHÍ VẬN CHUYỂN</span>
                         <span> <i class="anm anm-redo-ar"></i> THỜI GIAN HOÀN TRẢ KÉO DÀI ĐẾN 30 NGÀY</span>
                     </a>
                 </div>
                 <div class="flex-item center">
                     <a href="#">
                         <span> <i class="anm anm-worldwide"></i> MUA HÀNG TRỰC TUYẾN, NHẬN TẠI CỬA HÀNG</span>
                         <span> <i class="anm anm-truck-l"></i> MIỄN PHÍ VẬN CHUYỂN</span>
                         <span> <i class="anm anm-redo-ar"></i> THỜI GIAN HOÀN TRẢ KÉO DÀI ĐẾN 30 NGÀY</span>
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!--End Marquee Text-->

 <!--Header-->
 <header class="header d-flex align-items-center header-1 header-fixed">
     <div class="container">
         <div class="row">
             <!--Logo-->
             <div class="logo col-5 col-sm-3 col-md-3 col-lg-2 align-self-center">
                 <a class="logoImg" href="{{ route('home') }}"><img src="{{ asset('client/images/logo-5.png') }}"
                         alt="Hema Multipurpose Html Template" title="Hema Multipurpose Html Template" width="200"
                         height="50" /></a>
             </div>
             <!--End Logo-->
             <!--Menu-->
             @php
                 use App\Models\Catalogue;
                 $catalogues = Catalogue::whereNull('parent_id') // Lấy các danh mục cha (parent_id = null)
                     ->with('children') // Lấy các danh mục con
                     ->get();
             @endphp
             <div class="col-1 col-sm-1 col-md-1 col-lg-8 align-self-center d-menu-col">
                 <nav class="navigation" id="AccessibleNav">
                     <ul id="siteNav" class="site-nav medium center">
                         <li class="lvl1 parent dropdown"><a href="{{ route('home') }}">Trang chủ </i></a>
                         </li>
                         <li class="lvl1 parent megamenu"><a href="{{ route('shop') }}">Cửa hàng</a></li>
                         <li class="lvl1 parent megamenu"><a href="#">Danh mục <i
                                     class="icon anm anm-angle-down-l"></i></a>
                             <div class="megamenu style2">
                                 <ul class="parent-menu">
                                     @foreach ($catalogues as $category)
                                         @if (!$category->parent_id && $category->is_active)
                                             <li class="lvl-1 col-md-3 col-lg-3 w-22">
                                                 <a href="#"
                                                     class="site-nav lvl-1 menu-title">{{ $category->name }}</a>

                                                 @if ($category->children->isNotEmpty())
                                                     <ul class="subLinks">
                                                         @foreach ($category->children as $child)
                                                             @if ($child->is_active)
                                                                 <li class="lvl-2">
                                                                     <a href="{{ url('filterproduct') . '?danhmuc=' . $child->slug }}"
                                                                         class="site-nav lvl-2">{{ $child->name }}</a>
                                                                 </li>
                                                             @endif
                                                         @endforeach
                                                     </ul>
                                                 @endif
                                             </li>
                                         @endif
                                     @endforeach
                                 </ul>
                         <li class="lvl1 parent dropdown"><a href="{{ route('blog') }}">Blog </a>
                         <li class="lvl1 parent dropdown"><a href="{{ route('contact') }}">Liên hệ </a></li>
                     </ul>
                 </nav>
             </div>
             <!--End Menu-->
             <!--Right Icon-->
             <div class="col-7 col-sm-9 col-md-9 col-lg-2 align-self-center icons-col text-right">
                 <!--Search-->
                 <div class="search-parent iconset">
                     <div class="site-search" title="Search">
                         <a href="#;" class="search-icon clr-none" data-bs-toggle="offcanvas"
                             data-bs-target="#search-drawer"><i class="hdr-icon icon anm anm-search-l"></i></a>
                     </div>
                     <div class="search-drawer offcanvas offcanvas-top" tabindex="-1" id="search-drawer">
                         <div class="container">
                             <div class="search-header d-flex-center justify-content-between mb-3">
                                 <h3 class="title m-0">Bạn đang tìm kiếm gì?</h3>
                                 <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                     aria-label="Close"></button>
                             </div>
                             <div class="search-body">
                                 <form class="form minisearch" id="header-search" action="{{ route('search') }}"
                                     method="get">
                                     @csrf
                                     <!--Search Field-->
                                     <div class="d-flex searchField">
                                         {{-- <div class="search-category">
                                             <select class="rgsearch-category rounded-end-0">
                                                 <option value="0">All Categories</option>
                                                 <option value="1">- All</option>
                                             </select>
                                         </div> --}}
                                         <div class="input-box d-flex fl-1">
                                             <input type="text" class="input-text border-start-0 border-end-0"
                                                 placeholder="Search for products..." value="{{ request('query') }}"
                                                 name="query" placeholder="Tìm kiếm sản phẩm..." />
                                             <button type="submit"
                                                 class="action search d-flex-justify-center btn rounded-start-0">
                                                 <i class="icon anm anm-search-l"></i>
                                             </button>
                                         </div>
                                     </div>
                                     <!--End Search Field-->

                                     <!--Search popular-->
                                     {{-- <div class="popular-searches d-flex-justify-center mt-3">
                                         <span class="title fw-600">Trending Now:</span>
                                         <div class="d-flex-wrap searches-items">
                                             <a class="text-link ms-2" href="#">T-Shirt,</a>
                                             <a class="text-link ms-2" href="#">Shoes,</a>
                                             <a class="text-link ms-2" href="#">Bags</a>
                                         </div>
                                     </div> --}}
                                     <!--End Search popular-->
                                     <!--Search products-->
                                     <!--End Search products-->
                                 </form>

                             </div>
                         </div>
                     </div>
                 </div>
                 <!--End Search-->
                 <!--Account-->
                 <div class="account-parent iconset">
                     <div class="account-link" title="Account"><i class="hdr-icon icon anm anm-user-al"></i>
                     </div>
                     <div id="accountBox">
                         <div class="customer-links">
                             <ul class="m-0">
                                 @if (!Auth::check())
                                     <li><a href="{{ route('login') }}"><i class="icon anm anm-sign-in-al"></i>Đăng
                                             nhập</a></li>
                                     <li><a href="{{ route('register') }}"><i class="icon anm anm-user-al"></i>Đăng
                                             kí</a></li>
                                 @endif

                                 @if (Auth::check())
                                     <li><a href="{{ route('myaccount') }}"><i class="icon anm anm-user-cil"></i>Tài
                                             khoản</a></li>
                                     <li><a href="{{ route('my.wishlist') }}"><i class="icon anm anm-heart-l"></i>Yêu
                                             thích</a></li>
                                     <li><a href="{{ route('logout') }}"><i class="icon anm anm-sign-out-al"></i>Đăng
                                             xuất</a></li>
                                 @endif
                             </ul>
                         </div>
                     </div>
                 </div>
                 <!--End Account-->
                 <!--Wishlist-->
                 <div class="wishlist-link iconset" title="Wishlist">
                     <a href="{{ route('my.wishlist') }}">
                         <i class="hdr-icon icon anm anm-heart-l"></i>
                         <span class="wishlist-count" id="wishlist-count">
                             @auth
                                 {{ \App\Models\Favorite::where('user_id', auth()->id())->count() }}
                             @else
                                 0
                             @endauth
                         </span>
                     </a>
                 </div>
                 <div class="notify-parent iconset">
                    <div class="notification-bell" title="Thông báo">
                        <a href="#" class="bell-link">
                            <i class="hdr-icon icon anm bi-bell fs-5"></i>
                            <span class="wishlist-count" id="wishlist-count">
                                <span class="notification-count">
                                    @if(auth()->check())
                                        @php
                                            $clientNotifications = auth()->user()->unreadNotifications->where('data.category', 'client');
                                        @endphp
                                        {{ $clientNotifications->count() }}
                                    @else
                                        0
                                    @endif
                                </span>
                            </span>
                        </a>
                        <div id="notifyBox" class="custom-scrollbar">
                            <style>
                                .read{
                                    background-color: #ffffff;
                                }
                                .unread{
                                    background-color: rgb(255, 250, 244);
                                }
                            </style>
                            <ul class="m-0" id="notification-list">
                                <li class="mb-2 fixed-title"><strong>Thông báo</strong></li>

                                @if(auth()->check())
                                    @php
                                        $clientNotifications = auth()->user()->notifications->where('data.category', 'client');
                                    @endphp
                                    @if($clientNotifications->count() > 0)
                                        @foreach($clientNotifications as $notification)
                                                <li class="{{ $notification->read_at ? 'read' : 'unread' }} px-2 mb-2" data-id="{{ $notification->id }}">
                                                    <strong style="font-family: 'Quicksand', sans-serif">{{ $notification->data['title'] }}</strong><br>
                                                    <a href="{{ $notification->data['link'] }}" class="mark-as-read" data-url="{{ route('notifications.markAsRead', $notification->id) }}">
                                                        {!! $notification->data['message'] !!}
                                                    </a>
                                                </li>
                                        @endforeach
                                    @else
                                        <li>Hiện tại bạn không có thông báo nào.</li> <!-- Nếu không có thông báo -->
                                    @endif
                                @else
                                    <li>Vui lòng đăng nhập để xem thông báo</li> <!-- Nếu chưa đăng nhập -->
                                @endif
                            </ul>
                            <div id="loading" style="display: none;">Đang tải thêm...</div> <!-- Hiển thị khi đang tải -->
                        </div>
                    </div>
                 </div>

                 <!--End notify-->
                 <!--Minicart-->
                 <div class="header-cart iconset" title="Cart">
                     <a href="{{ route('cart.show') }}" class="header-cart btn-minicart clr-none"><i
                             class="hdr-icon icon anm anm-cart-l"></i>
                         <span class="cart-count">
                             {{ app(App\Services\Client\CartService::class)->getCartItemCount() }}
                         </span>
                     </a>
                 </div>
                 <!--End Minicart-->
                 <!--Mobile Toggle-->
                 <button type="button" class="iconset pe-0 menu-icon js-mobile-nav-toggle mobile-nav--open d-lg-none"
                     title="Menu"><i class="hdr-icon icon anm anm-times-l"></i><i
                         class="hdr-icon icon anm anm-bars-r"></i></button>
                 <!--End Mobile Toggle-->
             </div>
             <!--End Right Icon-->
         </div>
     </div>
 </header>
 <!--End Header-->
 <!--Mobile Menu-->
 <div class="mobile-nav-wrapper" role="navigation">
     <div class="closemobileMenu">Close Menu <i class="icon anm anm-times-l"></i></div>
     <ul id="MobileNav" class="mobile-nav">
         <li class="lvl1 parent dropdown"><a href="index.html">Home <i class="icon anm anm-angle-down-l"></i></a>
             <ul class="lvl-2">
                 <li><a href="index.html" class="site-nav">Home 01 - Fashion</a></li>
                 <li><a href="index2-footwear.html" class="site-nav">Home 02 - Footwear</a></li>
                 <li><a href="index3-bags.html" class="site-nav">Home 03 - Bags</a></li>
                 <li><a href="index4-electronic.html" class="site-nav">Home 04 - Electronic</a></li>
                 <li><a href="index5-tools-parts.html" class="site-nav">Home 05 - Tools &amp; Parts</a></li>
                 <li><a href="index6-jewelry.html" class="site-nav">Home 06 - Jewelry</a></li>
                 <li><a href="index7-organic-food.html" class="site-nav">Home 07 - Organic Food</a></li>
                 <li><a href="index8-cosmetics.html" class="site-nav">Home 08 - Cosmetics</a></li>
                 <li><a href="index9-furniture.html" class="site-nav">Home 09 - Furniture</a></li>
                 <li><a href="index10-sunglasses.html" class="site-nav">Home 10 - Sunglasses</a></li>
                 <li><a href="index11-medical.html" class="site-nav">Home 11 - Medical</a></li>
                 <li><a href="index12-christmas.html" class="site-nav last">Home 12 - Christmas</a></li>
             </ul>
         </li>
         <li class="lvl1 parent megamenu"><a href="#">Shop <i class="icon anm anm-angle-down-l"></i></a>
             <ul class="lvl-2">
                 <li><a href="#;" class="site-nav">Collection Page <i class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3">
                         <li><a href="collection-style1.html" class="site-nav">Collection style1</a></li>
                         <li><a href="collection-style2.html" class="site-nav">Collection style2</a></li>
                         <li><a href="collection-style3.html" class="site-nav">Collection style3</a></li>
                         <li><a href="collection-style4.html" class="site-nav">Collection style4</a></li>
                         <li><a href="sub-collection-style1.html" class="site-nav">Sub Collection style1</a>
                         </li>
                         <li><a href="sub-collection-style2.html" class="site-nav">Sub Collection style2</a>
                         </li>
                         <li><a href="collection-empty.html" class="site-nav">Collection Empty</a></li>
                         <li><a href="shop-search-results.html" class="site-nav">Shop Search Results</a></li>
                         <li><a href="shop-swatches-style.html" class="site-nav last">Shop Swatches style</a>
                         </li>
                     </ul>
                 </li>
                 <li><a href="#;" class="site-nav">Shop Page <i class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3">
                         <li><a href="shop-grid-view.html" class="site-nav">Shop Grid View</a></li>
                         <li><a href="shop-list-view.html" class="site-nav">Shop List View</a></li>
                         <li><a href="shop-left-sidebar.html" class="site-nav">Shop Left Sidebar</a></li>
                         <li><a href="shop-right-sidebar.html" class="site-nav">Shop Right Sidebar</a></li>
                         <li><a href="shop-top-filter.html" class="site-nav">Shop Top Filter</a></li>
                         <li><a href="shop-masonry-grid.html" class="site-nav">Shop Masonry Grid</a></li>
                         <li><a href="shop-with-category.html" class="site-nav">Shop With Category</a></li>
                         <li><a href="shop-grid-view.html" class="site-nav">Classic Pagination</a></li>
                         <li><a href="shop-right-sidebar.html" class="site-nav last">Infinite Scrolling</a>
                         </li>
                     </ul>
                 </li>
                 <li><a href="#;" class="site-nav">Shop Other Page <i class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3">
                         <li><a href="wishlist-style1.html" class="site-nav">Wishlist Style1</a></li>
                         <li><a href="wishlist-style2.html" class="site-nav">Wishlist Style2</a></li>
                         <li><a href="compare-style1.html" class="site-nav">Compare Style1</a></li>
                         <li><a href="compare-style2.html" class="site-nav">Compare Style2</a></li>
                         <li><a href="cart-style1.html" class="site-nav">Cart Style1</a></li>
                         <li><a href="cart-style2.html" class="site-nav">Cart Style2</a></li>
                         <li><a href="checkout-style1.html" class="site-nav">Checkout Style1</a></li>
                         <li><a href="checkout-style2.html" class="site-nav">Checkout Style2</a></li>
                         <li><a href="order-success.html" class="site-nav last">Order Success</a></li>
                     </ul>
                 </li>
             </ul>
         </li>
         <li class="lvl1 parent megamenu"><a href="product-layout1.html">Product <i
                     class="icon anm anm-angle-down-l"></i></a>
             <ul class="lvl-2">
                 <li><a href="product-layout1.html" class="site-nav">Product Page <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3">
                         <li><a href="product-layout1.html" class="site-nav">Product Layout1</a></li>
                         <li><a href="product-layout2.html" class="site-nav">Product Layout2</a></li>
                         <li><a href="product-layout3.html" class="site-nav">Product Layout3</a></li>
                         <li><a href="product-layout4.html" class="site-nav">Product Layout4</a></li>
                         <li><a href="product-layout5.html" class="site-nav">Product Layout5</a></li>
                         <li><a href="product-layout6.html" class="site-nav">Product Layout6</a></li>
                         <li><a href="product-layout7.html" class="site-nav">Product Layout7</a></li>
                         <li><a href="product-3d-ar-models.html" class="site-nav last">Product 3D, AR
                                 models</a></li>
                     </ul>
                 </li>
                 <li><a href="product-standard.html" class="site-nav">Product Page Types <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3">
                         <li><a href="product-standard.html" class="site-nav">Standard Product</a></li>
                         <li><a href="product-variable.html" class="site-nav">Variable Product</a></li>
                         <li><a href="product-grouped.html" class="site-nav">Grouped Product</a></li>
                         <li><a href="product-layout4.html" class="site-nav">Product Back in stock</a></li>
                         <li><a href="product-layout6.html" class="site-nav">Product Accordion</a></li>
                         <li><a href="product-layout7.html" class="site-nav">Product Tabs Left</a></li>
                         <li><a href="product-layout6.html" class="site-nav">Product Bundle</a></li>
                         <li><a href="prodcut-360-view.html" class="site-nav last">Product 360 View</a></li>
                     </ul>
                 </li>
             </ul>
         </li>
         <li class="lvl1 parent dropdown"><a href="#;">Pages <i class="icon anm anm-angle-down-l"></i></a>
             <ul class="lvl-2">
                 <li><a href="aboutus-style1.html" class="site-nav">About Us <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3 dropdown">
                         <li><a href="aboutus-style1.html" class="site-nav">About Us Style1</a></li>
                         <li><a href="aboutus-style2.html" class="site-nav">About Us Style2</a></li>
                     </ul>
                 </li>
                 <li><a href="contact-style1.html" class="site-nav">Contact Us <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3 dropdown">
                         <li><a href="contact-style1.html" class="site-nav">Contact Us Style1</a></li>
                         <li><a href="contact-style2.html" class="site-nav">Contact Us Style2</a></li>
                     </ul>
                 </li>
                 <li><a href="my-account.html" class="site-nav">My Account <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3 dropdown">
                         <li><a href="my-account.html" class="site-nav">My Account</a></li>
                         <li><a href="login.html" class="site-nav">Login</a></li>
                         <li><a href="register.html" class="site-nav">Register</a></li>
                         <li><a href="forgot-password.html" class="site-nav">Forgot Password</a></li>
                     </ul>
                 </li>
                 <li><a href="lookbook-grid.html" class="site-nav">Lookbook <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3 dropdown">
                         <li><a href="lookbook-grid.html" class="site-nav">Lookbook Grid</a></li>
                         <li><a href="lookbook-masonry.html" class="site-nav">Lookbook Masonry</a></li>
                         <li><a href="lookbook-shop.html" class="site-nav">Lookbook Shop</a></li>
                     </ul>
                 </li>
                 <li><a href="portfolio-page.html" class="site-nav">Portfolio Page</a></li>
                 <li><a href="faqs-page.html" class="site-nav">FAQs Page</a></li>
                 <li><a href="brands-page.html" class="site-nav">Brands Page</a></li>
                 <li><a href="cms-page.html" class="site-nav">CMS Page</a></li>
                 <li><a href="elements-icons.html" class="site-nav">Icons</a></li>
                 <li><a href="error-404.html" class="site-nav">Error 404</a></li>
                 <li><a href="coming-soon.html" class="site-nav">Coming soon <span
                             class="lbl nm_label2">New</span></a></li>
             </ul>
         </li>
         <li class="lvl1 parent dropdown"><a href="blog-grid.html">Blog <i class="icon anm anm-angle-down-l"></i></a>
             <ul class="lvl-2">
                 <li><a href="blog-grid.html" class="site-nav">Grid View</a></li>
                 <li><a href="blog-list.html" class="site-nav">List View</a></li>
                 <li><a href="blog-grid-sidebar.html" class="site-nav">Left Sidebar</a></li>
                 <li><a href="blog-list-sidebar.html" class="site-nav">Right Sidebar</a></li>
                 <li><a href="blog-masonry.html" class="site-nav">Masonry Grid</a></li>
                 <li><a href="blog-details.html" class="site-nav">Blog Details</a></li>
             </ul>
         </li>

         </li>
         <li class="lvl1 parent dropdown"><a href="#">Blog <i class="icon anm anm-angle-down-l"></i></a>
         </li>
     </ul>
     </nav>
 </div>
 <!--End Menu-->

 </div>
 </div>
 </header>
 <!--End Header-->
 <!--Mobile Menu-->
 <div class="mobile-nav-wrapper" role="navigation">
     <div class="closemobileMenu">Close Menu <i class="icon anm anm-times-l"></i></div>
     <ul id="MobileNav" class="mobile-nav">
         <li class="lvl1 parent dropdown"><a href="index.html">Home <i class="icon anm anm-angle-down-l"></i></a>
             <ul class="lvl-2">
                 <li><a href="index.html" class="site-nav">Home 01 - Fashion</a></li>
                 <li><a href="index2-footwear.html" class="site-nav">Home 02 - Footwear</a></li>
                 <li><a href="index3-bags.html" class="site-nav">Home 03 - Bags</a></li>
                 <li><a href="index4-electronic.html" class="site-nav">Home 04 - Electronic</a></li>
                 <li><a href="index5-tools-parts.html" class="site-nav">Home 05 - Tools &amp; Parts</a></li>
                 <li><a href="index6-jewelry.html" class="site-nav">Home 06 - Jewelry</a></li>
                 <li><a href="index7-organic-food.html" class="site-nav">Home 07 - Organic Food</a></li>
                 <li><a href="index8-cosmetics.html" class="site-nav">Home 08 - Cosmetics</a></li>
                 <li><a href="index9-furniture.html" class="site-nav">Home 09 - Furniture</a></li>
                 <li><a href="index10-sunglasses.html" class="site-nav">Home 10 - Sunglasses</a></li>
                 <li><a href="index11-medical.html" class="site-nav">Home 11 - Medical</a></li>
                 <li><a href="index12-christmas.html" class="site-nav last">Home 12 - Christmas</a></li>
             </ul>
         </li>
         <li class="lvl1 parent megamenu"><a href="#">Shop <i class="icon anm anm-angle-down-l"></i></a>
             <ul class="lvl-2">
                 <li><a href="#;" class="site-nav">Collection Page <i class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3">
                         <li><a href="collection-style1.html" class="site-nav">Collection style1</a></li>
                         <li><a href="collection-style2.html" class="site-nav">Collection style2</a></li>
                         <li><a href="collection-style3.html" class="site-nav">Collection style3</a></li>
                         <li><a href="collection-style4.html" class="site-nav">Collection style4</a></li>
                         <li><a href="sub-collection-style1.html" class="site-nav">Sub Collection style1</a>
                         </li>
                         <li><a href="sub-collection-style2.html" class="site-nav">Sub Collection style2</a>
                         </li>
                         <li><a href="collection-empty.html" class="site-nav">Collection Empty</a></li>
                         <li><a href="shop-search-results.html" class="site-nav">Shop Search Results</a></li>
                         <li><a href="shop-swatches-style.html" class="site-nav last">Shop Swatches style</a>
                         </li>
                     </ul>
                 </li>
                 <li><a href="#;" class="site-nav">Shop Page <i class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3">
                         <li><a href="shop-grid-view.html" class="site-nav">Shop Grid View</a></li>
                         <li><a href="shop-list-view.html" class="site-nav">Shop List View</a></li>
                         <li><a href="shop-left-sidebar.html" class="site-nav">Shop Left Sidebar</a></li>
                         <li><a href="shop-right-sidebar.html" class="site-nav">Shop Right Sidebar</a></li>
                         <li><a href="shop-top-filter.html" class="site-nav">Shop Top Filter</a></li>
                         <li><a href="shop-masonry-grid.html" class="site-nav">Shop Masonry Grid</a></li>
                         <li><a href="shop-with-category.html" class="site-nav">Shop With Category</a></li>
                         <li><a href="shop-grid-view.html" class="site-nav">Classic Pagination</a></li>
                         <li><a href="shop-right-sidebar.html" class="site-nav last">Infinite Scrolling</a>
                         </li>
                     </ul>
                 </li>
                 <li><a href="#;" class="site-nav">Shop Other Page <i class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3">
                         <li><a href="wishlist-style1.html" class="site-nav">Wishlist Style1</a></li>
                         <li><a href="wishlist-style2.html" class="site-nav">Wishlist Style2</a></li>
                         <li><a href="compare-style1.html" class="site-nav">Compare Style1</a></li>
                         <li><a href="compare-style2.html" class="site-nav">Compare Style2</a></li>
                         <li><a href="cart-style1.html" class="site-nav">Cart Style1</a></li>
                         <li><a href="cart-style2.html" class="site-nav">Cart Style2</a></li>
                         <li><a href="checkout-style1.html" class="site-nav">Checkout Style1</a></li>
                         <li><a href="checkout-style2.html" class="site-nav">Checkout Style2</a></li>
                         <li><a href="order-success.html" class="site-nav last">Order Success</a></li>
                     </ul>
                 </li>
             </ul>
         </li>
         <li class="lvl1 parent megamenu"><a href="product-layout1.html">Product <i
                     class="icon anm anm-angle-down-l"></i></a>
             <ul class="lvl-2">
                 <li><a href="product-layout1.html" class="site-nav">Product Page <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3">
                         <li><a href="product-layout1.html" class="site-nav">Product Layout1</a></li>
                         <li><a href="product-layout2.html" class="site-nav">Product Layout2</a></li>
                         <li><a href="product-layout3.html" class="site-nav">Product Layout3</a></li>
                         <li><a href="product-layout4.html" class="site-nav">Product Layout4</a></li>
                         <li><a href="product-layout5.html" class="site-nav">Product Layout5</a></li>
                         <li><a href="product-layout6.html" class="site-nav">Product Layout6</a></li>
                         <li><a href="product-layout7.html" class="site-nav">Product Layout7</a></li>
                         <li><a href="product-3d-ar-models.html" class="site-nav last">Product 3D, AR
                                 models</a></li>
                     </ul>
                 </li>
                 <li><a href="product-standard.html" class="site-nav">Product Page Types <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3">
                         <li><a href="product-standard.html" class="site-nav">Standard Product</a></li>
                         <li><a href="product-variable.html" class="site-nav">Variable Product</a></li>
                         <li><a href="product-grouped.html" class="site-nav">Grouped Product</a></li>
                         <li><a href="product-layout4.html" class="site-nav">Product Back in stock</a></li>
                         <li><a href="product-layout6.html" class="site-nav">Product Accordion</a></li>
                         <li><a href="product-layout7.html" class="site-nav">Product Tabs Left</a></li>
                         <li><a href="product-layout6.html" class="site-nav">Product Bundle</a></li>
                         <li><a href="prodcut-360-view.html" class="site-nav last">Product 360 View</a></li>
                     </ul>
                 </li>
             </ul>
         </li>
         <li class="lvl1 parent dropdown"><a href="#;">Pages <i class="icon anm anm-angle-down-l"></i></a>
             <ul class="lvl-2">
                 <li><a href="aboutus-style1.html" class="site-nav">About Us <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3 dropdown">
                         <li><a href="aboutus-style1.html" class="site-nav">About Us Style1</a></li>
                         <li><a href="aboutus-style2.html" class="site-nav">About Us Style2</a></li>
                     </ul>
                 </li>
                 <li><a href="contact-style1.html" class="site-nav">Contact Us <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3 dropdown">
                         <li><a href="contact-style1.html" class="site-nav">Contact Us Style1</a></li>
                         <li><a href="contact-style2.html" class="site-nav">Contact Us Style2</a></li>
                     </ul>
                 </li>
                 <li><a href="my-account.html" class="site-nav">My Account <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3 dropdown">
                         <li><a href="my-account.html" class="site-nav">My Account</a></li>
                         <li><a href="login.html" class="site-nav">Login</a></li>
                         <li><a href="register.html" class="site-nav">Register</a></li>
                         <li><a href="forgot-password.html" class="site-nav">Forgot Password</a></li>
                     </ul>
                 </li>
                 <li><a href="lookbook-grid.html" class="site-nav">Lookbook <i
                             class="icon anm anm-angle-down-l"></i></a>
                     <ul class="lvl-3 dropdown">
                         <li><a href="lookbook-grid.html" class="site-nav">Lookbook Grid</a></li>
                         <li><a href="lookbook-masonry.html" class="site-nav">Lookbook Masonry</a></li>
                         <li><a href="lookbook-shop.html" class="site-nav">Lookbook Shop</a></li>
                     </ul>
                 </li>
                 <li><a href="portfolio-page.html" class="site-nav">Portfolio Page</a></li>
                 <li><a href="faqs-page.html" class="site-nav">FAQs Page</a></li>
                 <li><a href="brands-page.html" class="site-nav">Brands Page</a></li>
                 <li><a href="cms-page.html" class="site-nav">CMS Page</a></li>
                 <li><a href="elements-icons.html" class="site-nav">Icons</a></li>
                 <li><a href="error-404.html" class="site-nav">Error 404</a></li>
                 <li><a href="coming-soon.html" class="site-nav">Coming soon <span
                             class="lbl nm_label2">New</span></a></li>
             </ul>
         </li>
         <li class="lvl1 parent dropdown"><a href="blog-grid.html">Blog <i class="icon anm anm-angle-down-l"></i></a>
             <ul class="lvl-2">
                 <li><a href="blog-grid.html" class="site-nav">Grid View</a></li>
                 <li><a href="blog-list.html" class="site-nav">List View</a></li>
                 <li><a href="blog-grid-sidebar.html" class="site-nav">Left Sidebar</a></li>
                 <li><a href="blog-list-sidebar.html" class="site-nav">Right Sidebar</a></li>
                 <li><a href="blog-masonry.html" class="site-nav">Masonry Grid</a></li>
                 <li><a href="blog-details.html" class="site-nav">Blog Details</a></li>
             </ul>
         </li>

         <li class="mobile-menu-bottom">
             <div class="mobile-links">
                 <ul class="list-inline d-inline-flex flex-column w-100">
                     <li><a href="login.html" class="d-flex align-items-center"><i
                                 class="icon anm anm-sign-in-al"></i>Sign In</a></li>
                     <li><a href="register.html" class="d-flex align-items-center"><i
                                 class="icon anm anm-user-al"></i>Register</a></li>
                     <li><a href="my-account.html" class="d-flex align-items-center"><i
                                 class="icon anm anm-user-cil"></i>My Account</a></li>
                     <li class="title h5">Need Help?</li>
                     <li><a href="tel:401234567890" class="d-flex align-items-center"><i
                                 class="icon anm anm-phone-l"></i> (+40) 123 456 7890</a></li>
                     <li><a href="mailto:info@example.com" class="d-flex align-items-center"><i
                                 class="icon anm anm-envelope-l"></i> info@example.com</a></li>
                 </ul>
             </div>
             <div class="mobile-follow mt-2">
                 <h5 class="title">Follow Us</h5>
                 <ul class="list-inline social-icons d-inline-flex mt-1">
                     <li class="list-inline-item"><a href="#" title="Facebook"><i
                                 class="icon anm anm-facebook-f"></i></a></li>
                     <li class="list-inline-item"><a href="#" title="Twitter"><i
                                 class="icon anm anm-twitter"></i></a></li>
                     <li class="list-inline-item"><a href="#" title="Pinterest"><i
                                 class="icon anm anm-pinterest-p"></i></a></li>
                     <li class="list-inline-item"><a href="#" title="Linkedin"><i
                                 class="icon anm anm-linkedin-in"></i></a></li>
                     <li class="list-inline-item"><a href="#" title="Instagram"><i
                                 class="icon anm anm-instagram"></i></a></li>
                     <li class="list-inline-item"><a href="#" title="Youtube"><i
                                 class="icon anm anm-youtube"></i></a></li>
                 </ul>
             </div>
         </li>
     </ul>
 </div>
 <!--End Mobile Menu-->
 @vite(['resources/js/new_voucher.js'])
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.mark-as-read');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.dataset.url; // URL để đánh dấu đã đọc
                const redirectLink = this.getAttribute('href'); // URL của thông báo

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = redirectLink; // Chuyển trang sau khi đánh dấu
                    }
                });
            });
        });
    });
</script>
@vite(['resources/js/app.js'])
<script>
    document.addEventListener('DOMContentLoaded', () => { // Bạn cần sử dụng đúng ID
        const loading = document.getElementById('loading');
        const notificationList = document.getElementById('notifyBox'); 
        let page = 1;
        let loadingData = false;
        let hasNextPage = true; // Kiểm tra nếu còn trang kế tiếp

        // Hàm tải thông báo
        function loadNotifications() {
            if (loadingData || !hasNextPage) return;
            loadingData = true;
            loading.style.display = 'block';

            // Gọi API và tải dữ liệu
            fetch(`/notifications?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const notifications = data.data;
                    if (notifications.length > 0) {
                        notifications.forEach(notification => {
                            const li = document.createElement('li');
                            li.className = notification.read_at ? 'read px-2 mb-2' : 'unread px-2 mb-2';
                            li.innerHTML = `
                                <strong style="font-family: 'Quicksand', sans-serif">${notification.data.title}</strong><br>
                                <a href="${notification.data.link}" class="mark-as-read" data-id="${notification.id}">
                                    ${notification.data.message}
                                </a>
                            `;
                            notificationList.appendChild(li);
                        });
                        page++;  // Tăng số trang lên mỗi lần tải
                        hasNextPage = !!data.next_page_url;  // Kiểm tra xem có trang tiếp theo hay không
                    } else {
                        loading.innerText = 'Không còn thông báo nào';
                    }
                    loadingData = false;
                    loading.style.display = 'none';
                })
                .catch(error => {
                    console.error('Lỗi khi tải thông báo:', error);
                    loading.style.display = 'none';
                    loadingData = false;
                });
        }

        // Gọi loadNotifications lần đầu tiên
        loadNotifications();

        // Xử lý sự kiện scroll để tải thêm dữ liệu khi cuộn đến cuối
        notificationList.addEventListener('scroll', () => {
            if (notificationList.scrollTop + notificationList.clientHeight >= notificationList.scrollHeight) {
                loadNotifications();
            }
        });
    });

</script>