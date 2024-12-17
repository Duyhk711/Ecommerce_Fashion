async function loadClientNotifications() {
  try {
      const response = await fetch('/notifications/client');
      const notifications = await response.json();
      renderNotifications(notifications);
  } catch (error) {
      console.error('Error fetching client notifications:', error);
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
              <li class="${notification.read_at ? 'read' : 'unread'} px-2 mb-2" data-id="${notification.id}">
                  <strong style="font-family: 'Quicksand', sans-serif">${notification.data.title}</strong><br>
                  <a href="${notification.data.link}" class="mark-as-read" data-url="${notification.data.markAsReadUrl}">
                      ${notification.data.message}
                  </a>
              </li>`;
          notificationList.insertAdjacentHTML('beforeend', listItem);

          // Add event listener to mark as read when clicking on the link
          const markAsReadLink = notificationList.querySelector(`[data-id="${notification.id}"] .mark-as-read`);
          if (markAsReadLink) {
              markAsReadLink.addEventListener('click', async (event) => {
                  event.preventDefault();
                  await markAsRead(notification.id); // Call the function to mark the notification as read
              });
          }
      });
  }
}

// Mark the notification as read by calling the API
async function markAsRead(notificationId) {
  try {
      const response = await fetch(`/notifications/markAsRead/${notificationId}`, {
          method: 'PATCH',
          headers: {
              'Content-Type': 'application/json',
          },
      });

      if (response.ok) {
          // Update the UI to reflect the read status
          const notificationItem = document.querySelector(`[data-id="${notificationId}"]`);
          if (notificationItem) {
              notificationItem.classList.remove('unread');
              notificationItem.classList.add('read');
          }
      } else {
          console.error('Failed to mark notification as read');
      }
  } catch (error) {
      console.error('Error marking notification as read:', error);
  }
}

export default loadClientNotifications;
