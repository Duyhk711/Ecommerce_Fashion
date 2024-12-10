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

        /* .section h5 {
            margin: 0 0 15px;
            color: #333;
            font-size: 22px;
        } */

        .info-box {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 16px;
        }

        /* .highlight {
            background: #e3f2fd;
            border: 1px solid #2196f3;
            padding: 10px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #0d47a1;
            border-radius: 5px;
        } */

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

        #customerChart,#voucherChart {
            width: 300px;
            height: 300px;
            margin: 0 auto;
        }
        p{
            margin: 10px 0 0;
            padding: 0;
            list-style-type: disc;
            padding-left: 20px;
            color: #555;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <!-- Tổng quan bán hàng -->
        <div class="section">
            <h5>Tổng quan bán hàng</h5>
            <div class="info-box">
                <div>
                    <strong>Tổng doanh thu:</strong>
                    <span class="highlight">Loading...</span>
                </div>
                <div>
                    <strong>Đơn hàng chờ xác nhận:</strong>
                    <span id="waiting_confirmation">Loading...</span>
                </div>
                <div>
                    <strong>Đơn hàng đã giao:</strong>
                    <span id="delivered">Loading...</span>
                </div>
                <div>
                    <strong>Đơn hàng đã hủy:</strong>
                    <span id="cancelled">Loading...</span>
                </div>
            </div>
            <div class="chart">
                (Biểu đồ số lượng đơn hàng theo trạng thái)
                <canvas id="ordersChart" width="400" height="200"></canvas>
            </div>
        </div>


        <!-- Hoạt động sản phẩm -->
        <div class="section">
            <h5>Hoạt động sản phẩm</h5>

            <!-- Lọc thời gian -->
            <label for="period">Lọc theo:</label>
            <select id="period">
                <option value="this_week">Tuần này</option>
                <option value="this_month">Tháng này</option>
                <option value="this_year">Năm nay</option>
            </select>

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

            <div class="chart">(Biểu đồ doanh thu theo danh mục sản phẩm)</div>
            {{-- <h3></h3> --}}
            <canvas id="category-chart"></canvas>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="section">
                    <h5>Hoạt động người dùng</h5>
                    <div class="info-box">
                        <div><p>Khách đăng ký mới:</p> <span id="new-customers">...</span></div>
                        <div><p>Khách hoạt động:</p> <span id="active-customers">...</span></div>
                    </div>
                    <div class="chart">
                        (Biểu đồ tỷ lệ mua hàng)
                        <canvas id="customerChart" width="200" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="section">
                    <h5>Hoạt động marketing</h5>
                    <div class="info-box">
                        <!-- Đây là nơi hiển thị số liệu về voucher -->
                        <div><p>Tổng số voucher:</p> <span id="total-vouchers">0</span></div>
                        <div><p>Voucher đã sử dụng:</p> <span id="used-vouchers">0</span></div>
                        <div><p>Tỷ lệ sử dụng voucher:</p> <span id="usage-rate">0%</span></div>
                    </div>
                    <!-- Biểu đồ tỷ lệ sử dụng voucher -->

                    <div class="chart">(Biểu đồ tỷ lệ sử dụng voucher)</div>
                    <canvas id="voucherChart" width="200" height="200"></canvas>
                </div>
            </div>


        </div>


        <!-- Hoạt động giỏ hàng -->
       <div class="row">
            <div class="col-4">
                <div class="section">
                    <h5>Hoạt động giỏ hàng</h5>
                    <div class="info-box">
                        <div><p>Giỏ hàng tạo mới:</p></div>
                        <div class="highlight" id="new-carts">0</div>
                    </div>
                    <div class="info-box">
                        <div><p>Giá trị giỏ hàng chưa thanh toán:</p></div>
                        <div class="highlight" id="total-cart-value">0 VND</div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <!-- Phản hồi khách hàng -->
                <div class="section">
                    <h5>Phản hồi khách hàng</h5>
                    <table>
                        <thead>
                            <tr>
                                <th>Khách hàng</th>
                                <th>Nội dung bình luận</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Nguyễn Văn A</td>
                                <td>Sản phẩm đẹp, chất lượng!</td>
                            </tr>
                            <tr>
                                <td>Trần Thị B</td>
                                <td>Giao hàng hơi chậm.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
       </div>

        <!-- Cảnh báo -->
        <div class="section">
            <h5>Cảnh báo</h5>
            <ul>
                <li>Đơn hàng #123 bị hủy do thiếu thông tin.</li>
                <li>Lỗi hệ thống khi thanh toán bằng PayPal.</li>
            </ul>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch dữ liệu từ API
            fetch('/api/dashboard/overview')
                .then(response => response.json())
                .then(data => {
                    // Hiển thị dữ liệu Tổng quan bán hàng
                    document.querySelector('.highlight').textContent = data.orders_summary.total_revenue
                        .toLocaleString('vi-VN') + ' VND';
                    document.querySelector('#waiting_confirmation').textContent = data.orders_summary
                        .waiting_confirmation;
                    document.querySelector('#delivered').textContent = data.orders_summary.delivered;
                    document.querySelector('#cancelled').textContent = data.orders_summary.cancelled;

                    // Biểu đồ dữ liệu
                    displayChart(data.chart_data);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });

        // Hàm để hiển thị biểu đồ (sử dụng Chart.js)
        function displayChart(chartData) {
            // Các label sẽ là các ngày trong tuần từ thứ Hai đến Chủ Nhật
            const chartLabels = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật'];

            // Khởi tạo dữ liệu cho các trạng thái
            const chartValues = {
                '1': [0, 0, 0, 0, 0, 0, 0], // Chờ xác nhận
                '5': [0, 0, 0, 0, 0, 0, 0], // Đã giao
                'huy_don_hang': [0, 0, 0, 0, 0, 0, 0] // Đã hủy
            };

            // Xử lý dữ liệu ngày tháng từ chartData (API trả về)
            const currentDate = new Date();
            const firstDayOfWeek = currentDate.getDate() - currentDate.getDay() + 1; // Thứ 2 của tuần hiện tại
            const firstDayOfWeekDate = new Date(currentDate.setDate(firstDayOfWeek));

            // Lặp qua tất cả các ngày trong tuần và gán giá trị 0 cho các ngày không có dữ liệu
            for (let i = 0; i < 7; i++) {
                const dayDate = new Date(firstDayOfWeekDate);
                dayDate.setDate(firstDayOfWeekDate.getDate() + i);
                const formattedDate = dayDate.toISOString().split('T')[0]; // Chuyển ngày thành định dạng YYYY-MM-DD

                if (chartData[formattedDate]) {
                    chartData[formattedDate].forEach(statusData => {
                        if (chartValues[statusData.status] !== undefined) {
                            const dayIndex = i; // Đánh dấu chỉ số ngày trong tuần
                            chartValues[statusData.status][dayIndex] = statusData.count;
                        }
                    });
                }
            }

            // Cấu hình và vẽ biểu đồ
            const ctx = document.getElementById('ordersChart').getContext('2d');
            new Chart(ctx, {
                type: 'line', // Hoặc 'bar' nếu bạn muốn dùng biểu đồ cột
                data: {
                    labels: chartLabels,
                    datasets: [{
                            label: 'Chờ xác nhận',
                            data: chartValues['1'],
                            borderColor: 'rgb(255, 99, 132)',
                            fill: false
                        },
                        {
                            label: 'Đã giao',
                            data: chartValues['4'],
                            borderColor: 'rgb(54, 162, 235)',
                            fill: false
                        },
                        {
                            label: 'Đã hủy',
                            data: chartValues['huy_don_hang'],
                            borderColor: 'rgb(75, 192, 192)',
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Ngày'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Số lượng'
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }
                    }
                }
            });
        }
    </script>

    <script>
        // Hàm lấy dữ liệu từ API và cập nhật bảng & biểu đồ
        async function fetchProductActivity(period) {
            try {
                // Gửi yêu cầu lấy dữ liệu theo tham số period
                const response = await fetch(`/api/product-activity?period=${period}`);
                const data = await response.json();

                // Đổ dữ liệu vào bảng sản phẩm
                loadProductTable(data.products);
                // Vẽ biểu đồ doanh thu theo nhóm sản phẩm
                loadCategoryChart(data.categories);
            } catch (error) {
                console.error("Lỗi khi tải dữ liệu:", error);
            }
        }

        // Hàm đổ dữ liệu sản phẩm vào bảng
        function loadProductTable(products) {
            const tableBody = document.querySelector('#product-table tbody');
            tableBody.innerHTML = ''; // Xóa dữ liệu cũ

            products.forEach((product, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${index + 1}</td>
                <td>${product.product_sku}</td>
                <td>${product.product_name} </td>
                <td>${product.sold_quantity}</td>
                <td>${parseFloat(product.revenue).toLocaleString()} ₫</td>
            `;
                tableBody.appendChild(row);
            });
        }


        function loadCategoryChart(categories) {
            const ctx = document.getElementById('category-chart').getContext('2d');

            if (window.categoryChart) {
                window.categoryChart.destroy();
            }

            window.categoryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: categories.map(category => category.category_name),
                    datasets: [{
                        label: 'Doanh thu',
                        data: categories.map(category => category.category_revenue),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true
                }
            });
        }

        window.onload = function() {
            fetchProductActivity('this_week');
        };

        document.getElementById('period').addEventListener('change', function(e) {
            fetchProductActivity(e.target.value);
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Gọi API
            fetch('/api/customer-stats')
                .then(response => response.json())
                .then(data => {
                    // Hiển thị số liệu khách hàng
                    document.getElementById('new-customers').textContent = data.newCustomers;
                    document.getElementById('active-customers').textContent = data.activeCustomers;

                    // Vẽ biểu đồ
                    const ctx = document.getElementById('customerChart').getContext('2d');
                    const chartData = {
                        labels: ['Khách hàng quay lại', 'Khách hàng mới'],
                        datasets: [{
                            label: 'Tỷ lệ khách hàng',
                            data: [data.chartData.returning_customers, data.chartData
                                .new_customers],
                            backgroundColor: ['#36a2eb', '#ff6384'],
                        }]
                    };

                    new Chart(ctx, {
                        type: 'pie',
                        data: chartData,
                        options: {
                            responsive: true,
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        // Hiển thị số và phần trăm trong tooltip
                                        label: function(tooltipItem) {
                                            let total = tooltipItem.dataset.data.reduce((a, b) =>
                                                a + b, 0);
                                            let percentage = Math.round((tooltipItem.raw / total) *
                                                100);
                                            return tooltipItem.label + ': ' + tooltipItem.raw +
                                                ' (' + percentage + '%)';
                                        }
                                    }
                                },
                                // Hiển thị số và phần trăm trên chính các mảnh pie
                                datalabels: {
                                    formatter: function(value, context) {
                                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        let percentage = Math.round((value / total) * 100);
                                        return value + ' (' + percentage +
                                        '%)'; // Hiển thị số và phần trăm
                                    },
                                    color: '#fff',
                                    font: {
                                        weight: 'bold',
                                        size: 16
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error fetching customer stats:', error));
        });
    </script>

    {{-- cart --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Gọi API để lấy dữ liệu thống kê giỏ hàng
            fetch('/api/cart/stats')
                .then(response => response.json())
                .then(data => {
                    // Hiển thị số liệu giỏ hàng
                    document.getElementById('new-carts').textContent = data.newCartsCount;
                    document.getElementById('total-cart-value').textContent = data.totalCartValue;
                })
                .catch(error => console.error('Lỗi khi gọi API:', error));
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Gọi API để lấy tỷ lệ sử dụng voucher
            fetch('/api/voucher-usage-rate')
                .then(response => response.json()) // Chuyển phản hồi thành JSON
                .then(data => {
                    console.log(data); // Kiểm tra dữ liệu trả về từ API

                    // Cập nhật số liệu trên trang
                    document.getElementById('total-vouchers').textContent = data.total_vouchers;
                    document.getElementById('used-vouchers').textContent = data.used_vouchers;
                    document.getElementById('usage-rate').textContent = data.usage_rate;

                    // Vẽ biểu đồ tỷ lệ sử dụng voucher
                    const ctx = document.getElementById('voucherChart').getContext('2d');
                    const chartData = {
                        labels: ['Đã sử dụng', 'Chưa sử dụng'],
                        datasets: [{
                            label: 'Tỷ lệ sử dụng voucher',
                            data: [
                                (parseFloat(data.usage_rate.replace('%', '')) /
                                100), // Chuyển tỷ lệ về giá trị phần trăm
                                1 - (parseFloat(data.usage_rate.replace('%', '')) /
                                100) // Tỷ lệ chưa sử dụng
                            ],
                            backgroundColor: ['#36a2eb', '#ff6384'],
                        }]
                    };

                    new Chart(ctx, {
                        type: 'pie', // Biểu đồ tròn
                        data: chartData,
                    });
                })
                .catch(error => {
                    console.error('Error fetching voucher usage data:', error);
                });
        });
    </script>
@endsection
