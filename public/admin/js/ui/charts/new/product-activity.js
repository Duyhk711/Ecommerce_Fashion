// Hàm lấy dữ liệu từ API và cập nhật bảng & biểu đồ
async function fetchProductActivity(period) {
    try {
        // Gửi yêu cầu lấy dữ liệu theo tham số period
        const response = await fetch(`/api/product-activity?period=${period}`);
        const data = await response.json();

        // Đổ dữ liệu vào bảng sản phẩm
        loadProductTable(data.products);
        // Vẽ biểu đồ doanh thu theo nhóm sản phẩm
        loadCategoryChart(data.categories);
    } catch (error) {
        console.error("Lỗi khi tải dữ liệu:", error);
    }
}

// Hàm đổ dữ liệu sản phẩm vào bảng
function loadProductTable(products) {
    const tableBody = document.querySelector('#product-table tbody');
    tableBody.innerHTML = ''; // Xóa dữ liệu cũ

    products.forEach((product, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
        <td>${index + 1}</td>
        <td>${product.product_sku}</td>
        <td>${product.product_name} </td>
        <td>${product.sold_quantity}</td>
        <td>${parseFloat(product.revenue).toLocaleString()} ₫</td>
    `;
        tableBody.appendChild(row);
    });
}


function loadCategoryChart(categories) {
    const ctx = document.getElementById('category-chart').getContext('2d');

    if (window.categoryChart) {
        window.categoryChart.destroy();
    }

    window.categoryChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: categories.map(category => category.category_name),
            datasets: [{
                label: 'Doanh thu',
                data: categories.map(category => category.category_revenue),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true
        }
    });
}

window.onload = function() {
    fetchProductActivity('this_week');
};

document.getElementById('period').addEventListener('change', function(e) {
    fetchProductActivity(e.target.value);
});