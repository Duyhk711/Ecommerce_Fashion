// resources/js/app.js

import './bootstrap';

// Lắng nghe sự kiện 'MessageSent' trên channel 'chat'
window.Echo.channel('chat')
    .listen('MessageSent', (event) => {
        console.log(event);
        // Cập nhật giao diện với tin nhắn mới
        const message = event.message;
        // Thêm mã để cập nhật giao diện, ví dụ:
        document.getElementById('chat-box').innerHTML += `
            <div>
                <strong>${message.user_id}:</strong> ${message.message}
            </div>
        `;
    });


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
