document.addEventListener('DOMContentLoaded', function() {
    // Fetch dữ liệu từ API
    fetch('/api/dashboard/overview')
        .then(response => response.json())
        .then(data => {
            // Hiển thị dữ liệu Tổng quan bán hàng
            document.querySelector('.highlight').textContent = data.orders_summary.total_revenue
                .toLocaleString('vi-VN') + ' ₫';
            document.querySelector('#waiting_confirmation').textContent = data.orders_summary
                .waiting_confirmation;
            document.querySelector('#delivered').textContent = data.orders_summary.delivered;
            document.querySelector('#cancelled').textContent = data.orders_summary.cancelled;

            // Biểu đồ dữ liệu
            displayChart(data.chart_data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});

// Hàm để hiển thị biểu đồ (sử dụng Chart.js)
function displayChart(chartData) {
    // Các label sẽ là các ngày trong tuần từ thứ Hai đến Chủ Nhật
    const chartLabels = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật'];

    // Khởi tạo dữ liệu cho các trạng thái
    const chartValues = {
        '1': [0, 0, 0, 0, 0, 0, 0], // Chờ xác nhận
        '5': [0, 0, 0, 0, 0, 0, 0], // Đã giao
        'huy_don_hang': [0, 0, 0, 0, 0, 0, 0] // Đã hủy
    };

    // Xử lý dữ liệu ngày tháng từ chartData (API trả về)
    const currentDate = new Date();
    const firstDayOfWeek = currentDate.getDate() - currentDate.getDay() + 1; // Thứ 2 của tuần hiện tại
    const firstDayOfWeekDate = new Date(currentDate.setDate(firstDayOfWeek));

    // Lặp qua tất cả các ngày trong tuần và gán giá trị 0 cho các ngày không có dữ liệu
    for (let i = 0; i < 7; i++) {
        const dayDate = new Date(firstDayOfWeekDate);
        dayDate.setDate(firstDayOfWeekDate.getDate() + i);
        const formattedDate = dayDate.toISOString().split('T')[0]; // Chuyển ngày thành định dạng YYYY-MM-DD

        if (chartData[formattedDate]) {
            chartData[formattedDate].forEach(statusData => {
                if (chartValues[statusData.status] !== undefined) {
                    const dayIndex = i; // Đánh dấu chỉ số ngày trong tuần
                    chartValues[statusData.status][dayIndex] = statusData.count;
                }
            });
        }
    }

    // Cấu hình và vẽ biểu đồ
    const ctx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ctx, {
        type: 'line', // Hoặc 'bar' nếu bạn muốn dùng biểu đồ cột
        data: {
            labels: chartLabels,
            datasets: [{
                    label: 'Chờ xác nhận',
                    data: chartValues['1'],
                    borderColor: 'rgb(255, 99, 132)',
                    fill: false
                },
                {
                    label: 'Đã giao',
                    data: chartValues['5'],
                    borderColor: 'rgb(54, 162, 235)',
                    fill: false
                },
                {
                    label: 'Đã hủy',
                    data: chartValues['huy_don_hang'],
                    borderColor: 'rgb(75, 192, 192)',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Ngày'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Số lượng'
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }
            }
        }
    });
}