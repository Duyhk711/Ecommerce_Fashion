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

document.addEventListener("DOMContentLoaded", function () {
  fetch("/api/orders") // Thay đổi đường dẫn nếu cần
    .then((response) => response.json())
    .then((data) => {
      // console.log("Data received:", data); // Log dữ liệu nhận được từ API

      const orders = data.data; // Giả sử bạn nhận được dữ liệu trong "data"
      // console.log("Orders:", orders); // Log danh sách đơn hàng

      const tableBody = document.getElementById("orders-tbody");
      tableBody.innerHTML = ""; // Clear any existing rows

      orders.forEach((order) => {
        // Log từng đơn hàng
        // console.log("Processing order:", order);

        const products = order.items
          .map((item) => item.product_name)
          .join(", ");

        // Tạo một dòng mới cho bảng
        const row = document.createElement("tr");
        row.innerHTML = `
                    <td style="font-size: 13px;"><a href="/admin/orders/${
                      order.id
                    }" class="fw-medium link-primary">#${order.sku}</a></td>
                    <td>${order.customer_name}</td>
                    <td>
                          <div class="" style="font-size: 14px;">${products}</div>
                        <div class="text-muted" style="font-size: 13px;">Sl: <span>${
                          order.items.length > 0 ? order.items[0].quantity : 0
                        }</span>
                        </div>
                    </td>
                    <td><span class="">${Intl.NumberFormat("vi-VN", {
                      style: "currency",
                      currency: "VND",
                    }).format(order.total_price * 1000)}</span></td>
                    <td>
                        <span class="badge ${getBadgeClass(order.status)}">
                            ${getStatusText(order.status)}
                        </span>
                    </td>
                `;
        tableBody.appendChild(row);
      });
    })
    .catch((error) => {
      console.error("Error fetching orders:", error);
    });
});

// Hàm lấy class badge theo trạng thái
function getBadgeClass(status) {
  switch (status) {
    case "1":
      return "bg-warning-subtle text-warning"; 
    case "2":
      return "bg-info-subtle text-info"; 
    case "3":
      return "bg-primary-subtle text-primary"; 
    case "4":
      return "bg-success-subtle text-success"; 
    case "huy_don_hang":
      return "bg-danger-subtle text-danger"; 
    default:
      return "bg-secondary-subtle text-secondary"; 
  }
}

// Hàm lấy trạng thái hiển thị
function getStatusText(status) {
  switch (status) {
    case "1":
      return "Chờ xác nhận";
    case "2":
      return "Chờ vận chuyển";
    case "3":
      return "Đã vận chuyển";
    case "4":
      return "Hoàn thành";
    case "huy_don_hang":
      return "Đã hủy";
    default:
      return "Không xác định";
  }
}