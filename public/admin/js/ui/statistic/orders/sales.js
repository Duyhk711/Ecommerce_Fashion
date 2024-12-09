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
            // console.log(data); // Ghi log dữ liệu nhận được

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
                    totalRevenueElement.innerText = data.total_revenue.toLocaleString('vi-VN'); // Format giá Việt Nam
                } else {
                    totalRevenueElement.innerText = '0'; // Nếu không có dữ liệu, hiển thị 0
                }
                
            }
        })
        .catch(error => {
            console.error('Có lỗi xảy ra khi lấy dữ liệu:', error); // Ghi log lỗi nếu có
        });
}

// Gọi API khi tải trang lần đầu tiên (mặc định là tất cả thời gian)
fetchOrderStatistics('all_time');


document.addEventListener("DOMContentLoaded", function() {
  fetch('/api/statistics/products')
      .then(response => response.json())
      .then(data => {
          // Hiển thị tổng sản phẩm
          document.querySelector('.total-products').textContent = data.total_products;

          // Hiển thị sản phẩm đã bán
          document.querySelector('.sold-products').textContent = data.sold_products;
      })
      .catch(error => console.error('Lỗi:', error));
});

