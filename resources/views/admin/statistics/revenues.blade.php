@extends('layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Thống kê doanh thu</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#" style="color: inherit;">Thống kê</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Doanh thu</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <div class="content">
        <div class="row">
            <div class="col-6">
                <div class="block">
                    <div class="card">
                        <div class="card-header">
                            <h6>Doanh thu theo phương thức thanh toán</h6>
                        </div>
                        <div class="card-body">
                            <div style="width: 60%; margin:  auto;">
                                <canvas id="paymentMethodChart"></canvas>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-6">
                <div class="block">
                    <div class="card">
                        <div class="card-header">
                            <h6>Biểu đồ phân bổ doanh thu</h6>
                        </div>
                        <div class="card-body">
                            <div style=" margin:  auto; height: 300px;">
                                <canvas id="monthlyRevenueChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="row mt-4">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <div class="col-9">
                                <h4 class="card-title mb-0 flex-grow-1">Biểu đồ doanh thu</h4>
                            </div>
                            <div class="col-1">
                                <select id="yearSelector" class="form-control">
                                    <option value="2024" selected>2024</option>
                                    {{-- <option value="2023">2023</option> --}}
                                    {{-- <option value="2022">2022</option> --}}
                                </select>
                            </div>
                            <div class="col-1 dropdown">
                                <!-- Nút dropdown -->
                                <button class="btn btn-sm btn-alt dropdown-toggle" type="button" id="dateDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
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
                            <canvas id="revenueChart" width="800" height="300"></canvas>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="block">
                    <div class="card">
                        <div class="card-header border-0 align-items-center ">
                            <h5>Tỉ lệ doanh thu theo danh mục</h5>

                        </div>
                        <div class="card-body">
                            <div style="width: 60%; margin:  auto;">
                                <canvas id="categoryRevenueChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-6">
                <div class="block">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h5>Danh sách chi tiết</h5>
                        </div>
                        <div class="card-body">
                            <table id="categoryDetailsTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Danh mục</th>
                                        <th>Số lượng bán</th>
                                        <th>Doanh thu</th>
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
        
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{ asset('admin/js/ui/charts/revenue.js') }}"></script>
    <script src="{{asset('admin/js/ui/statistic/revenues/categories.js')}}"></script>
    <script src="{{asset('admin/js/ui/statistic/revenues/payment-method.js')}}"></script>
@endsection
