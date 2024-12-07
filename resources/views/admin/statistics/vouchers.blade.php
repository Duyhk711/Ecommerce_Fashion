@extends('layouts.backend')
@section('content')
<div class="bg-body-light">
  <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
          <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Thống kê mã khuyến mại</h1>
          <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                      <a href="#" style="color: inherit;">Thống kê</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Khuyến mại</li>
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
                  <h6>Tỷ lệ sử dụng mã khuyến mại</h6>
              </div>
              <div style="width: 89%; margin:  auto;" class="pt-3">
                <canvas id="voucher-usage"></canvas>
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
                  <h6>Tổng doanh thu đơn hàng sử dụng mã khuyến mại</h6>
              </div>
              <div style="width: 85%; margin:  auto;" class="pt-3">
                <canvas id="voucher-revenue"></canvas>
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
                <h6>Hiệu suất</h6>
            </div>
            <div style="width: 85%; margin:  auto;" class="pt-3">
              <canvas id="voucher-performance"></canvas>
            </div>
        </div>
      </div>
    </div>

    <div class="col-6">
      <div class="block">
          <div class="card">
              <div class="card-header border-0 align-items-center d-flex">
                  <h5>Mã giảm giá gần đây</h5>
              </div>
              <div class="card-body">
                  <table id="categoryDetailsTable" class="table table-bordered">
                      <thead>
                          <tr>
                              <th>STT</th>
                              <th>Mã</th>
                              <th>Loại</th>
                              <th>Số lượng</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Giam10%</td>
                          <td>Giảm theo %</td>
                          <td>100</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Giam20%</td>
                          <td>Giảm theo %</td>
                          <td>100</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Giam30%</td>
                          <td>Giảm theo %</td>
                          <td>100</td>
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

<script>
  const ctx1 = document.getElementById('voucher-usage').getContext('2d');
  new Chart(ctx1, {
    type: 'pie',
    data: {
      labels: ['Đã sử dụng', 'Không được sử dụng'],
      datasets: [{
        data: [65, 35], // Example data: 65% used, 35% not used
        backgroundColor: ['#36a2eb', '#ff6384']
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: 'top' },
      }
    }
  });
</script>

<script>
  const ctx2 = document.getElementById('voucher-revenue').getContext('2d');
  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['Đơn hàng sử dụng voucher', 'Đơn hàng không sử dụng voucher'],
      datasets: [{
        label: 'Doanh thu (VND)',
        data: [50000000, 150000000], // Example: Revenue from voucher vs. no voucher
        backgroundColor: ['#4caf50', '#f57c00']
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true }
      },
      plugins: {
        legend: { display: false },
      }
    }
  });
</script>

<script>
  const ctx3 = document.getElementById('voucher-performance').getContext('2d');
  new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: ['Số tiền theo %', 'Số tiền cố định'], // Example voucher types
      datasets: [{
        label: 'Số lần sử dụng',
        data: [120, 90], // Example usage data
        backgroundColor: ['#ff9800', '#3f51b5', '#8bc34a']
      }]
    },
    options: {
      responsive: true,
      indexAxis: 'y', // Makes it horizontal
      scales: {
        x: { beginAtZero: true }
      },
      plugins: {
        legend: { position: 'top' },
      }
    }
  });
</script>
@endsection