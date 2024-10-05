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
