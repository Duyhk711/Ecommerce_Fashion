import './bootstrap';

console.log('Initializing Echo...');
Pusher.logToConsole = true;
try {
window.Echo.channel('create_order')
    .listen('NewOrderNotifyAdmin', (event) => {
        window.Pusher.logToConsole = true;

        console.log(event);
        console.log(event.created_at);
        console.log(12345);
        console.log('Listening to channel create_order');



        // Cập nhật số lượng thông báo
        const notificationCountElement = document.querySelector('.notification-count');
        if (notificationCountElement) {
            let currentCount = parseInt(notificationCountElement.textContent) || 0;
            notificationCountElement.textContent = currentCount + 1;
        }

        // Thêm thông báo mới vào danh sách
        const notificationList = document.querySelector('.nav-items');
        if (notificationList) {
            const newNotification = `
                <li class="unread" data-id="${event.notification.id}">
                    <a class="d-flex text-dark py-2 mark-as-read" href="${event.notification.link}" data-url="/notifications/mark-as-read/${event.notification.id}">
                        <div class="flex-shrink-0 mx-3 mt-2">
                            <i class="far fa-fw fa-file-alt me-1"></i>
                        </div>
                        <div class="flex-grow-1 fs-sm pe-2">
                            <div class="fw-semibold" style="max-width: 200px; word-wrap: break-word; white-space: pre-wrap; display: block;">${event.notification.message}</div>
                            <div class="text-muted">${getVietnamTime()}</div>
                        </div>
                    </a>
                </li>`;
            // Thêm thông báo mới vào đầu danh sách
            notificationList.insertAdjacentHTML('afterbegin', newNotification);
        }

        // Hiển thị thông báo dạng toastr
        toastr.success(event.notification.message, 'Thông báo mới', {
            positionClass: 'toast-top-right',
            timeOut: 3000,
        });
    });
    } catch (error) {
        console.error('Error in Echo listener:', error);
    }

/**
 * Hàm để xác định icon dựa theo loại thông báo
 * @param {string} type
 * @returns {string}
 */
function getNotificationIcon(type) {
    switch (type) {
        case 'App\\Notifications\\CreateNewVoucherAdmin':
            return '<i class="fa fa-fw fa-plus-circle text-primary"></i>';
        case 'App\\Notifications\\NewOrderNotifyAdmin':
            return '<i class="far fa-fw fa-file-alt me-1"></i>';
        case 'App\\Notifications\\NewUser':
            return '<i class="fa fa-fw fa-user-plus text-info"></i>';
        case 'App\\Notifications\\CreateProduct':
            return '<i class="fa fa-fw fa-plus-circle text-primary"></i>';
        default:
            return '<i class="fa fa-info-circle"></i>';
    }
}

/**
 * Hàm để định dạng ngày/thời gian
 * @param {string} dateString
 * @returns {string}
 */
function getVietnamTime() {
    const now = new Date();

    // Cộng thêm 7 giờ cho múi giờ Việt Nam (UTC+7)
    const vietnamTime = new Date(now.getTime() + (7 * 60 * 60 * 1000));

    const options = {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };

    return vietnamTime.toLocaleString('vi-VN', options);
}