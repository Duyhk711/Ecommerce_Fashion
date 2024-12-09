@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Thống kê đơn hàng </h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#" style="color: inherit;">Thống kê</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">
        {{-- <div class="d-flex justify-content-between mb-4">
            <select id="filterSelect" class="form-select" aria-label="Chọn khoảng thời gian">
                <option value="all_time">Tất cả thời gian</option>
                <option value="this_year">Năm nay</option>
                <option value="this_month">Tháng này</option>
            </select>
        </div> --}}
        

        <div class="row ">
            <div class="col-3">
                <!-- Tổng sản phẩm -->
                <div class="card card-animate">
                    <div class="card-body">
                        <p class="text-uppercase fw-medium text-muted mb-0">Tổng sản phẩm</p>
                        <h4 class="fs-22 fw-semibold mt-4">
                            <span class="total-products">0</span>
                        </h4>
                    </div>
                </div>
            </div>

             <!-- Tổng đơn hàng -->
             <div class="col-3">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tổng đơn hàng</p>
                            </div>
                            <div class="flex-shrink-0">
                                <h5 class="text-success fs-14 mb-0">
                                    {{-- <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 % --}}
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                        data-target="0">0</span></h4>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle rounded fs-3">
                                    <i class="bx bx-cart text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div>
    
            <div class="col-3">
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

            <div class="col-3">
                <!-- Tổng doanh thu -->
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tổng doanh thu</p>
                            </div>
                            <div class="flex-shrink-0">
                                <h5 class="text-success fs-14 mb-0">
                                    {{-- <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 % --}}
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                        data-target="1">0</span>₫</h4>
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

        {{--  --}}
        <div class="row mt-4">
            <div class="col">
                <div class="block block-rounder">
                    <div class="card">
                        <div class="card-header align-items-center">
                            <h6 class="card-title mb-0 flex-grow-1">Biều đồ số đơn hàng và sản phẩm bán ra</h6>
                        </div>
                    </div>
                    <div style="width: 90%; margin: 0 auto; margin-top: 50px;">
                        <canvas id="orderProductChart"></canvas>
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
                                <h6 class="card-title mb-0 flex-grow-1">Top 10 đơn hàng có giá trị cao nhất</h6>
                                <div class="flex-shrink-0">
                                    <div class="d-flex align-items-center">
                                        <label for="filterSelect" class="" style="width: 100%">Lọc theo:</label>
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

    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const orderShowUrl = "{{ route('admin.order.show', ':id') }}";
    </script>
    <script src="{{ asset('admin/js/ui/statistic/orders/top-revenue.js') }}"></script>
    <script src="{{ asset('admin/js/ui/statistic/orders/stats-order-product.js') }}"></script>
    <script src="{{ asset('admin/js/ui/statistic/orders/sales.js') }}"></script>
    
@endsection
