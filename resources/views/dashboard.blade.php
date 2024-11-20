@extends('layouts.backend')
@section('css')
@endsection
@section('content')
    <!-- Hero -->
    <div class="content">
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Tổng thu nhập</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-sm mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value"
                                            data-target="559.25">0</span>k </h4>
                                    <a href="" class="text-decoration-underline">View net earnings</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                        <i class="bx bx-dollar-circle text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Đơn hàng</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-danger fs-sm mb-0">
                                        <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                            data-target="36894">0</span></h4>
                                    <a href="" class="text-decoration-underline">View all orders</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info-subtle rounded fs-3">
                                        <i class="bx bx-shopping-bag text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Customers</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-sm mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                            data-target="183.35">0</span>M </h4>
                                    <a href="" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning-subtle rounded fs-3">
                                        <i class="bx bx-user-circle text-warning"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> My Balance</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-muted fs-sm mb-0">
                                        +0.00 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value"
                                            data-target="165.89">0</span>k </h4>
                                    <a href="" class="text-decoration-underline">Withdraw money</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                        <i class="bx bx-wallet text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->

            <div class="row mt-4">
                <div class="col-xl-8">
                    <div class="card p-4">
                        <div class="d-flex align-items-center mb-3">
                            <label for="filterType" class="form-label me-2">Lọc theo:</label>
                            <select id="filterType" class="form-select w-auto">
                                <option value="year">Theo năm</option>
                                <option value="month" selected>Theo tháng</option>
                                <option value="date_range">Khoảng ngày</option>
                            </select>
                        </div>

                        <div id="monthFilter" class="mb-3" style="display: block;">
                            <div class="d-flex align-items-center">
                                <label for="yearSelect" class="form-label me-2">Chọn năm:</label>
                                <select id="yearSelect" class="form-select w-auto">
                                    <option value="2024">2024</option>
                                </select>
                            </div>
                        </div>

                        <div id="dateRangeFilter" class="mb-3" style="display: none;">
                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <label for="startDate" class="form-label">Từ ngày:</label>
                                    <input type="date" id="startDate" class="form-control">
                                </div>
                                <div>
                                    <label for="endDate" class="form-label">Đến ngày:</label>
                                    <input type="date" id="endDate" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div>
                            <canvas id="revenueChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <h2 class="content-heading">TOP SẢN PHẨM</h2>
            <div class="row">
                <div class="col-md-6">
                    <!--  Latest Orders -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                Danh sách sản phẩm bán chạy
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                    <!-- <i class="si si-refresh"></i> -->
                                </button>
                                <div class="dropdown">
                                    <button type="button" class="btn-block-option" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <!-- <i class="si si-chemistry"></i> -->
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-dot-circle opacity-50 me-1"></i> Pending
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-times-circle opacity-50 me-1"></i> Canceled
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-check-circle opacity-50 me-1"></i> Completed
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-eye opacity-50 me-1"></i> View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <table class="table table-striped table-hover table-borderless table-vcenter fs-sm">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>Product</th>
                                        <th class="d-none d-xl-table-cell">Date</th>
                                        <th>Status</th>
                                        <th class="d-none d-sm-table-cell text-end" style="width: 120px;">Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">iPhone 11 Pro</span>
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <span class="fs-sm text-muted">today</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-warning">Pending..</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-end fw-medium">
                                            $1199,99
                                        </td>
                                        <td class="text-center text-nowrap fw-medium">
                                            <a href="javascript:void(0)">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">iPhone 11 Pro</span>
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <span class="fs-sm text-muted">today</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-warning">Pending..</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-end fw-medium">
                                            $1199,99
                                        </td>
                                        <td class="text-center text-nowrap fw-medium">
                                            <a href="javascript:void(0)">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">iPhone 11 Pro</span>
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <span class="fs-sm text-muted">today</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-warning">Pending..</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-end fw-medium">
                                            $1199,99
                                        </td>
                                        <td class="text-center text-nowrap fw-medium">
                                            <a href="javascript:void(0)">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">iPhone 11 Pro</span>
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <span class="fs-sm text-muted">today</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-warning">Pending..</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-end fw-medium">
                                            $1199,99
                                        </td>
                                        <td class="text-center text-nowrap fw-medium">
                                            <a href="javascript:void(0)">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">iPhone 11 Pro</span>
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <span class="fs-sm text-muted">today</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-warning">Pending..</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-end fw-medium">
                                            $1199,99
                                        </td>
                                        <td class="text-center text-nowrap fw-medium">
                                            <a href="javascript:void(0)">
                                                View
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="block-content block-content-full block-content-sm bg-body-light fs-sm text-center">
                      <a class="fw-medium" href="javascript:void(0)">
                        Xem tất cả đơn hàng
                        <i class="fa fa-arrow-right ms-1 opacity-25"></i>
                      </a>
                    </div> -->
                    </div>
                    <!-- END Latest Orders -->
                </div>
                <div class="col-md-6">
                    <!--  Latest Orders -->
                    <div class="block block-rounded block-mode-loading-refresh">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                Danh sách sản phẩm có lượt đánh giá cao
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                    <!-- <i class="si si-refresh"></i> -->
                                </button>
                                <div class="dropdown">
                                    <button type="button" class="btn-block-option" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <!-- <i class="si si-chemistry"></i> -->
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-dot-circle opacity-50 me-1"></i> Pending
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-times-circle opacity-50 me-1"></i> Canceled
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-check-circle opacity-50 me-1"></i> Completed
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-eye opacity-50 me-1"></i> View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <table class="table table-striped table-hover table-borderless table-vcenter fs-sm">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>Product</th>
                                        <th class="d-none d-xl-table-cell">Date</th>
                                        <th>Status</th>
                                        <th class="d-none d-sm-table-cell text-end" style="width: 120px;">Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">iPhone 11 Pro</span>
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <span class="fs-sm text-muted">today</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-warning">Pending..</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-end fw-medium">
                                            $1199,99
                                        </td>
                                        <td class="text-center text-nowrap fw-medium">
                                            <a href="javascript:void(0)">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">iPhone 11 Pro</span>
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <span class="fs-sm text-muted">today</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-warning">Pending..</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-end fw-medium">
                                            $1199,99
                                        </td>
                                        <td class="text-center text-nowrap fw-medium">
                                            <a href="javascript:void(0)">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">iPhone 11 Pro</span>
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <span class="fs-sm text-muted">today</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-warning">Pending..</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-end fw-medium">
                                            $1199,99
                                        </td>
                                        <td class="text-center text-nowrap fw-medium">
                                            <a href="javascript:void(0)">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">iPhone 11 Pro</span>
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <span class="fs-sm text-muted">today</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-warning">Pending..</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-end fw-medium">
                                            $1199,99
                                        </td>
                                        <td class="text-center text-nowrap fw-medium">
                                            <a href="javascript:void(0)">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">iPhone 11 Pro</span>
                                        </td>
                                        <td class="d-none d-xl-table-cell">
                                            <span class="fs-sm text-muted">today</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-warning">Pending..</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell text-end fw-medium">
                                            $1199,99
                                        </td>
                                        <td class="text-center text-nowrap fw-medium">
                                            <a href="javascript:void(0)">
                                                View
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Latest Orders -->
                </div>


            </div>

            <div class="row mt-4">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Order Status Distribution</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="orderStatusPieChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Recent Orders</h4>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-soft-info btn-sm">
                                    <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                </button>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Vendor</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="apps-ecommerce-order-details.html"
                                                    class="fw-medium link-primary">#VZ2112</a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/users/avatar-1.jpg" alt=""
                                                            class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">Alex Smith</div>
                                                </div>
                                            </td>
                                            <td>Clothes</td>
                                            <td>
                                                <span class="text-success">$109.00</span>
                                            </td>
                                            <td>Zoetic Fashion</td>
                                            <td>
                                                <span class="badge bg-success-subtle text-success">Paid</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm fw-medium mb-0">5.0<span
                                                        class="text-muted fs-11 ms-1">(61
                                                        votes)</span></h5>
                                            </td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td>
                                                <a href="apps-ecommerce-order-details.html"
                                                    class="fw-medium link-primary">#VZ2111</a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/users/avatar-2.jpg" alt=""
                                                            class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">Jansh Brown</div>
                                                </div>
                                            </td>
                                            <td>Kitchen Storage</td>
                                            <td>
                                                <span class="text-success">$149.00</span>
                                            </td>
                                            <td>Micro Design</td>
                                            <td>
                                                <span class="badge bg-warning-subtle text-warning">Pending</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm fw-medium mb-0">4.5<span
                                                        class="text-muted fs-11 ms-1">(61
                                                        votes)</span></h5>
                                            </td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td>
                                                <a href="apps-ecommerce-order-details.html"
                                                    class="fw-medium link-primary">#VZ2109</a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/users/avatar-3.jpg" alt=""
                                                            class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">Ayaan Bowen</div>
                                                </div>
                                            </td>
                                            <td>Bike Accessories</td>
                                            <td>
                                                <span class="text-success">$215.00</span>
                                            </td>
                                            <td>Nesta Technologies</td>
                                            <td>
                                                <span class="badge bg-success-subtle text-success">Paid</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm fw-medium mb-0">4.9<span
                                                        class="text-muted fs-11 ms-1">(89
                                                        votes)</span></h5>
                                            </td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td>
                                                <a href="apps-ecommerce-order-details.html"
                                                    class="fw-medium link-primary">#VZ2108</a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/users/avatar-4.jpg" alt=""
                                                            class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">Prezy Mark</div>
                                                </div>
                                            </td>
                                            <td>Furniture</td>
                                            <td>
                                                <span class="text-success">$199.00</span>
                                            </td>
                                            <td>Syntyce Solutions</td>
                                            <td>
                                                <span class="badge bg-danger-subtle text-danger">Unpaid</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm fw-medium mb-0">4.3<span
                                                        class="text-muted fs-11 ms-1">(47
                                                        votes)</span></h5>
                                            </td>
                                        </tr><!-- end tr -->
                                        <tr>
                                            <td>
                                                <a href="apps-ecommerce-order-details.html"
                                                    class="fw-medium link-primary">#VZ2107</a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/users/avatar-6.jpg" alt=""
                                                            class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">Vihan Hudda</div>
                                                </div>
                                            </td>
                                            <td>Bags and Wallets</td>
                                            <td>
                                                <span class="text-success">$330.00</span>
                                            </td>
                                            <td>iTest Factory</td>
                                            <td>
                                                <span class="badge bg-success-subtle text-success">Paid</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm fw-medium mb-0">4.7<span
                                                        class="text-muted fs-11 ms-1">(161
                                                        votes)</span></h5>
                                            </td>
                                        </tr><!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('admin/js/ui/charts/revenue.js') }}"></script>
    <script src="{{ asset('admin/js/ui/charts/order-status.js') }}"></script>
@endsection
