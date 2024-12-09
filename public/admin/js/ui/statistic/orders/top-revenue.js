document.addEventListener("DOMContentLoaded", function () {
    const tbody = document.querySelector("tbody");
    const filterSelect = document.getElementById("filterSelect");

    // Hàm fetch danh sách top đơn hàng
    const fetchTopOrders = (filter = "all_time") => {
        fetch(`/api/orders/top?filter=${filter}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                tbody.innerHTML = ""; // Xóa nội dung cũ

                if (data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="4" class="text-center">Không có dữ liệu</td></tr>`;
                } else {
                    data.forEach((order) => {
                        const orderUrl = orderShowUrl.replace(":id", order.id);
                        const row = `
                            <tr>
                                <td><a href="${orderUrl}" class="fw-medium link-primary">#${order.sku}</a></td>
                                <td>${order.customer_name}</td>
                                <td>${order.total_price.toLocaleString('vi-VN')}₫</td>
                                <td>${new Date(order.created_at).toLocaleDateString('vi-VN')}</td>
                            </tr>`;
                        tbody.innerHTML += row;
                    });
                }
            })
            .catch((error) => {
                console.error("Fetch error:", error);
                alert("Đã xảy ra lỗi khi tải dữ liệu.");
            });
    };

    // Gọi API để load danh sách đơn hàng ban đầu
    fetchTopOrders();

    // Lắng nghe sự kiện thay đổi filter
    filterSelect.addEventListener("change", (e) => {
        const selectedFilter = e.target.value;
        fetchTopOrders(selectedFilter);
    });
});
