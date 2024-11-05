// resources/js/app.js

import './bootstrap';

    window.Echo.channel('orders')
    .listen('OrderUpdated', (event) => {
        console.log(event);
        // Lấy tất cả các đơn hàng từ DOM
        const orders = document.querySelectorAll('tr[data-order-id]');

        // Tìm kiếm phần tử <span> với ID tương ứng
        const orderStatusElement = document.getElementById(`orderStatus-${event.order.id}`);

        if (orderStatusElement) {
            window.Pusher.logToConsole = true;
            // Cập nhật trạng thái
            const currentStatus = event.order.status;

            // Cập nhật nội dung và class của span
            orderStatusElement.innerHTML = `
                ${event.order.statusMapping[currentStatus] ?? currentStatus}
            `;
            orderStatusElement.className = `badge rounded-pill ${event.order.badgeColor[currentStatus]}`;
        }
    });
