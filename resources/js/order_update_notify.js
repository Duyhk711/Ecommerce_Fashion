import './bootstrap';

const userId = "{{ auth()->id() }}";

window.Echo.private(`user.${userId}`)
    .listen('OrderStatusUpdatedEventNotify', (event) => {
        console.log(event);

        // Cập nhật số lượng thông báo
        const notificationCountElement = document.querySelector('.notification-count');
        if (notificationCountElement) {
            let currentCount = parseInt(notificationCountElement.textContent) || 0;
            notificationCountElement.textContent = currentCount + 1;
        }

        // Thêm thông báo vào danh sách
        const notificationList = document.getElementById('notification-list');
        if (notificationList) {
            const newNotification = `
                <li class="unread px-2 mb-2">
                    <strong style="font-family: 'Quicksand', sans-serif">${event.notification.title}</strong><br>
                    <a href="${event.notification.link}">
                        ${event.notification.message}
                    </a>
                </li>`;
            notificationList.insertAdjacentHTML('afterbegin', newNotification);
        }

        // Hiển thị thông báo dạng toastr
        toastr.success(event.notification.message, 'Thành công', {
            positionClass: 'toast-top-right',
            timeOut: 3000,
        });
    });
