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
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h6 class="card-title mb-0">Tỷ lệ chốt đơn</h6>
                    <div class=" d-flex align-items-center">
                      <select id="filterSelect" class="form-select form-select-sm" style="width: 100%"x>
                          <option id="filter-all" value="all">Tất cả</option>
                          <option id="filter-week" value="week">Tuần trước</option>
                          <option id="filter-month" value="month">Tháng trước</option>
                          <option id="filter-year" value="year">Năm nay</option>
                      </select>
                    </div>
                    {{-- <div class="dropdown">
                      <button class="btn dropdown-toggle" style="border: none; margin-top: -10px" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                          Lọc
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                          <li><a class="dropdown-item" href="#" id="filter-day">Ngày</a></li>
                          <li><a class="dropdown-item" href="#" id="filter-week">Tuần</a></li>
                          <li><a class="dropdown-item" href="#" id="filter-month">Tháng</a></li>
                          <li><a class="dropdown-item" href="#" id="filter-year">Năm</a></li>
                          <li><a class="dropdown-item" href="#" id="filter-all">Tất cả</a></li>
                      </ul>
                    </div> --}}
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
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h6 class="card-title mb-0 ">Tỷ lệ khách hàng quay lại</h6>
                    <div class="d-flex align-items-center" style="width: 40%">
                      <label for="filterYearSelect" class="" style="width: 100%">Lọc theo năm:</label>
                      <select id="filterYearSelect" class="form-select form-select-sm">
                          <option value="2024">2024</option>
                          <option value="2023">2025</option>
                          <option value="2025">2026</option>
                          <!-- Thêm các năm khác nếu cần -->
                      </select>
                    </div>
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
              <div class="card-header d-flex align-items-center justify-content-between">
                  <h6 class="card-title mb-0">Tần suất mua hàng</h6>
                  <div class="d-flex align-items-center" style="width: 40%">
                    <label for="filterYearSelectPurchase" class="" style="width: 100%">Lọc theo:</label>
                    <select id="filterYearSelectPurchase" class="form-select form-select-sm">
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <!-- Thêm các năm khác nếu cần -->
                    </select>
                  </div>
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
                    <h6 class="card-title mb-0">Danh sách khách hàng chi tiêu cao nhất</h6>
                    <select id="filterYearSelectTable" class="form-select form-select-sm" style="width: 25%; margin-left: 5%">
                      <option value="all">Tất cả</option>
                      <option value="month">Tháng trước</option>
                      <option value="quarter">quý trước</option>
                      <option value="year">Năm nay</option>
                      <!-- Thêm các năm khác nếu cần -->
                    </select>
                </div>
                <div class="card-body">
                    <table id="categoryDetailsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Khách hàng</th>
                                <th>Đơn hàng</th>
                                <th>Tổng chi tiêu (VND)</th>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('admin/js/ui/charts/customer.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
          // Hàm để gọi API và vẽ lại biểu đồ
          function fetchDataAndRenderChart(filterType) {
              $.ajax({
                  url: "{{ route('statistic.orderSuccessRate') }}", // API Route
                  method: 'GET',
                  data: {
                      filter: filterType // Truyền loại lọc (all, week, month, year)
                  },
                  success: function(data) {
                      const successRate = data.success_rate;
                      const failureRate = data.failure_rate;

                      // Vẽ lại Pie Chart
                      const ctx = document.getElementById('orderSuccessRate').getContext('2d');

                      // Nếu biểu đồ đã tồn tại, hủy nó trước khi vẽ lại
                      if (window.orderSuccessRateChart) {
                          window.orderSuccessRateChart.destroy();
                      }

                      window.orderSuccessRateChart = new Chart(ctx, {
                          type: 'pie',
                          data: {
                              labels: ['Chốt đơn', 'Không chốt'],
                              datasets: [{
                                  data: [data.success_rate, 100 - data.success_rate],
                                  backgroundColor: ['#36a2eb', '#ff6384'],
                              }]
                          },
                          options: {
                              responsive: true,
                              plugins: {
                                  legend: {
                                      position: 'top',
                                  },
                                  tooltip: {
                                      callbacks: {
                                          label: function(tooltipItem) {
                                              return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                                          }
                                      }
                                  }
                              }
                          }
                      });
                  },
                  error: function(xhr, status, error) {
                      console.error('Có lỗi khi gọi API:', error);
                  }
              });
          }

          // Lắng nghe sự kiện change của dropdown select
          $('#filterSelect').change(function() {
              const filterType = $(this).val(); // Lấy giá trị đã chọn trong dropdown
              fetchDataAndRenderChart(filterType); // Gửi tham số lọc tương ứng
          });

          // Gọi mặc định để hiển thị biểu đồ khi trang được load lần đầu tiên
          fetchDataAndRenderChart('all'); // Lọc theo "Tất cả" mặc định
      });
    </script>

    <script>
      $(document).ready(function() {
          // Hàm để gọi API và vẽ lại biểu đồ
          function fetchDataAndRenderChart(year) {
              $.ajax({
                  url: "{{ route('statistic.returningCustomerRate') }}", // API Route
                  method: 'GET',
                  data: {
                      year: year // Truyền năm để lọc dữ liệu
                  },
                  success: function(data) {
                      const monthlyReturnRates = data.monthly_return_rates;

                      // Dữ liệu cho biểu đồ
                      const labels = monthlyReturnRates.map(item => {
                          const monthNames = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
                          return monthNames[item.month - 1]; // Lấy tên tháng
                      });

                      const returnRates = monthlyReturnRates.map(item => item.return_rate);

                      // Vẽ lại Bar Chart
                      const ctx = document.getElementById('customerReturnRate').getContext('2d');

                      // Nếu biểu đồ đã tồn tại, hủy nó trước khi vẽ lại
                      if (window.customerReturnRateChart) {
                          window.customerReturnRateChart.destroy();
                      }

                      window.customerReturnRateChart = new Chart(ctx, {
                          type: 'bar',
                          data: {
                              labels: labels,
                              datasets: [{
                                  label: 'Tỷ lệ quay lại (%)',
                                  data: returnRates,
                                  backgroundColor: '#36a2eb', // Màu cột
                                  borderColor: '#36a2eb',
                                  borderWidth: 1
                              }]
                          },
                          options: {
                              responsive: true,
                              plugins: {
                                  legend: {
                                      position: 'top',
                                  },
                                  tooltip: {
                                      callbacks: {
                                          label: function(tooltipItem) {
                                              return tooltipItem.label + ': ' + tooltipItem.raw + '%'; // Hiển thị % trên tooltip
                                          }
                                      }
                                  }
                              },
                              scales: {
                                  y: {
                                      beginAtZero: true,
                                      ticks: {
                                          stepSize: 10
                                      }
                                  }
                              }
                          }
                      });
                  },
                  error: function(xhr, status, error) {
                      console.error('Có lỗi khi gọi API:', error);
                  }
              });
          }

          // Lắng nghe sự kiện change của dropdown select
          $('#filterYearSelect').change(function() {
              const selectedYear = $(this).val(); // Lấy năm đã chọn trong dropdown
              fetchDataAndRenderChart(selectedYear); // Gửi tham số năm tương ứng
          });

          // Gọi mặc định để hiển thị biểu đồ khi trang được load lần đầu tiên
          fetchDataAndRenderChart('2024'); // Mặc định hiển thị dữ liệu cho năm 2024
      });
    </script>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
          const ctx = document.getElementById('purchaseFrequency').getContext('2d');
          const yearFilter = document.getElementById('filterYearSelectPurchase');
          let purchaseFrequencyChart;

          // Function to fetch data from API using AJAX
          function fetchPurchaseFrequency(year, callback) {
              $.ajax({
                url: `{{ route('statistic.purchaseFrequency') }}?year=${year}`,
                  method: 'GET',
                  dataType: 'json',
                  success: function (response) {
                      callback(null, response);
                  },
                  error: function (xhr, status, error) {
                      console.error('Error fetching data:', error);
                      callback(error, null);
                  },
              });
          }

          // Function to render Line Chart
          function renderPurchaseFrequencyChart(data) {
              const months = data.map(item => `Tháng ${item.month}`);
              const frequencies = data.map(item => item.frequency);

              // Destroy existing chart instance if any
              if (purchaseFrequencyChart) {
                  purchaseFrequencyChart.destroy();
              }

              // Render chart
              purchaseFrequencyChart = new Chart(ctx, {
                  type: 'line',
                  data: {
                      labels: months,
                      datasets: [
                          {
                              label: 'Tần suất mua hàng',
                              data: frequencies,
                              borderColor: 'rgba(75, 192, 192, 1)',
                              backgroundColor: 'rgba(75, 192, 192, 0.2)',
                              borderWidth: 2,
                              tension: 0.3,
                          },
                      ],
                  },
                  options: {
                      responsive: true,
                      plugins: {
                          legend: {
                              display: true,
                              position: 'top',
                          },
                          tooltip: {
                              callbacks: {
                                  label: context =>
                                      `Tần suất: ${context.raw.toFixed(2)}`,
                              },
                          },
                      },
                      scales: {
                          x: {
                              title: {
                                  display: true,
                                  text: 'Tháng',
                              },
                          },
                          y: {
                              beginAtZero: true,
                              title: {
                                  display: true,
                                  text: 'Tần suất',
                              },
                          },
                      },
                  },
              });
          }

          // Initial Load and Event Listener for Year Selection
          const loadChart = () => {
              const selectedYear = yearFilter.value;
              fetchPurchaseFrequency(selectedYear, (error, data) => {
                  if (!error) {
                      renderPurchaseFrequencyChart(data.monthly_purchase_frequency);
                  }
              });
          };

          yearFilter.addEventListener('change', loadChart);

          // Load chart for the first time
          loadChart();
      });
    </script>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
          const filterYearSelectTable = document.getElementById('filterYearSelectTable');
          const categoryDetailsTableBody = document.querySelector('#categoryDetailsTable tbody');

          // Hàm gọi API lấy danh sách khách hàng chi tiêu cao nhất
          function fetchTopSpendingCustomers(filter, callback) {
              $.ajax({
                  url: `{{ route('statistic.topSpendingCustomers') }}`,
                  method: 'GET',
                  data: {
                      filter: filter
                  },
                  dataType: 'json',
                  success: function (response) {
                      callback(null, response);
                  },
                  error: function (xhr, status, error) {
                      console.error('Error fetching data:', error);
                      callback(error, null);
                  },
              });
          }

          // Hàm cập nhật bảng với dữ liệu từ API
          function renderTopSpendingCustomers(customers) {
              // Xóa dữ liệu cũ trong bảng
              categoryDetailsTableBody.innerHTML = '';

              // Nếu không có dữ liệu, hiển thị dòng "Không có dữ liệu"
              if (customers.length === 0) {
                  const row = document.createElement('tr');
                  row.innerHTML = `<td colspan="4" style="text-align: center;">Không có dữ liệu</td>`;
                  categoryDetailsTableBody.appendChild(row);
              } else {
                  // Duyệt qua danh sách khách hàng và thêm vào bảng
                  customers.forEach((customer, index) => {
                      const row = document.createElement('tr');

                      // Check if each field has data, otherwise show default value
                      const name = customer.name || 'Không có dữ liệu';
                      const ordersCount = customer.orders_count || 0;
                      const totalSpent = customer.total_spent ? new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(customer.total_spent) : 'Không có dữ liệu';

                      row.innerHTML = `
                          <td>${index + 1}</td>
                          <td>${name}</td>
                          <td>${ordersCount}</td>
                          <td>${formatNumber(customer.total_spent)}</td>
                      `;

                      categoryDetailsTableBody.appendChild(row);
                  });
              }
          }


          // Hàm tải dữ liệu và render khi thay đổi bộ lọc
          const loadTableData = () => {
              const selectedFilter = filterYearSelectTable.value;
              fetchTopSpendingCustomers(selectedFilter, (error, data) => {
                  if (!error && data.customers) {
                      renderTopSpendingCustomers(data.customers);
                  } else {
                      console.error('Failed to load table data.');
                  }
              });
          };

          // Lắng nghe sự kiện thay đổi bộ lọc
          filterYearSelectTable.addEventListener('change', loadTableData);

          // Tải dữ liệu khi trang được tải lần đầu
          loadTableData();

          function formatNumber(number) {
              // Nhân số với 1000
              let formattedNumber = number * 1000;

              // Chuyển đổi thành chuỗi và ngắt thành phần hàng nghìn
              return formattedNumber.toLocaleString('en', { maximumFractionDigits: 0 });
          }

      });


    </script>


@endsection