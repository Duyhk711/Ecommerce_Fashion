// Lấy canvas cho biểu đồ Doughnut
const doughnutChartCtx = document
  .getElementById("categoryRevenueChart")
  .getContext("2d");

// Lấy dữ liệu từ API (Dữ liệu JSON)
fetch("/api/category-revenue")
  .then((response) => response.json())
  .then((data) => {
    // Chuyển đổi dữ liệu thành định dạng cần thiết cho biểu đồ
    const labels = Object.keys(data); // Tên các danh mục
    const values = Object.values(data); // Doanh thu tương ứng từng danh mục

    // Tạo mảng màu sắc động, mỗi phần tử có màu khác nhau
    const colors = labels.map(
      (_, index) => `hsl(${(index * 360) / labels.length}, 70%, 60%)`
    );
    const hoverColors = labels.map(
      (_, index) => `hsl(${(index * 360) / labels.length}, 80%, 70%)`
    );

    // Dữ liệu biểu đồ
    const revenueData = {
      labels: labels, // Tên danh mục
      datasets: [
        {
          data: values, // Doanh thu của từng danh mục
          backgroundColor: colors, // Màu sắc động
          hoverBackgroundColor: hoverColors, // Màu khi hover
          borderWidth: 1,
        },
      ],
    };

    // Cấu hình cho biểu đồ
    const doughnutChartOptions = {
      responsive: true,
      plugins: {
        legend: {
          position: "top", // Hiển thị chú thích phía trên
        },
        tooltip: {
          callbacks: {
            label: function (context) {
              const label = context.label || "";
              const value = context.raw || 0;
              const total = context.dataset.data.reduce((a, b) => a + b, 0); // Tổng doanh thu
              const percentage = ((value / total) * 100).toFixed(2); // Tính phần trăm
              return `${label}: ${value.toLocaleString()} ₫ (${percentage}%)`;
            },
          },
        },
      },
    };

    // Khởi tạo biểu đồ Doughnut
    new Chart(doughnutChartCtx, {
      type: "doughnut", // Loại biểu đồ
      data: revenueData, // Dữ liệu
      options: doughnutChartOptions, // Cấu hình
    });
  })
  .catch((error) => console.error("Error:", error));

//   table

fetch("/api/category-details")
  .then((response) => {
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.json();
  })
  .then((data) => {
    const tableBody = document.querySelector("#categoryDetailsTable tbody");
    tableBody.innerHTML = ""; // Xóa dữ liệu cũ nếu có

    // Duyệt qua từng danh mục và thêm vào bảng
    data.forEach((item, index) => {
      const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.name}</td>
                        <td>${item.quantity_sold}</td>
                        <td>${item.revenue.toLocaleString()}₫</td>
                    </tr>
                `;
      tableBody.innerHTML += row;
    });
  })
  .catch((error) => console.error("Lỗi khi lấy dữ liệu từ API:", error));
