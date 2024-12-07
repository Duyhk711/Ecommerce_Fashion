@extends('layouts.backend')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-6">
                <div class="block block-rounder">
                    <!-- Lọc theo thời gian -->
                    <div class="d-flex justify-content-between mb-4">
                        <select id="filterSelect" class="form-select" aria-label="Chọn khoảng thời gian">
                            <option value="all_time">Tất cả thời gian</option>
                            <option value="this_year">Năm nay</option>
                            <option value="this_month">Tháng này</option>
                        </select>
                    </div>
                
                    <!-- Tổng đơn hàng -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tổng đơn hàng</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="0">0</span></h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                        <i class="bx bx-cart text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                
                    <!-- Tổng doanh thu -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tổng doanh thu</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="1">0</span>k</h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                        <i class="bx bx-dollar-circle text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
                
            </div>

            <div class="col-6">
                <div class="block block-rounded">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0 flex-grow-1">Tỉ lệ trạng thái đơn hàng</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="orderStatusPieChart" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        {{--  --}}
        <div class="row">
            <div class="col">
                <div class="block block-rounder">
                    <h5>biều đồ doanh thu của đơn hàng</h5>
                    <div style="width: 70%; margin: 0 auto; margin-top: 50px;">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{--  --}}
        <div class="row">
            <div class="col">
                <div class="block block-rounder">
                    <div class="col">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Recent Orders</h4>
                                <div class="flex-shrink-0">
                                    <div class="d-flex align-items-center">
                                        <label for="filterSelect" class="me-2">Lọc theo:</label>
                                        <select id="filterSelect" class="form-select form-select-sm">
                                            <option value="all_time">Tất cả</option>
                                            <option value="last_week">Tuần trước</option>
                                            <option value="last_month">Tháng trước</option>
                                            <option value="this_year">Năm nay</option>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- end card header -->
                        
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">Mã đơn hàng</th>
                                                <th scope="col">Khách hàng</th>
                                                <th scope="col">Giá trị</th>
                                                <th scope="col">Ngày đặt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- JS sẽ chèn dữ liệu tại đây -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- .card-->
                        
                    </div> <!-- .col-->
                </div>
            </div>
        </div>

        {{--  --}}
        <div class="row">
            <div class="col-3">
                <div class="block block-rounder">
                    <!-- Tổng sản phẩm -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <p class="text-uppercase fw-medium text-muted mb-0">Tổng sản phẩm</p>
                            <h4 class="fs-22 fw-semibold mt-4">
                                <span class="total-products">0</span>
                            </h4>
                        </div>
                    </div>
                
                    <!-- Sản phẩm đã bán -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <p class="text-uppercase fw-medium text-muted mb-0">Sản phẩm đã bán</p>
                            <h4 class="fs-22 fw-semibold mt-4">
                                <span class="sold-products">0</span>
                            </h4>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-9">
                <div class="block">
                    <div style="width: 80%; margin: 0 auto; margin-top: 50px;">
                        <canvas id="salesComparisonChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')\
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- tron --}}
<script src="{{asset('admin/js/ui/statistic/orders/sales.js')}}"></script>

{{-- line --}}
<script>
    // Lấy canvas cho biểu đồ line
    const lineChartCtx = document.getElementById('lineChart').getContext('2d');

    // Dữ liệu doanh thu theo thời gian (ví dụ 6 tháng)
    const lineChartData = {
        labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],
        datasets: [{
            label: 'Doanh thu',
            data: [1200, 1500, 1800, 2200, 2500, 2800], // Giá trị doanh thu theo từng tháng
            fill: false,
            borderColor: '#4bc0c0', // Màu đường vẽ
            tension: 0.1 // Độ cong của đường
        }]
    };

    // Tùy chọn cấu hình cho biểu đồ line (đổi tên thành lineChartOptions)
    const lineChartOptions = {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const label = context.dataset.label || '';
                        const value = context.raw || 0;
                        return `${label}: ${value} VND`;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true, // Đảm bảo trục Y bắt đầu từ 0
                ticks: {
                    callback: function(value) {
                        return value + ' VND'; // Định dạng giá trị y là VND
                    }
                }
            }
        }
    };

    // Khởi tạo biểu đồ line
    new Chart(lineChartCtx, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    });
</script>

<script src="{{asset('admin/js/ui/statistic/orders/top-revenue.js')}}"></script>

<script>document.addEventListener("DOMContentLoaded", function () {
    fetch('/api/statistics/products')
        .then(response => response.json())
        .then(data => {
            // Hiển thị tổng sản phẩm
            document.querySelector('.total-products').textContent = data.total_products;

            // Hiển thị sản phẩm đã bán
            document.querySelector('.sold-products').textContent = data.sold_products;
        })
        .catch(error => console.error('Lỗi:', error));
});
</script>
{{-- cot --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Lấy canvas cho biểu đồ bar
    const barChartCtx = document.getElementById('salesComparisonChart').getContext('2d');

    // Gọi API để lấy dữ liệu
    fetch('/api/monthly-sales')
        .then(response => response.json())
        .then(data => {
            // Xử lý dữ liệu từ API
            const labels = data.map(item => `Tháng ${item.month}`);
            const sales = data.map(item => item.total_sales);

            // Cấu hình biểu đồ
            const salesData = {
                labels: labels,
                datasets: [{
                    label: 'Số lượng sản phẩm bán ra',
                    data: sales,
                    backgroundColor: '#FF5733',
                    borderColor: '#FF5733',
                    borderWidth: 1
                }]
            };

            const barChartOptions = {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const value = context.raw || 0;
                                return `${value} sản phẩm`; // Chỉ hiển thị số lượng sản phẩm
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 50,
                            callback: function (value) {
                                return value + ' sản phẩm'; // Định dạng giá trị y là số sản phẩm
                            }
                        }
                    }
                }
            };

            // Khởi tạo biểu đồ
            new Chart(barChartCtx, {
                type: 'bar',
                data: salesData,
                options: barChartOptions
            });
        })
        .catch(error => console.error('Lỗi khi lấy dữ liệu:', error));
});

</script>
@endsection