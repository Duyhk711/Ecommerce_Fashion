@extends('layouts.backend')

@section('content')
<div class="content">
    <div class="container mt-5">
        <h2>Dashboard - Biểu đồ doanh thu</h2>

        <div class="row">
            <div class="col-6">
                <!-- Dropdown chọn loại biểu đồ -->
                <label for="timeFilter" class="form-label">Chọn khoảng thời gian:</label>
                <select id="timeFilter" class="form-select w-25 mb-3">
                    <option value="daily">Theo ngày</option>
                    <option value="weekly">Theo tuần</option>
                    <option value="monthly">Theo tháng</option>
                    <option value="yearly">Theo năm</option>
                </select>
            </div>

            <!-- Bộ lọc khoảng ngày -->
            <div class="col-6 mb-4">
                <label for="startDate" class="form-label">Từ ngày:</label>
                <input type="date" id="startDate" class="form-control d-inline w-25">
                <label for="endDate" class="form-label ms-3">Đến ngày:</label>
                <input type="date" id="endDate" class="form-control d-inline w-25">
                <button id="filterButton" class="btn btn-primary ms-3">Lọc</button>
            </div>

            <!-- Biểu đồ -->
            <div class="col-8">
                <canvas id="revenueChart" width="800" height="400"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Dữ liệu mẫu cho từng loại
    const chartData = {
        daily: {
            labels: ['2024-11-13', '2024-11-14', '2024-11-15', '2024-11-16', '2024-11-17', '2024-11-18', '2024-11-19'],
            data: [120, 200, 150, 80, 90, 100, 170],
            label: 'Doanh thu theo ngày (VNĐ)'
        },
        weekly: {
            labels: ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'],
            data: [1000, 1500, 2000, 1800],
            label: 'Doanh thu theo tuần (VNĐ)'
        },
        monthly: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            data: [5000, 4000, 4500, 4800, 5200, 4900, 5300, 5500, 6000, 6500, 7000, 7500],
            label: 'Doanh thu theo tháng (VNĐ)'
        },
        yearly: {
            labels: ['2020', '2021', '2022', '2023', '2024'],
            data: [50000, 60000, 55000, 70000, 75000],
            label: 'Doanh thu theo năm (VNĐ)'
        }
    };

    // Tạo hiệu ứng gradient cho đường biểu đồ
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(75, 192, 192, 1)');
    gradient.addColorStop(1, 'rgba(153, 102, 255, 0.2)');

    // Khởi tạo biểu đồ với đường cong mượt và điểm
    let revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.daily.labels,
            datasets: [{
                label: chartData.daily.label,
                data: chartData.daily.data,
                borderColor: gradient, // Màu sắc gradient cho đường
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Màu sắc của điểm
                pointBorderColor: 'rgba(75, 192, 192, 1)',
                pointRadius: 5, // Kích thước của điểm
                fill: true, // Điền màu dưới đường
                tension: 0.4, // Đường cong mượt
                lineTension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.raw.toLocaleString('vi-VN')} VNĐ`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + ' VNĐ';
                        }
                    }
                }
            }
        }
    });

    // Cập nhật dữ liệu khi thay đổi loại biểu đồ
    document.getElementById('timeFilter').addEventListener('change', function () {
        const selected = this.value;
        const newData = chartData[selected];

        revenueChart.data.labels = newData.labels;
        revenueChart.data.datasets[0].data = newData.data;
        revenueChart.data.datasets[0].label = newData.label;

        revenueChart.update();
    });

    // Lọc dữ liệu theo khoảng ngày
    document.getElementById('filterButton').addEventListener('click', function () {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (!startDate || !endDate) {
            alert('Vui lòng chọn khoảng ngày!');
            return;
        }

        const filteredData = chartData.daily.labels.map((label, index) => {
            if (label >= startDate && label <= endDate) {
                return chartData.daily.data[index];
            }
            return null;
        }).filter(value => value !== null);

        const filteredLabels = chartData.daily.labels.filter((label) => label >= startDate && label <= endDate);

        revenueChart.data.labels = filteredLabels;
        revenueChart.data.datasets[0].data = filteredData;
        revenueChart.update();
    });
</script>
@endsection
