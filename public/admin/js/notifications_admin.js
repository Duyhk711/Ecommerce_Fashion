async function loadAdminNotifications() {
  try {
      const response = await fetch('/notifications/admin');
      const notifications = await response.json();
      renderNotifications(notifications);
  } catch (error) {
      console.error('Error fetching admin notifications:', error);
  }
}

function renderNotifications(notifications) {
  const notificationList = document.getElementById('notificationList');
  notificationList.innerHTML = ''; // Xóa nội dung cũ

  if (notifications.length === 0) {
      notificationList.innerHTML = '<li>Hiện tại bạn không có thông báo nào.</li>';
  } else {
      notifications.forEach(notification => {
          const listItem = `
              <li class="${notification.read_at ? 'read' : 'unread'} px-2 mb-2">
                  <strong>${notification.data.title}</strong><br>
                  <a href="${notification.data.link}">
                      ${notification.data.message}
                  </a>
              </li>`;
          notificationList.insertAdjacentHTML('beforeend', listItem);
      });
  }
}

export default loadAdminNotifications;
