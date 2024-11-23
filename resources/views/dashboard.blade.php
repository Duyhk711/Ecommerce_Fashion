@extends('layouts.backend')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
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
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span id="total-income">0</span>₫</h4>
                                    {{-- <a href="" class="text-decoration-underline">View net earnings</a> --}}
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
                                        <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span id="total-orders">0</span></h4>
                                    {{-- <a href="" class="text-decoration-underline">Xem tất cả đơn hàng</a> --}}
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Khách hàng</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-sm mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span class="counter-value" data-target="0">0</span>
                                    </h4>
                                    {{-- <a href="" class="text-decoration-underline">Xem chi tiết</a> --}}
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
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Sản phẩm đã bán</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-muted fs-sm mb-0">

                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <span id="total-sold-products">0</span>
                                    </h4>
                                    {{-- <a href="#" class="text-decoration-underline">Xem chi tiết</a> --}}
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger-subtle rounded fs-3">
                                        <i class="bx bx-shopping-bag text-danger"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

            </div> <!-- end row-->

            <div class="row mt-4">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <div class="col-9"><h4 class="card-title mb-0 flex-grow-1">Tổng doanh thu</h4></div>
                                <div class="col-1">
                                    <select id="yearSelector" class="form-control">
                                        <option value="2024" selected>2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                                <div class="col-1 dropdown">
                                    <!-- Nút dropdown -->
                                    <button class="btn btn-sm btn-alt dropdown-toggle" type="button" id="dateDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Tùy chỉnh
                                    </button>

                                    <!-- Nội dung dropdown -->
                                    <div class="dropdown-menu p-3" aria-labelledby="dateDropdown">
                                        <div class="row d-flex justify-content-end">
                                            <div class="col-12 mb-3">
                                                <label for="startDate" class="form-label">Từ ngày:</label>
                                                <input type="date" class="form-control" id="startDate">
                                            </div>
                                            <div class="col-12">
                                                <label for="endDate" class="form-label">Đến ngày:</label>
                                                <input type="date" class="form-control" id="endDate">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 text-center">
                                    <button class="btn btn-sm btn-alt" id="resetButton">Đặt lại</button>
                                </div>
                        </div><!-- end card header -->

                        <!-- Biểu đồ -->
                        <div class="card-body p-0 pb-2">
                            <canvas id="revenueChart" width="800" height="400"></canvas>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Sản phẩm bán chạy</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold text-uppercase fs-12">Lọc theo:
                                        </span><span class="text-muted">Hôm nay<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Hôm nay</a>
                                        <a class="dropdown-item" href="#">Hôm qua</a>
                                        <a class="dropdown-item" href="#">7 ngày trước</a>
                                        <a class="dropdown-item" href="#">30 ngày trước</a>
                                        <a class="dropdown-item" href="#">Trong tháng này</a>
                                        <a class="dropdown-item" href="#">Tháng trước</a>
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
                                                        <img src="{{asset('assets/storage/products/1.jpg')}}" alt="" class="img-fluid d-block" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Áo phông nam in chữ</a></h5>
                                                        <span class="text-muted">24 Apr 2021</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$29.00</h5>
                                                <span class="text-muted">Giá</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">62</h5>
                                                <span class="text-muted">Đơn hàng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">510</h5>
                                                <span class="text-muted">Số lượng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$10.298.230đ</h5>
                                                <span class="text-muted">Tổng</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="{{asset('assets/storage/products/1.jpg')}}" alt="" class="img-fluid d-block" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Áo phông nam in chữ</a></h5>
                                                        <span class="text-muted">24 Apr 2021</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$29.00</h5>
                                                <span class="text-muted">Giá</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">62</h5>
                                                <span class="text-muted">Đơn hàng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">510</h5>
                                                <span class="text-muted">Số lượng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$10.298.230đ</h5>
                                                <span class="text-muted">Tổng</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="{{asset('assets/storage/products/1.jpg')}}" alt="" class="img-fluid d-block" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Áo phông nam in chữ</a></h5>
                                                        <span class="text-muted">24 Apr 2021</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$29.00</h5>
                                                <span class="text-muted">Giá</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">62</h5>
                                                <span class="text-muted">Đơn hàng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">510</h5>
                                                <span class="text-muted">Số lượng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$10.298.230đ</h5>
                                                <span class="text-muted">Tổng</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="{{asset('assets/storage/products/1.jpg')}}" alt="" class="img-fluid d-block" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Áo phông nam in chữ</a></h5>
                                                        <span class="text-muted">24 Apr 2021</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$29.00</h5>
                                                <span class="text-muted">Giá</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">62</h5>
                                                <span class="text-muted">Đơn hàng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">510</h5>
                                                <span class="text-muted">Số lượng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$10.298.230đ</h5>
                                                <span class="text-muted">Tổng</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-light rounded p-1 me-2">
                                                        <img src="{{asset('assets/storage/products/1.jpg')}}" alt="" class="img-fluid d-block" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1"><a href="apps-ecommerce-product-details.html" class="text-reset">Áo phông nam in chữ</a></h5>
                                                        <span class="text-muted">24 Apr 2021</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$29.00</h5>
                                                <span class="text-muted">Giá</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">62</h5>
                                                <span class="text-muted">Đơn hàng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">510</h5>
                                                <span class="text-muted">Số lượng</span>
                                            </td>
                                            <td>
                                                <h5 class="fs-sm my-1 fw-normal">$10.298.230đ</h5>
                                                <span class="text-muted">Tổng</span>
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
                            <h4 class="card-title mb-0 flex-grow-1">Top 5 sản phẩm đánh giá tốt nhất</h4>
                            <div class="flex-shrink-0">
                                <div class="dropdown card-header-dropdown">
                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        {{-- <a class="dropdown-item" href="#">Download Report</a>
                                        <a class="dropdown-item" href="#">Export</a>
                                        <a class="dropdown-item" href="#">Import</a> --}}
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
                                                            <a href="apps-ecommerce-seller-details.html" class="text-reset">Áo phông nam in chữ</a>
                                                        </h5>
                                                        <span class="text-muted"></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">Áo phông nam</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">20</p>
                                                <span class="text-muted">Rate</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">4.8</p>
                                                <span class="text-muted">Trung bình</span>
                                            </td>
                                        </tr><!-- end -->
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/companies/img-1.png" alt="" class="avatar-sm p-2" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1 fw-medium">
                                                            <a href="apps-ecommerce-seller-details.html" class="text-reset">Áo phông nam in chữ</a>
                                                        </h5>
                                                        <span class="text-muted"></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">Áo phông nam</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">20</p>
                                                <span class="text-muted">Rate</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">4.8</p>
                                                <span class="text-muted">Trung bình</span>
                                            </td>
                                        </tr><!-- end -->
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/companies/img-1.png" alt="" class="avatar-sm p-2" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1 fw-medium">
                                                            <a href="apps-ecommerce-seller-details.html" class="text-reset">Áo phông nam in chữ</a>
                                                        </h5>
                                                        <span class="text-muted"></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">Áo phông nam</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">20</p>
                                                <span class="text-muted">Rate</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">4.8</p>
                                                <span class="text-muted">Trung bình</span>
                                            </td>
                                        </tr><!-- end -->
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/companies/img-1.png" alt="" class="avatar-sm p-2" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1 fw-medium">
                                                            <a href="apps-ecommerce-seller-details.html" class="text-reset">Áo phông nam in chữ</a>
                                                        </h5>
                                                        <span class="text-muted"></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">Áo phông nam</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">20</p>
                                                <span class="text-muted">Rate</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">4.8</p>
                                                <span class="text-muted">Trung bình</span>
                                            </td>
                                        </tr><!-- end -->
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="assets/images/companies/img-1.png" alt="" class="avatar-sm p-2" />
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-sm my-1 fw-medium">
                                                            <a href="apps-ecommerce-seller-details.html" class="text-reset">Áo phông nam in chữ</a>
                                                        </h5>
                                                        <span class="text-muted"></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">Áo phông nam</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">20</p>
                                                <span class="text-muted">Rate</span>
                                            </td>
                                            <td>
                                                <p class="mb-0">4.8</p>
                                                <span class="text-muted">Trung bình</span>
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
                            <h4 class="card-title mb-0 flex-grow-1">Tỉ lệ trạng thái đơn hàng</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="orderStatusPieChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Đơn hàng gần đây</h4>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-soft-info btn-sm">
                                    <i class="ri-file-list-3-line align-middle"></i>
                                </button>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-border table-centered align-middle table-nowrap fs-sm mb-0">
                                    <thead class="text-muted table-light ">
                                        <tr>
                                            <th scope="col" class="text-muted">Mã đơn hàng</th>
                                            <th scope="col" class="text-muted">Khách hàng</th>
                                            <th scope="col" class="text-muted">Sản phẩm</th>
                                            <th scope="col" class="text-muted">Tổng tiền</th>
                                            <th scope="col" class="text-muted">Trạng thái</th>
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
