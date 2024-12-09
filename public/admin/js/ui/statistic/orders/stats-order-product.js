const ctx = document.getElementById("orderProductChart").getContext("2d");

// Gọi API để lấy dữ liệu
fetch("/api/monthly-order-product-stats")
  .then((response) => response.json())
  .then((data) => {
    // Chuẩn bị dữ liệu cho biểu đồ
    const months = Array.from({ length: 12 }, (_, i) => i + 1); // Tháng 1 đến 12
    const orders = months.map((month) => data[month]?.orders || 0); // Tổng đơn hàng
    const products = months.map((month) => data[month]?.products || 0); // Tổng sản phẩm

    // Tạo gradient cho số lượng đơn hàng (màu xanh dương đậm nhạt)
    const gradientOrders = ctx.createLinearGradient(0, 0, 0, ctx.canvas.height);
    gradientOrders.addColorStop(0, "rgba(33, 150, 243, 0.7)"); // Màu xanh dương đậm ở trên
    gradientOrders.addColorStop(1, "rgba(33, 150, 243, 0.3)"); // Màu xanh dương nhạt ở dưới

    // Tạo gradient cho số lượng sản phẩm bán ra (màu xanh dương nhạt hơn một chút)
    const gradientProducts = ctx.createLinearGradient(0, 0, 0, ctx.canvas.height);
    gradientProducts.addColorStop(0, "rgba(63, 81, 181, 0.7)"); // Màu xanh dương đậm (tím) ở trên
    gradientProducts.addColorStop(1, "rgba(63, 81, 181, 0.3)"); // Màu xanh dương nhạt (tím) ở dưới

    // Vẽ biểu đồ
    new Chart(ctx, {
      type: "line",
      data: {
        labels: months,
        datasets: [
          {
            label: "Số lượng đơn hàng",
            data: orders,
            borderColor: "#2196F3", // Màu đường viền
            backgroundColor: gradientOrders, // Áp dụng gradient
            tension: 0.4,
            fill: true,
          },
          {
            label: "Số lượng sản phẩm bán ra",
            data: products,
            borderColor: "#3F51B5", // Màu đường viền
            backgroundColor: gradientProducts, // Áp dụng gradient
            tension: 0.4,
            fill: true,
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
              text: "Số lượng",
            },
            beginAtZero: true,
          },
        },
        plugins: {
          legend: {
            position: "top",
          },
        },
      },
    });
  })
  .catch((error) => console.error("Error fetching data:", error));
