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
  <div class="block">
      <div class="card">
          <div class="card-header">
              <form id="filterForm">
                  <div class="d-flex justify-content-end">
                      <div class="justify-content-end me-3">
                          <label for="start_date">Từ ngày</label>
                          <input type="date" class="form-control" id="start_date" name="start_date">
                      </div>
                      <div class="justify-content-end">
                          <label for="end_date">Đến ngày</label>
                          <input type="date" class="form-control" id="end_date" name="end_date">
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>

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
                  <div class="card pb-4 ">
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

  <div class="block">
      <div class="card">
          <div class="card-header border-0 align-items-center d-flex">
              <h5>Danh sách mã giảm giá</h5>
          </div>
          <div class="card-body">
              <table id="categoryDetailsTable" class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Mã</th>
                          <th>Loại</th>
                          <th>Thời gian</th>
                          <th>Số lần sử dụng</th>
                          <th>Doanh thu tạo ra (VND)</th>
                          <th>Lợi nhuận (VND)</th>
                          <th>Độ hiệu quả</th>
                      </tr>
                  </thead>
                  <tbody id="voucherTableBody">
                      <!-- Dữ liệu sẽ được cập nhật qua AJAX -->
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Function to fetch data and update charts
  function fetchDataAndUpdateCharts(start_date, end_date) {
    $.ajax({
        url: "{{ route('statistic.voucherUsageRate') }}",
        method: 'GET',
        data: {
            start_date: start_date || '', // Nếu không có ngày bắt đầu, gửi rỗng
            end_date: end_date || '' // Nếu không có ngày kết thúc, gửi rỗng
        },
        success: function(data) {
            // Kiểm tra và hủy biểu đồ cũ nếu có
            if (window.chartVoucherUsage) {
                window.chartVoucherUsage.destroy();
            }

            // Vẽ lại biểu đồ mới
            const ctx1 = document.getElementById('voucher-usage').getContext('2d');
            window.chartVoucherUsage = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: ['Đã sử dụng (%)', 'Không được sử dụng (%)'],
                    datasets: [{
                        data: [data.usage_rate, 100 - data.used_vouchers],
                        backgroundColor: ['#36a2eb', '#ff6384']
                    }],
                }
            });
        }
    });

      $.ajax({
        url: "{{ route('statistic.getTotalRevenue') }}",
        method: 'GET',
        data: {
            start_date: start_date || '',
            end_date: end_date || ''
        },
        success: function(data) {
            // Kiểm tra và hủy biểu đồ cũ nếu có
            if (window.chartVoucherRevenue) {
                window.chartVoucherRevenue.destroy();
            }

            // Vẽ lại biểu đồ mới
            const ctx2 = document.getElementById('voucher-revenue').getContext('2d');
            const revenueWithVoucher = formatCurrency(data.revenue_with_voucher);
            const revenueWithoutVoucher = formatCurrency(data.revenue_without_voucher);
            window.chartVoucherRevenue = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Đơn hàng sử dụng voucher', 'Đơn hàng không sử dụng voucher'],
                    datasets: [{
                        label: 'Doanh thu (VND)',
                        data: [data.revenue_with_voucher, data.revenue_without_voucher],
                        backgroundColor: ['#4caf50', '#f57c00']
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            // Lặp lại cho biểu đồ khác nếu cần
            if (window.chartOther) {
                window.chartOther.destroy();
            }

            const ctx3 = document.getElementById('other-chart').getContext('2d');
            window.chartOther = new Chart(ctx3, {
                type: 'line',
                data: {
                    labels: ['Label1', 'Label2', 'Label3'],
                    datasets: [{
                        label: 'Another Chart',
                        data: [12, 19, 3],
                        backgroundColor: '#ff0000'
                    }]
                },
                options: {
                    responsive: true
                }
            });
        }
    });


      $.ajax({
        url: "{{ route('statistic.getDiscountStatistics') }}",
        method: 'GET',
        data: {
            start_date: start_date,
            end_date: end_date
        },
        success: function(data) {
            console.log(data); // Kiểm tra dữ liệu trả về
            // const sortedData = data.sort((a, b) => b.effectiveness - a.effectiveness);
            // console.log("Dữ liệu đã sắp xếp:", sortedData);
            // Chuyển đối tượng thành mảng và duyệt qua các phần tử
            let tableBody = '';
            Object.values(data).forEach(function(voucher) {
                tableBody += `
                    <tr>
                        <td>${voucher.code}</td>
                        <td>${voucher.discount_type}</td>
                        <td>${voucher.start_date} - ${voucher.end_date}</td>
                        <td>${voucher.usage_count}</td>
                        <td>${formatNumber(voucher.revenue)}</td>
                        <td>${formatNumber(voucher.profit)}</td>
                        <td>${voucher.effectiveness}%</td>
                    </tr>
                `;
            });
            $('#voucherTableBody').html(tableBody);
        }
    });

  }

    function safeParseNumber(input) {
        const number = Number(input);
        return isNaN(number) ? 0 : number; // Trả về 0 nếu không chuyển được thành số
    }

    function formatNumber(number) {
        if (typeof number !== 'number' || isNaN(number)) {
            console.error('Giá trị không hợp lệ:', number);
            return '0';
        }

        // Nhân số với 1000
        const multipliedNumber = number * 1000;

        // Định dạng số và thay dấu ',' thành '.'
        const formattedNumber = new Intl.NumberFormat('vi-VN', { maximumFractionDigits: 0 }).format(multipliedNumber);
        return formattedNumber.replace(/,/g, '.');
    }

  $(document).ready(function() {
      // Lắng nghe sự kiện change của các trường ngày
      $('#start_date, #end_date').on('change', function() {
          const start_date = $('#start_date').val();
          const end_date = $('#end_date').val();
          fetchDataAndUpdateCharts(start_date, end_date);
      });

      // Kiểm tra nếu có giá trị ngày đã chọn và gọi API khi tải trang
      const start_date = $('#start_date').val();
      const end_date = $('#end_date').val();
      if (start_date && end_date) {
          fetchDataAndUpdateCharts(start_date, end_date);
      } else {
          fetchDataAndUpdateCharts(); // Gọi API để hiển thị dữ liệu toàn bộ nếu không có ngày lọc
      }
  });

</script>

@endsection