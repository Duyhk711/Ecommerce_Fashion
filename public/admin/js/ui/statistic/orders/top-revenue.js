document.addEventListener("DOMContentLoaded", function () {
    const tbody = document.querySelector("tbody");

    // Hàm fetch danh sách top đơn hàng
    const fetchTopOrders = () => {
        fetch('/api/orders/top')
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                tbody.innerHTML = ""; // Xóa nội dung cũ

                data.forEach((order) => {
                    const row = `
                        <tr>
                            <td><a href="#" class="fw-medium link-primary">#${order.sku}</a></td>
                            <td>${order.customer_name}</td>
                            <td>${order.total_price.toLocaleString('vi-VN')} VND</td>
                            <td>${new Date(order.created_at).toLocaleDateString('vi-VN')}</td>
                        </tr>`;
                    tbody.innerHTML += row;
                });
            })
            .catch((error) => {
                console.error("Fetch error:", error);
                alert("Đã xảy ra lỗi khi tải dữ liệu.");
            });
    };

    // Gọi API để load danh sách đơn hàng
    fetchTopOrders();
});