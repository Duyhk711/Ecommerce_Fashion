@extends('layouts.backend')
@section('css')
<style>
  
    
    .chart-legend {
      margin-top: 20px;
    }
    .chart-legend div {
      display: flex;
      justify-content: space-between;
      margin-bottom: 5px;
    }
    .legend-color {
      display: inline-block;
      width: 15px;
      height: 15px;
      margin-right: 10px;
      border-radius: 50%;
    }
    .male { background-color: #4CAF50; }
    .female { background-color: #FFC107; }
    .others { background-color: #2196F3; }
</style>
@endsection
@section('content')
<!-- Hero -->

<!-- Page Content -->
<div class="content">
  <div class="row">
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Earnings</p>
                    </div>
                    <div class="flex-shrink-0">
                        <h5 class="text-success fs-14 mb-0">
                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                        </h5>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="559.25">0</span>k </h4>
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
                     <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Orders</p>
                    </div>
                    <div class="flex-shrink-0">
                        <h5 class="text-danger fs-14 mb-0">
                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                        </h5>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="36894">0</span></h4>
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
                        <h5 class="text-success fs-14 mb-0">
                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                        </h5>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="183.35">0</span>M </h4>
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
                        <h5 class="text-muted fs-14 mb-0">
                            +0.00 %
                        </h5>
                    </div>
                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="165.89">0</span>k </h4>
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
  
  <!-- Store Growth -->
  <div class="block block-rounded">
    <div class="row mt-4">
        <div class="col-xl-12">
              <div class="card">
                  <div class="card-header border-0 align-items-center d-flex">
                      <div class="col-9"><h4 class="card-title mb-0 flex-grow-1">Biểu đồ doanh thu</h4></div>
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
                      <canvas id="revenueChart" width="800" height="300"></canvas>
                  </div><!-- end card body -->
              </div><!-- end card -->
        </div>
    </div>
  </div>

  <div class="row align-items-center mt-4">
    <div class="col-xl-6">
      <div class="block block-rounded">
        <div class="card">
          <div class="card-header">
            <h6> nhóm khách hàng</h6>
          </div>
        </div>

        <div class="row">
          <!-- Biểu đồ -->
          <div class="col-6">
            <canvas id="buyersChart" width="200" height="200"></canvas>
          </div>
          <!-- Mô tả (Legend) -->
          <div class="col-6 chart-legend">
            <div>
              <span><span class="legend-color male"></span> Male</span>
              <span>50.8%</span>
            </div>
            <div>
              <span><span class="legend-color female"></span> Female</span>
              <span>35.7%</span>
            </div>
            <div>
              <span><span class="legend-color others"></span> Others</span>
              <span>15.9%</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END Page Content -->

<!-- END Main Container -->
@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('admin/js/ui/charts/revenue.js') }}"></script>
<script>
  // Lấy phần tử canvas
  const ctx2 = document.getElementById('buyersChart').getContext('2d');

  // Dữ liệu cho biểu đồ
  const data = {
    labels: ['Male', 'Female', 'Others'], // Các phân loại
    datasets: [{
      data: [50.8, 35.7, 15.9], // Phần trăm
      backgroundColor: ['#4CAF50', '#FFC107', '#2196F3'], // Màu sắc từng phần
      hoverOffset: 4, // Hiệu ứng khi di chuột
    }]
  };

  // Cấu hình biểu đồ
  const config = {
    type: 'doughnut',
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false, // Ẩn chú thích mặc định
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              const label = context.label || '';
              const value = context.raw || 0;
              return `${label}: ${value}%`;
            }
          }
        }
      },
      cutout: '70%', // Tạo khoảng trống giữa biểu đồ
    }
  };

  // Tạo biểu đồ
  new Chart(ctx2, config);
</script>
@endsection