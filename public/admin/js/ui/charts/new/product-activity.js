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
// Số lượng sản phẩm mỗi trang
const PRODUCTS_PER_PAGE = 10;
let currentPage = 1; // Trang hiện tại
let totalPages = 1; // Tổng số trang

// Hàm đổ dữ liệu sản phẩm vào bảng
function loadProductTable(products) {
  const tableBody = document.querySelector("#product-table tbody");
  tableBody.innerHTML = ""; // Xóa dữ liệu cũ

  // Tính toán số trang
  totalPages = Math.ceil(products.length / PRODUCTS_PER_PAGE);

  // Lấy danh sách sản phẩm trên trang hiện tại
  const startIndex = (currentPage - 1) * PRODUCTS_PER_PAGE;
  const endIndex = startIndex + PRODUCTS_PER_PAGE;
  const currentProducts = products.slice(startIndex, endIndex);

  // Đổ dữ liệu vào bảng
  currentProducts.forEach((product, index) => {
    const row = document.createElement("tr");
    row.innerHTML = `
            <td>${startIndex + index + 1}</td>
            <td>${product.product_sku}</td>
            <td>${product.product_name}</td>
            <td>${product.sold_quantity}</td>
            <td>${parseFloat(product.revenue).toLocaleString()} ₫</td>
        `;
    tableBody.appendChild(row);
  });

  // Cập nhật nút phân trang
  loadPaginationControls(products);
}

// Hàm tạo nút phân trang
function loadPaginationControls(products) {
    const paginationContainer = document.getElementById('pagination');
    paginationContainer.innerHTML = ''; // Xóa các nút cũ

    // Tạo nút "Trang trước"
    const prevButton = document.createElement('button');
    prevButton.textContent = '←'; // Ký tự mũi tên trái
    prevButton.disabled = currentPage === 1; // Vô hiệu hóa nếu là trang đầu tiên
    prevButton.className = 'pagination-btn'; // Thêm class cho CSS
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            loadProductTable(products);
        }
    });
    paginationContainer.appendChild(prevButton);

    // Tạo nút cho từng trang
    for (let i = 1; i <= totalPages; i++) {
        const pageButton = document.createElement('button');
        pageButton.textContent = i;
        pageButton.className = i === currentPage ? 'pagination-btn active' : 'pagination-btn';
        pageButton.addEventListener('click', () => {
            currentPage = i;
            loadProductTable(products);
        });
        paginationContainer.appendChild(pageButton);
    }

    // Tạo nút "Trang sau"
    const nextButton = document.createElement('button');
    nextButton.textContent = '→'; // Ký tự mũi tên phải
    nextButton.disabled = currentPage === totalPages; // Vô hiệu hóa nếu là trang cuối
    nextButton.className = 'pagination-btn'; // Thêm class cho CSS
    nextButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            loadProductTable(products);
        }
    });
    paginationContainer.appendChild(nextButton);
}



function loadCategoryChart(categories) {
  const ctx = document.getElementById("category-chart").getContext("2d");

  if (window.categoryChart) {
    window.categoryChart.destroy();
  }

  window.categoryChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: categories.map((category) => category.category_name),
      datasets: [
        {
          label: "Doanh thu",
          data: categories.map((category) => category.category_revenue),
          backgroundColor: "rgba(9, 86, 218, 0.71)",
          borderColor: "rgb(9, 63, 213)",
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
      responsive: true,
    },
  });
}

window.onload = function () {
  fetchProductActivity("this_week");
};

document.getElementById("period").addEventListener("change", function (e) {
  fetchProductActivity(e.target.value);
});
document.getElementById("period").addEventListener("change", function (e) {
  currentPage = 1; // Reset về trang đầu tiên
  fetchProductActivity(e.target.value);
});
