// Khi người dùng chọn một khoảng thời gian
document.getElementById('filterSelect').addEventListener('change', function () {
    const filter = this.value;
    fetchOrderStatistics(filter); // Gọi hàm để lấy dữ liệu thống kê
});

// Hàm lấy thống kê từ API
function fetchOrderStatistics(filter) {
    // Gửi yêu cầu fetch đến API
    fetch(`/api/order-statistics?filter=${filter}`)
        .then(response => response.json()) // Chuyển dữ liệu trả về thành JSON
        .then(data => {
            console.log(data); // Ghi log dữ liệu nhận được

            // Kiểm tra và cập nhật tổng đơn hàng nếu phần tử tồn tại
            const totalOrdersElement = document.querySelector('.counter-value[data-target="0"]');
            if (totalOrdersElement) {
                // Kiểm tra nếu data.total_orders hợp lệ
                if (data.total_orders !== undefined) {
                    totalOrdersElement.innerText = data.total_orders;
                } else {
                    totalOrdersElement.innerText = '0'; // Nếu không có dữ liệu, hiển thị 0
                }
            }

            // Kiểm tra và cập nhật tổng doanh thu nếu phần tử tồn tại
            const totalRevenueElement = document.querySelector('.counter-value[data-target="1"]');
            if (totalRevenueElement) {
                // Kiểm tra nếu data.total_revenue hợp lệ
                if (data.total_revenue !== undefined) {
                    totalRevenueElement.innerText = data.total_revenue.toFixed(2); // Làm tròn tới 2 chữ số thập phân
                } else {
                    totalRevenueElement.innerText = '0.00'; // Nếu không có dữ liệu, hiển thị 0
                }
            }
        })
        .catch(error => {
            console.error('Có lỗi xảy ra khi lấy dữ liệu:', error); // Ghi log lỗi nếu có
        });
}

// Gọi API khi tải trang lần đầu tiên (mặc định là tất cả thời gian)
fetchOrderStatistics('all_time');


// bieu do tron
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("orderStatusPieChart").getContext("2d");
  
    fetch("/api/orders/status-distribution")
      .then((response) => response.json())
      .then((data) => {
        const labels = data.map((item) => item.status);
        const values = data.map((item) => item.count);
        const percentages = data.map((item) => `${item.percentage}%`);
  
        // Gán màu sắc theo trạng thái
        const backgroundColors = labels.map((status) => {
          switch (status) {
            case "huy_don_hang":
              return "#F7464A"; // Đỏ đậm
            case "Chờ xác nhận":
              return "#FFCE56"; // Vàng
            case "Chờ vận chuyển":
              return "#36A2EB"; // Xanh dương nhạt
            case "Đã vận chuyển":
              return "#1E5D8C"; // Xanh dương đậm hơn
            case "Hoàn thành":
              return "#4BC0C0"; // Xanh lá
            default:
              return "#FF6384"; // Màu mặc định nếu không tìm thấy trạng thái
          }
        });
  
        new Chart(ctx, {
          type: "doughnut",
          data: {
            labels: labels,
            datasets: [
              {
                data: values,
                backgroundColor: backgroundColors, // Gán màu sắc đã thay đổi
                hoverOffset: 4,
              },
            ],
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                position: "top",
              },
              tooltip: {
                callbacks: {
                  label: function (tooltipItem) {
                    return `${tooltipItem.label}: ${
                      values[tooltipItem.dataIndex]
                    } (${percentages[tooltipItem.dataIndex]})`;
                  },
                },
              },
            },
          },
        });
      })
      .catch((error) => console.error("Error fetching data:", error));
  });

