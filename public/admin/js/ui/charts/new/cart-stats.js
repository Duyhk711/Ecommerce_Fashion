document.addEventListener("DOMContentLoaded", function() {
    // Gọi API để lấy dữ liệu thống kê giỏ hàng
    fetch('/api/cart/stats')
        .then(response => response.json())
        .then(data => {
            // Hiển thị số liệu giỏ hàng
            document.getElementById('new-carts').textContent = data.newCartsCount;
            // Thêm ký tự ₫ vào tổng giá trị giỏ hàng
            document.getElementById('total-cart-value').textContent = `${data.totalCartValue.toLocaleString()} ₫`;
        })
        .catch(error => console.error('Lỗi khi gọi API:', error));
});
