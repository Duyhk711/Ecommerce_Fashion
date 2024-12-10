// Lấy canvas của biểu đồ
const ctx = document.getElementById("paymentMethodChart").getContext("2d");

// Lấy dữ liệu từ API
fetch("/api/revenue-by-payment-method")
  .then((response) => response.json())
  .then((data) => {
    // Tạo bảng tra cứu tên phương thức thanh toán
    const paymentMethodNames = {
      "COD": "Thanh toán khi nhận hàng",  // Thay đổi tên COD
      "THANH_TOAN_ONLINE": "Thanh toán trực tuyến"  // Thay đổi tên THANH_TOAN_ONLINE
    };

    // Chuyển dữ liệu thành định dạng cần thiết cho biểu đồ
    const labels = Object.keys(data).map(method => paymentMethodNames[method] || method); // Đổi tên các phương thức thanh toán
    const revenues = Object.values(data); // Doanh thu

    // Khởi tạo biểu đồ
    new Chart(ctx, {
      type: "pie", // Loại biểu đồ tròn
      data: {
        labels: labels, // Sử dụng các nhãn mới đã được đổi tên
        datasets: [
          {
            data: revenues,
            backgroundColor: [
              "#FF5733", // Màu cho COD
              "#33C1FF"  // Màu cho THANH_TOAN_ONLINE
            ],
            hoverBackgroundColor: [
              "#FF7847",
              "#55D4FF"
            ],
            borderWidth: 1,
          },
        ],
      },
      options: {
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
                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                const percentage = ((value / total) * 100).toFixed(2); // Tính phần trăm
                return `${label}: ${value.toLocaleString()} ₫ (${percentage}%)`;
              },
            },
          },
        },
      },
    });
  })
  .catch((error) => console.error("Error fetching revenue data:", error));


//   line chart
const ctxLine = document.getElementById("monthlyRevenueChart").getContext("2d");

// Lấy dữ liệu từ API
fetch("/api/monthly-revenue-by-payment-method")
  .then((response) => response.json())
  .then((data) => {
    // Kiểm tra dữ liệu trả về
    console.log("Dữ liệu từ API:", data);

    // Dữ liệu tháng (từ 1 đến 12)
    const months = Array.from({ length: 12 }, (v, k) => k + 1);

    // Lấy doanh thu từ các phương thức thanh toán
    const onlineRevenue = data.THANH_TOAN_ONLINE; // Sử dụng đúng tên thuộc tính từ API
    const codRevenue = data.COD; // Sử dụng đúng tên thuộc tính từ API

    // Kiểm tra doanh thu đã được lấy đúng chưa
    // console.log("Doanh thu Online:", onlineRevenue);
    // console.log("Doanh thu COD:", codRevenue);

    // Khởi tạo biểu đồ Line
    new Chart(ctxLine, {
      type: "line", // Loại biểu đồ là line
      data: {
        labels: months, // Các tháng trong năm (1 đến 12)
        datasets: [
          {
            label: "Thanh toán online",
            data: onlineRevenue,
            borderColor: "#33C1FF", // Màu đường biểu đồ online
            backgroundColor: "rgba(51, 193, 255, 0.2)",
            fill: true,
            tension: 0.4,
          },
          {
            label: "Tiền mặt",
            data: codRevenue,
            borderColor: "#FF5733", // Màu đường biểu đồ COD
            backgroundColor: "rgba(255, 87, 51, 0.2)",
            fill: true,
            tension: 0.4,
          },
        ],
      },
      options: {
        responsive: true,
        scales: {
          x: {
            title: {
              display: true,
              text: "Tháng",
            },
          },
          y: {
            title: {
              display: true,
              text: "Doanh thu (₫)",
            },
            ticks: {
              beginAtZero: true,
            },
          },
        },
        plugins: {
          legend: {
            position: "top",
          },
          tooltip: {
            callbacks: {
              label: function (context) {
                const label = context.dataset.label || "";
                const value = context.raw || 0;
                return `${label}: ${value.toLocaleString()} ₫`;
              },
            },
          },
        },
      },
    });
  })
  .catch((error) =>
    console.error("Error fetching monthly revenue data:", error)
  );
