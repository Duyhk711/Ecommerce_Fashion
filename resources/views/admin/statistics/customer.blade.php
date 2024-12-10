@extends('layouts.backend')
@section('css')
    <style>
      body {
          font-family: Arial, sans-serif;
          margin: 20px;
      }

      .chart-container {
          width: 600px;
          margin: 20px auto;
          text-align: center;
      }
      /* .chart-pie {
          width: 70%;
          margin: 20px auto;
          text-align: center;
      } */

      h3 {
          margin-bottom: 10px;
          color: #333;
      }
    </style>
@endsection
@section('content')
  <div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Thống kê theo khách hàng</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" style="color: inherit;">Thống kê</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Khách hàng</li>
                </ol>
            </nav>
        </div>
    </div>
  </div>

  <div class="content">
    <div class="row">

      <div class="col-4">
        <div class="chart-pie">
          <div class="block">
            <div class="card pb-3">
                <div class="card-header">
                    <h6>Tỷ lệ chốt đơn</h6>
                </div>
                <div style="width: 89%; margin:  auto;" class="pt-3">
                  <canvas id="orderSuccessRate"></canvas>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-8">
        <div class="chart-pie">
          <div class="block">
            <div class="card pb-3 ">
                <div class="card-header">
                    <h6>Tỷ lệ khách hàng quay lại</h6>
                </div>
                <div style="width: 85%; margin:  auto;" class="pt-3">
                  <canvas id="customerReturnRate"></canvas>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-6">
        <div class="block">
          <div class="card pb-3 ">
              <div class="card-header">
                  <h6>Tần suất mua hàng</h6>
              </div>
              <div style="width: 85%; margin:  auto;" class="pt-3">
                <canvas id="purchaseFrequency"></canvas>
              </div>
          </div>
        </div>
      </div>

      <div class="col-6">
        <div class="block">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h5>Danh sách khách hàng chi tiêu cao nhất</h5>
                </div>
                <div class="card-body">
                    <table id="categoryDetailsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Đơn hàng</th>
                                <th>Tổng chi tiêu</th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Nguyễn Văn A</td>
                            <td>30</td>
                            <td>10.330.000đ</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>Nguyễn Văn B</td>
                            <td>20</td>
                            <td>7.240.000đ</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>Nguyễn Văn C</td>
                            <td>10</td>
                            <td>4.050.000đ</td>
                          </tr>
                          <tr>
                            <td>4</td>
                            <td>Nguyễn Văn D</td>
                            <td>5</td>
                            <td>2.340.000đ</td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('admin/js/ui/charts/customer.js') }}"></script>
@endsection