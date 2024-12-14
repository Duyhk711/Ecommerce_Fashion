import './bootstrap';

window.Echo.channel('new_vouchers')
    .listen('CreateNewVoucherNotify', (event) => {
        console.log(event);
        console.log(1234);

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

            // Chèn thông báo mới sau `<li class="fixed-title">`
            const fixedTitle = notificationList.querySelector('.fixed-title');
            if (fixedTitle) {
                fixedTitle.insertAdjacentHTML('afterend', newNotification);
            } else {
                // Nếu không có mục cố định, thêm vào đầu danh sách
                notificationList.insertAdjacentHTML('afterbegin', newNotification);
            }
        }

        // Hiển thị thông báo dạng toastr
        toastr.success(event.notification.message, 'Thành công', {
            positionClass: 'toast-top-right',
            timeOut: 3000,
        });
    });
