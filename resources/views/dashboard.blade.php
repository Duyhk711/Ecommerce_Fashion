@extends('layouts.backend')
@section('css')
<style>
  .pie-chart {
    position: relative;
    width: 150px;
    height: 150px;
    margin: 0 auto;
  }

  .pie-chart span {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 16px;
    text-align: center;
  }
</style>
@endsection
@section('content')
<!-- Hero -->
<div class="content">
  <div class="d-md-flex justify-content-md-between align-items-md-center py-3 pt-md-3 pb-md-0 text-center text-md-start">
    <div>
      <h1 class="h3 mb-1">
        Thống Kê
      </h1>
      <p class="fw-medium mb-0 text-muted">
        <!-- Welcome, admin! You have <a class="fw-medium" href="javascript:void(0)">8 new notifications</a>. -->
      </p>
    </div>
    <div class="mt-4 mt-md-0">
      <a class="btn btn-sm btn-alt-primary" href="javascript:void(0)">
        <i class="fa fa-cog"></i>
      </a>
      <div class="dropdown d-inline-block">
        <button type="button" class="btn btn-sm btn-alt-primary px-3" id="dropdown-analytics-overview" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Last 30 days <i class="fa fa-fw fa-angle-down"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end fs-sm" aria-labelledby="dropdown-analytics-overview">
          <a class="dropdown-item" href="javascript:void(0)">This Week</a>
          <a class="dropdown-item" href="javascript:void(0)">Previous Week</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="javascript:void(0)">This Month</a>
          <a class="dropdown-item" href="javascript:void(0)">Previous Month</a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
  <!-- Overview -->


  <div class="row items-push">
    <div class="col-sm-6 col-xl-3">
      <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1">
          <div class="item rounded-3 bg-body mx-auto my-3">
            <i class="fa fa-users fa-lg text-primary"></i>
          </div>
          <div class="fs-1 fw-bold">423</div>
          <div class="text-muted mb-3"> Người dùng đã đăng kí</div>
          <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-light">
                <i class="fa fa-caret-up me-1"></i>
                19.2%
              </div> -->
        </div>
        <!-- <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
              <a class="fw-medium" href="javascript:void(0)">
                Xem chi tiết
                <i class="fa fa-arrow-right ms-1 opacity-25"></i>
              </a>
            </div> -->
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1">
          <div class="item rounded-3 bg-body mx-auto my-3">
            <i class="nav-main-link-icon fa fa-box text-primary"></i>
          </div>
          <div class="fs-1 fw-bold">15</div>
          <div class="text-muted mb-3">Sản phẩm mới</div>
          <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                <i class="fa fa-caret-down me-1"></i>
                2.3%
              </div> -->
        </div>
        <!-- <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
              <a class="fw-medium" href="javascript:void(0)">
                Xem chi tiết
                <i class="fa fa-arrow-right ms-1 opacity-25"></i>
              </a>
            </div> -->
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1">
          <div class="item rounded-3 bg-body mx-auto my-3">
            <i class="fa fa-cart-shopping fa-lg text-primary"></i>
          </div>
          <div class="fs-1 fw-bold">386</div>
          <div class="text-muted mb-3">Đơn hàng</div>
          <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-success bg-success-light">
                <i class="fa fa-caret-up me-1"></i>
                7.9%
              </div> -->
        </div>
        <!-- <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
              <a class="fw-medium" href="javascript:void(0)">
                Xem chi tiết
                <i class="fa fa-arrow-right ms-1 opacity-25"></i>
              </a>
            </div> -->
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="block block-rounded text-center d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full">
          <div class="item rounded-3 bg-body mx-auto my-3">
            <i class="nav-main-link-icon fa fa-comments text-primary"></i>
          </div>
          <div class="fs-1 fw-bold">1203</div>
          <div class="text-muted mb-3">Bình luận</div>
          <!-- <div class="d-inline-block px-3 py-1 rounded-pill fs-sm fw-semibold text-danger bg-danger-light">
                <i class="fa fa-caret-down me-1"></i>
                0.3%
              </div> -->
        </div>
        <!-- <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
              <a class="fw-medium" href="javascript:void(0)">
                Xem chi tiết
                <i class="fa fa-arrow-right ms-1 opacity-25"></i>
              </a>
            </div> -->
      </div>
    </div>
  </div>


  <!-- END Overview -->

  <!-- Store Growth -->
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        Biểu đồ doanh thu trong tháng
      </h3>
      <div class="block-options">
        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
          <!-- <i class="si si-refresh"></i> -->
        </button>
        <button type="button" class="btn-block-option">
          <!-- <i class="si si-wrench"></i> -->
        </button>
      </div>
    </div>
    <div class="block-content block-content-full">
      <div class="">

        <div class="col-12 d-md-flex align-items-md-center">
          <div class="p-md-2 p-lg-3 w-100" style="height: 600px;">
            <!-- Bars Chart Container -->
            <!-- Chart.js Chart is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _js/pages/be_pages_dashboard.js -->
            <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
            <canvas style="height: 100%;width: 100%;" id="revenueChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Store Growth -->

  <div class="row">
    <div class="col-xl-12">
      <!-- Simple -->
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">Biểu đồ thống kế theo đơn hàng</h3>
          <div class="block-options">
            <button type="button" class="js-pie-randomize btn-block-option" data-bs-toggle="tooltip" title="Randomize">
              <!-- <i class="fa fa-random"></i> -->
            </button>
          </div>
        </div>
        <div class="block-content block-content-full">
          <div class="row text-center">
            <div class="col-6 col-md-4 py-3">
              <div class="js-pie-chart pie-chart" data-percent="25" data-line-width="2" data-size="150" data-bar-color="#e04f1a" data-track-color="#e9e9e9">
                <span>25%<br><small class="text-muted">tỉ lệ hủy</small></span>
              </div>
            </div>

            <!-- Biểu đồ tỷ lệ hoàn thành -->
            <div class="col-6 col-md-4 py-3">
              <div class="js-pie-chart pie-chart" data-percent="90" data-line-width="2" data-size="150" data-bar-color="#8dc451" data-track-color="#e9e9e9">
                <span>90%<br><small class="text-muted">tỉ lệ hoàn thành</small></span>
              </div>
            </div>

            <!-- Biểu đồ trạng thái đơn hàng -->
            <div class="col-6 col-md-4 py-3">
              <div class="js-pie-chart pie-chart" data-percent="50" data-line-width="2" data-size="150" data-bar-color="#ffb119" data-track-color="#e9e9e9">
                <span>50%<br><small class="text-muted">trạng thái đơn hàng</small></span>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- END Simple -->
    </div>

  </div>
  <!-- Latest Orders + Stats -->
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
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
              <!-- <i class="si si-refresh"></i> -->
            </button>
            <div class="dropdown">
              <button type="button" class="btn-block-option" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
              <!-- <i class="si si-refresh"></i> -->
            </button>
            <div class="dropdown">
              <button type="button" class="btn-block-option" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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


  </div>


  <!-- END Latest Orders + Stats -->
</div>
<!-- END Page Content -->

<!-- END Main Container -->
@endsection
@section('js')

<script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script>
<!-- jQuery (required for Easy Pie Chart + jQuery Sparkline plugin) -->
<script src="{{ asset('admin/js/lib/jquery.min.js') }}"></script>

<!-- Page JS Plugins -->
<script src="{{ asset('admin/js/plugins/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/chart.js/chart.umd.js') }}"></script>

<!-- Page JS Code -->
<script src="{{asset('admin/js/pages/be_comp_charts.min.js') }}"></script>

<!-- Page JS Helpers (Easy Pie Chart + jQuery Sparkline Plugins) -->
<script>
  Dashmix.helpersOnLoad(['jq-easy-pie-chart', 'jq-sparkline']);
</script>

@endsection