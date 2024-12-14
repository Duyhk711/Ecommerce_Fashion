@extends('layouts.backend')
@section('css')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            width: 95%;
            margin: 20px auto;
        }

        .section {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }


        .info-box {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .chart {
            text-align: center;
            margin: 15px 0;
            color: #999;
            font-style: italic;
        }

        ul {
            margin: 10px 0 0;
            padding: 0;
            list-style-type: disc;
            padding-left: 20px;
        }

        ul li {
            margin: 5px 0;
            color: #555;
        }

        #customerChart,
        #voucherChart {
            width: 300px;
            height: 300px;
            margin: 0 auto;
        }

        p {
            /* margin: 10px 0 0;
                                            padding: 0; */
            list-style-type: disc;
            /* padding-left: 20px; */
            /* color: #555; */
            font-size: 14px
        }

        p>span {
            font-size: 16px
        }

        #greeting {
            font-size: 15px;
            font-weight: bold
        }

        /* Định nghĩa kiểu chữ nổi bật */
        .highlight {
            font-size: 1.25rem;
            /* Kích thước lớn hơn */
        }

        /* Định nghĩa thêm cho các box */
        .info-box {
            transition: background-color 0.3s ease;
        }

        .info-box:hover {
            background-color: #f8f9fa;
            /* Thay đổi màu nền khi hover */
        }

        .comment-text {
            display: block;
            max-height: 40px;
            /* Giới hạn chiều cao cho phần hiển thị ban đầu */
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .comment-text.expanded {
            max-height: none;
            /* Mở rộng khi "Xem thêm" */
        }

        .view-more-btn {
            color: #007bff;
            cursor: pointer;
            font-size: 0.9em;
            text-decoration: underline;
        }

        .rating {
            display: flex;
        }

        .star {
            font-size: 1.2em;
            color: #ddd;
            /* Màu viền của sao trống */
            margin-right: 2px;
        }

        .star.filled {
            color: #ffcc00;
            /* Màu vàng cho sao đầy */
        }

        #comments-table {
            width: 100%;
            border-collapse: collapse;
        }

        #comments-table th,
        #comments-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        #comments-table-wrapper {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 10px;
        }

        #category-chart {
            display: block;
            width: 100%;
            height: 350px;
            /* Điều chỉnh độ cao cứng theo ý muốn */
        }

        .pagination-controls {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: 10px;
}

.pagination-controls button {
    margin: 0 5px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}

.pagination-controls button.active {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
}

.pagination-controls button:disabled {
    background-color: #e9ecef;
    color: #aaa;
    cursor: not-allowed;
}

.pagination-controls button i {
    font-size: 14px;
}
#pagination button {
    border: 1px solid #ddd; /* Đường viền nhẹ */
    border-radius: 4px; /* Góc bo tròn */
    padding: 5px 10px; /* Khoảng cách bên trong */
    margin: 0 5px; /* Khoảng cách giữa các nút */
    background-color: #f9f9f9; /* Màu nền nhạt */
    color: #333; /* Màu chữ */
    cursor: pointer;
    font-size: 14px; /* Kích thước chữ */
}

#pagination button.active {
    background-color: #007bff; /* Màu nền nút đang chọn */
    color: white; /* Màu chữ nút đang chọn */
    border-color: #007bff;
}

#pagination button:disabled {
    background-color: #e9ecef; /* Màu nền nút vô hiệu hóa */
    color: #6c757d; /* Màu chữ nút vô hiệu hóa */
    cursor: not-allowed;
}

    </style>
@endsection
@section('content')
    <div class="content">
        <div id="greeting" class="mb-3">
            <!-- Thông điệp chào sẽ được chèn vào đây -->
        </div>
        <p class="text-secondary">Sau đây là những gì đang diễn ra tại cửa hàng của bạn tuần này.</p>
        <!-- Tổng quan bán hàng -->
        <div class="section">
            <div class="block-header block-header-default">
                <h3 class="block-title">Tổng quan bán hàng tuần này</h3>
            </div>

            <div class="info-box">
                <div class="justify-content-between align-items-center p-3 bg-light border rounded">
                    <p class="mb-0">Tổng doanh thu: <span class="highlight fw-bold  text-primary">Loading...</span></p>
                </div>
                <div class="justify-content-between align-items-center p-3 bg-light border rounded">
                    <p class="mb-0">Đơn hàng chờ xác nhận: <span id="waiting_confirmation"
                            class="text-warning fw-bold ">Loading...</span></p>
                </div>
                <div class="justify-content-between align-items-center p-3 bg-light border rounded">
                    <p class="mb-0">Đơn hàng đã giao: <span id="delivered" class=" fw-bold text-success">Loading...</span>
                    </p>
                </div>
                <div class="justify-content-between align-items-center p-3 bg-light border rounded">
                    <p class="mb-0">Đơn hàng đã hủy: <span id="cancelled" class=" fw-bold text-danger">Loading...</span>
                    </p>
                </div>
            </div>

            <div class="chart">
                (Biểu đồ số lượng đơn hàng theo trạng thái)
                <canvas id="ordersChart" style="display: block; width: 100%; height: 400px;"></canvas>
            </div>
        </div>

        <!-- Hoạt động sản phẩm -->
        <div class="section">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="block-header block-header-default">
                    <div class="col-4 align-items-center">
                        <h3 class="block-title">Hoạt động sản phẩm</h3>
                    </div>
                    <div class="col-3 d-flex align-items-end">
                        <label for="period" class="form-label me-2">Lọc theo:</label>
                        <select id="period" class="form-select w-auto">
                            <option value="this_week">Tuần này</option>
                            <option value="this_month">Tháng này</option>
                            <option value="this_year">Năm nay</option>
                        </select>
                    </div>
                </div>

            </div>
            <table id="product-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng bán</th>
                        <th>Doanh thu</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Các dòng sản phẩm sẽ được đổ dữ liệu vào đây -->
                </tbody>
            </table>
            <div id="pagination" class="pagination-controls"></div>


            <div class="chart">(Biểu đồ doanh thu theo danh mục sản phẩm)
                <canvas id="category-chart" ></canvas>
            </div>
        </div>

        <div class="section">
            <div class="block-header block-header-default">
                <h3 class="block-title">Hoạt động gần đây</h3>
            </div>

            <div class="row">
                <div class="col">
                    <div class="section mt-3">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="block-title mb-0 flex-grow-1">Đơn hàng gần đây</h4>
                        </div><!-- end card header -->

                        <div class="">
                            <div class="">
                                <table class="">
                                    <thead class="">
                                        <tr>
                                            <th scope="col" class="">Mã đơn hàng</th>
                                            <th scope="col" class="">Khách hàng</th>
                                            <th scope="col" class="">Sản phẩm</th>
                                            <th scope="col" class="">Tổng tiền</th>
                                            <th scope="col" class="">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders-tbody">

                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="section">
                        <h6 class="block-title">Người dùng</h6>
                        <div class="row mt-3 d-flex justify-content-between">
                            <div class="col-4">
                                <p class="text-secondary">Khách đăng ký mới: <span id="new-customers">...</span></p>
                            </div>
                            <div class="col-4">
                                <p class="text-secondary">Khách hoạt động: <span id="active-customers">...</span></p>
                            </div>
                        </div>
                        <div class="chart py-4">
                            (Biểu đồ tỷ lệ mua hàng)
                            <canvas id="customerChart" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="section">
                        <h6 class="block-title">Marketing</h6>
                        <div class="row mt-3 d-flex justify-content-between p-0">
                            <div class="col-4">
                                <p class="text-muted">Tổng số voucher: <span id="total-vouchers">0</span></p>
                            </div>
                            <div class="col-6">
                                <p class="text-muted">Tỷ lệ sử dụng voucher: <span id="usage-rate">0%</span> </p>
                            </div>
                        </div>
                        <div class="row p-0">
                            <div class="col-5">
                                <p class="text-muted">Voucher đã sử dụng: <span id="used-vouchers">0</span></p>
                            </div>
                        </div>

                        <!-- Biểu đồ tỷ lệ sử dụng voucher -->
                        <div class="chart">(Biểu đồ tỷ lệ sử dụng voucher)
                            <canvas id="voucherChart" width="200" height="200"></canvas>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Hoạt động giỏ hàng -->
            <div class="row">
                <div class="col-4">
                    <div class="section p-3">
                        <h6 class="block-title mb-4">Hoạt động giỏ hàng</h6>

                        <div
                            class="info-box d-flex justify-content-between align-items-center mb-3 p-3 bg-light border rounded">
                            <div>
                                <p class="mb-0">Giỏ hàng tạo mới:</p>
                            </div>
                            <div class="highlight text-primary fw-bold fs-5" id="new-carts">0</div>
                        </div>

                        <div
                            class="info-box d-flex justify-content-between align-items-center p-3 bg-light border rounded">
                            <div>
                                <p class="mb-0">Giá trị giỏ hàng chưa <br>thanh toán: </p>
                            </div>
                            <div class="highlight text-success fw-bold fs-5" id="total-cart-value">0 ₫</div>

                        </div>
                    </div>

                </div>
                <div class="col-8">
                    <!-- Phản hồi khách hàng -->
                    <div class="section">
                        <div class="row d-flex justify-content-between">
                            <div class="col-6">
                                <h6 class="block-title">Phản hồi khách hàng</h6>
                            </div>
                            <div class="col-5 d-flex align-items-end">
                                <label for="filter-date" class="form-label me-2">Lọc theo:</label>
                                <select id="filter-date" class="form-select w-auto">
                                    <option value="week">Tuần này</option>
                                    <option value="month">Tháng này</option>
                                    <option value="year">Năm nay</option>
                                </select>
                            </div>

                        </div>

                        <div id="comments-table-wrapper">
                            <table id="comments-table">
                                <thead>
                                    <tr>
                                        <th>Khách hàng</th>
                                        <th>Nội dung bình luận</th>
                                        <th>Đánh giá</th>
                                        <th>Ngày bình luận</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cảnh báo -->
        {{-- <div class="section">
            <h5>Cảnh báo</h5>
            <ul>
                <li>Đơn hàng #123 bị hủy do thiếu thông tin.</li>
                <li>Lỗi hệ thống khi thanh toán bằng PayPal.</li>
            </ul>
        </div> --}}
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('admin/js/ui/charts/new/overview.js') }}"></script>
    <script src="{{ asset('admin/js/ui/charts/new/product-activity.js') }}"></script>
    <script src="{{ asset('admin/js/ui/charts/order-status.js') }}"></script>
    <script src="{{ asset('admin/js/ui/charts/new/customer-stats.js') }}"></script>
    <script src="{{ asset('admin/js/ui/charts/new/voucher-usage-rate.js') }}"></script>
    <script src="{{ asset('admin/js/ui/charts/new/cart-stats.js') }}"></script>
    <script src="{{ asset('admin/js/ui/charts/new/comments-report.js') }}"></script>

    <script>
        const userName = "{{ Auth::user()->name }}";

        function getGreeting() {
            const now = new Date();
            const hour = now.getHours();
            let greeting = "Chào bạn";

            if (hour >= 5 && hour < 12) {
                greeting = "Chào buổi sáng";
            } else if (hour >= 12 && hour < 18) {
                greeting = "Chào buổi chiều";
            } else if (hour >= 18 && hour < 22) {
                greeting = "Chào buổi tối";
            } else {
                greeting = "Chào đêm khuya";
            }

            return `${greeting}, ${userName}!`;
        }

        function updateGreeting() {
            document.getElementById("greeting").innerText = getGreeting();
        }

        updateGreeting();

        setInterval(updateGreeting, 1000 * 60);
    </script>
@endsection
