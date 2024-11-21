@extends('layouts.backend')
@section('css')
<style>

/* Điều chỉnh kích thước của select */
.custom {
  font-size: 0.875rem; /* Kích thước chữ trong select nhỏ hơn */
  padding: 0.375rem 0.75rem; /* Điều chỉnh padding cho select */
  height: 38px; /* Đảm bảo chiều cao không quá lớn */
  width: 30px; /* Giữ chiều rộng đầy đủ nhưng có thể điều chỉnh */
}

</style>
@endsection
@section('content')
    <!-- Hero -->
    <div class="content">
        <div class="block-content block-content-full">
            <div class="d-flex justify-content-start align-items-center mb-3">

            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6">
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
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span id="total-income">0</span>₫</h4>
                                    <a href="" class="text-decoration-underline">View net earnings</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                        <i class="bx bx-dollar-circle text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Đơn hàng</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-danger fs-sm mb-0">
                                        <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span id="total-orders">0</span></h4>
                                    <a href="" class="text-decoration-underline">Xem tất cả đơn hàng</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info-subtle rounded fs-3">
                                        <i class="bx bx-shopping-bag text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


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
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Tổng doanh thu</h4>
                            <div>
                                <div class="row d-flex justify-content-end">
                                    <div class="col-4">
                                        <select id="yearSelector" class="form-select custom">
                                            <option value="2024" selected>2024</option>
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-sm btn-alt" id="resetButton">Đặt lại</button>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-end">
                                    <div class="col">
                                        <label for="startDate" class="form-label">Từ ngày:</label>
                                        <input type="date" class="form-control" id="startDate">
                                    </div>
                                    <div class="col">
                                        <label for="endDate" class="form-label">Đến ngày:</label>
                                        <input type="date" class="form-control" id="endDate">
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->



                        <div class="card-body p-0 pb-2">
                            <canvas id="revenueChart" width="800" height="400"></canvas>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                    <!-- Biểu đồ -->


                </div>
            </div>



            <div class="row mt-2">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Best Selling Products</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold text-uppercase fs-12">Sort by:
                                        </span><span class="text-muted">Today<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Today</a>
                                        <a class="dropdown-item" href="#">Yesterday</a>
                                        <a class="dropdown-item" href="#">Last 7 Days</a>
                                        <a class="dropdown-item" href="#">Last 30 Days</a>
                                        <a class="dropdown-item" href="#">This Month</a>
                                        <a class="dropdown-item" href="#">Last Month</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="assets/images/products/img-1.png" alt="" class="img-fluid d-block" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Branded T-Shirts</a></h5>
                                                        <span class="text-muted">24 Apr 2021</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$29.00</h5>
                                                <span class="text-muted">Price</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">62</h5>
                                                <span class="text-muted">Orders</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">510</h5>
                                                <span class="text-muted">Stock</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$1,798</h5>
                                                <span class="text-muted">Amount</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="assets/images/products/img-2.png" alt="" class="img-fluid d-block" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Bentwood Chair</a></h5>
                                                        <span class="text-muted">19 Mar 2021</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$85.20</h5>
                                                <span class="text-muted">Price</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">35</h5>
                                                <span class="text-muted">Orders</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal"><span class="badge bg-danger-subtle text-danger">Out of stock</span> </h5>
                                                <span class="text-muted">Stock</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$2982</h5>
                                                <span class="text-muted">Amount</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="assets/images/products/img-3.png" alt="" class="img-fluid d-block" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Borosil Paper Cup</a></h5>
                                                        <span class="text-muted">01 Mar 2021</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$14.00</h5>
                                                <span class="text-muted">Price</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">80</h5>
                                                <span class="text-muted">Orders</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">749</h5>
                                                <span class="text-muted">Stock</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$1120</h5>
                                                <span class="text-muted">Amount</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="assets/images/products/img-4.png" alt="" class="img-fluid d-block" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">One Seater Sofa</a></h5>
                                                        <span class="text-muted">11 Feb 2021</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$127.50</h5>
                                                <span class="text-muted">Price</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">56</h5>
                                                <span class="text-muted">Orders</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal"><span class="badge bg-danger-subtle text-danger">Out of stock</span></h5>
                                                <span class="text-muted">Stock</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$7140</h5>
                                                <span class="text-muted">Amount</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="assets/images/products/img-5.png" alt="" class="img-fluid d-block" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Stillbird Helmet</a></h5>
                                                        <span class="text-muted">17 Jan 2021</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$54</h5>
                                                <span class="text-muted">Price</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">74</h5>
                                                <span class="text-muted">Orders</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">805</h5>
                                                <span class="text-muted">Stock</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$3996</h5>
                                                <span class="text-muted">Amount</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                <div class="col-sm">
                                    <div class="text-muted">
                                        Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">25</span> Results
                                    </div>
                                </div>
                                <div class="col-sm-auto  mt-3 mt-sm-0">
                                    <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                        <li class="page-item disabled">
                                            <a href="#" class="page-link">←</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">1</a>
                                        </li>
                                        <li class="page-item active">
                                            <a href="#" class="page-link">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">→</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Top Sellers</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Download Report</a>
                                        <a class="dropdown-item" href="#">Export</a>
                                        <a class="dropdown-item" href="#">Import</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/companies/img-1.png" alt="" class="avatar-sm p-2" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1 fw-medium">
                                                            <a href="apps-ecommerce-seller-details.html" class="text-reset">iTest Factory</a>
                                                        </h5>
                                                        <span class="text-muted">Oliver Tyler</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">Bags and Wallets</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">8547</p>
                                                <span class="text-muted">Stock</span>
                                            </td>
                                            <td>
                                                <span class="text-muted">$541200</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm mb-0">32%<i class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i></h5>
                                            </td>
                                        </tr><!-- end -->
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/companies/img-2.png" alt="" class="avatar-sm p-2" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="fs-sm my-1 fw-medium"><a href="apps-ecommerce-seller-details.html" class="text-reset">Digitech Galaxy</a></h5>
                                                        <span class="text-muted">John Roberts</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">Watches</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">895</p>
                                                <span class="text-muted">Stock</span>
                                            </td>
                                            <td>
                                                <span class="text-muted">$75030</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm mb-0">79%<i class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i></h5>
                                            </td>
                                        </tr><!-- end -->
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/companies/img-3.png" alt="" class="avatar-sm p-2" />
                                                    </div>
                                                    <div class="flex-gow-1">
                                                        <h5 class="fs-sm my-1 fw-medium"><a href="apps-ecommerce-seller-details.html" class="text-reset">Nesta Technologies</a></h5>
                                                        <span class="text-muted">Harley Fuller</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">Bike Accessories</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">3470</p>
                                                <span class="text-muted">Stock</span>
                                            </td>
                                            <td>
                                                <span class="text-muted">$45600</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm mb-0">90%<i class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i></h5>
                                            </td>
                                        </tr><!-- end -->
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/companies/img-8.png" alt="" class="avatar-sm p-2" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="fs-sm my-1 fw-medium"><a href="apps-ecommerce-seller-details.html" class="text-reset">Zoetic Fashion</a></h5>
                                                        <span class="text-muted">James Bowen</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">Clothes</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">5488</p>
                                                <span class="text-muted">Stock</span>
                                            </td>
                                            <td>
                                                <span class="text-muted">$29456</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm mb-0">40%<i class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i></h5>
                                            </td>
                                        </tr><!-- end -->
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/companies/img-5.png" alt="" class="avatar-sm p-2" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="fs-sm my-1 fw-medium">
                                                            <a href="apps-ecommerce-seller-details.html" class="text-reset">Meta4Systems</a>
                                                        </h5>
                                                        <span class="text-muted">Zoe Dennis</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">Furniture</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">4100</p>
                                                <span class="text-muted">Stock</span>
                                            </td>
                                            <td>
                                                <span class="text-muted">$11260</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm mb-0">57%<i class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i></h5>
                                            </td>
                                        </tr><!-- end -->
                                    </tbody>
                                </table><!-- end table -->
                            </div>

                            <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                <div class="col-sm">
                                    <div class="text-muted">
                                        Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">25</span> Results
                                    </div>
                                </div>
                                <div class="col-sm-auto  mt-3 mt-sm-0">
                                    <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                        <li class="page-item disabled">
                                            <a href="#" class="page-link">←</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">1</a>
                                        </li>
                                        <li class="page-item active">
                                            <a href="#" class="page-link">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">→</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div> <!-- .card-body-->
                    </div> <!-- .card-->
                </div> <!-- .col-->
            </div> <!-- end row-->

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
    <script src="{{ asset('admin/js/ui/charts/widgets.js') }}"></script>
    <script src="{{ asset('admin/js/ui/charts/revenue.js') }}"></script>
    <script src="{{ asset('admin/js/ui/charts/order-status.js') }}"></script>
    <script>

    </script>
@endsection
