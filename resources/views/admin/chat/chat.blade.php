@extends('layouts.backend')

@section('content')
<style>
    .row {
        margin-left: 20px;
        margin-right: 20px;
        max-height: calc(100vh - 200px);
    }
    .chat-list {
        max-height: calc(100vh - 70px - 68px - 80px);
        overflow-y: auto;
    }

    .chat-item {
        display: flex;
        align-items: center;
        padding: 10px;
        cursor: pointer;
    }

    .chat-item:hover {
        background-color: #f5f5f5;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .chat-window {
    max-height: calc(100vh - 290px); /* Chiều cao tối đa cho khung chat */
    min-height: calc(100vh - 290px); /* Chiều cao tối thiểu để khung luôn cố định */
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    background: #F4F6F9;
}
.welcome-message {
    height: calc(100vh - 180px); /* Chiều cao tương tự khung chat */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 20px;
    background-color: #f8f9fa;
}

.chat-message-container {
    flex-grow: 1; /* Cho phép khung tin nhắn co dãn theo nội dung */
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #ffffff;
    margin-bottom: 10px;
}


    .chat-message {
        display: flex;
        align-items: center;
        margin: 10px 0;
    }

    .chat-message.sender {
        justify-content: flex-end;
    }

    .chat-message.receiver {
        justify-content: flex-start;
    }

    .chat-message .message-content {
        background-color: #F4F6F9;
        padding: 10px;
        border-radius: 5px;
        margin: 0 10px;
        max-width: 70%;

    }

    .chat-message.sender .message-content {
        background-color: #007BFF;
        color: #fff;
        align-self: flex-end;
    }

    .chat-message.receiver .message-content {
        background-color: #E9ECEF;
        color: #333333;
        align-self: flex-start;
    }

    .chat-message .timestamp {
        font-size: 0.8em;
        color: #ffffff;
    }
    .chat-message .timestamp {
    font-size: 0.7em;
}

.chat-message.sender .timestamp {
    color: #ffffff; /* Màu cho người gửi */
}

.chat-message.receiver .timestamp {
    color: #999999; /* Màu cho người nhận */
}

    .list-group-item.active {
        z-index: 2;
        color: #fff;
        background-color: #4B49AC;
        border-color: #4B49AC;
    }

    .unread-count {
        background-color: #ff0000;
        color: #fff;
        border-radius: 50%;
        min-width: 24px;
        min-height: 24px;
        padding: 3px;
        margin-left: 10px;
        font-size: 0.8em;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }
    .profile_info {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }
    .chat-list::-webkit-scrollbar {
        width: 10px;
    }

    .chat-list::-webkit-scrollbar-thumb {
        background-color: #7c848d;
        border-radius: 10px;
    }
    .chat-list::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .chat-window::-webkit-scrollbar {
        width: 10px;
    }

    .chat-window::-webkit-scrollbar-thumb {
        background-color: #7c848d;
        border-radius: 10px;
    }

    .chat-window::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .chat-message .message-content p {
    line-height: 2; /* Điều chỉnh khoảng cách giãn dòng, giảm giá trị để thu nhỏ */
    margin: 0; /* Xóa khoảng cách thừa giữa các dòng */
}
.chat-message .message-content{
    margin-left: 20px;
    margin-right: 20px;
}
.card-header {
    background-color: #007BFF;
}
#sendMessageButton {
    background-color: #007BFF;
}
#sendMessageButton:hover {
    background-color: #b5d2e6;
}
</style>

<div class="row">
    <div class="col-md-12 mt-4 mb-4 grid-margin">
        <div class="row">

            <div class="col-md-4 col-lg-3">
                <div class="card shadow-sm">
                    <div class="card-header text-white">
                        <h4 class="mb-0">Chats</h4>
                    </div>
                    <div class="list-group chat-list" id="chatList">
                        <ul class="list-group list-group-flush">

                        </ul>

                    </div>
                </div>
            </div>


            <div class="col-md-8 col-lg-9">
                <div id="welcomeMessage" class="welcome-message">
                    <h5><img src="https://cdn-icons-png.flaticon.com/512/8744/8744028.png" width="80px" alt="" srcset=""> Trang hỗ trợ khách hàng trực tuyến cửa hàng Poly Fashion</h5>
                    {{-- <p>Khám phá những tiện ích hỗ trợ làm việc và trò chuyện cùng người thân, bạn bè được tối ưu hoá cho máy tính của bạn.</p> --}}
                </div>
                <div class="card shadow-sm" id="chatContainer" style="display: none;">
                    <div class="card-header text-white">
                        <h4 class="mb-0" id="chat_name">Nói chuyện với</h4>
                    </div>

                    <div class="card-body chat-window">
                        <div class="chat-message-container" id="chatMessageContainer">

                        </div>
                    </div>

                    <div class="card-footer">
                        <form id="messageForm" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" id="receiver_id">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nhập tin nhắn ở đây..." id="messageInput" name="message" required>
                                <button class="btn btn-primary" type="submit" id="sendMessageButton"><i class="bi bi-send"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@vite(['resources/js/chat.js'])
<script src="{{ asset('admin/js/lib/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        var userId = {{ Auth::id() }};

        var currentChatUserId = null;

        var channel = pusher.subscribe('chat.' + userId);
        loadUsers();
        channel.bind('user-message', function(data) {
    if (data && data.message) {
        let senderId = data.sender_id;
        let receiverId = data.receiver_id;
        let messageText = data.message;
        let senderName = data.user.name;
        let messageTime = new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        if (receiverId == userId && senderId == currentChatUserId) {
            let messageHtml = `
                <div class="chat-message receiver">
                    <div class="message-content">
                        <p> ${messageText}</p>
                        <div class="timestamp">${messageTime}</div>
                    </div>
                </div>`;

            $('#chatMessageContainer').append(messageHtml);

            $.ajax({
                url: '{{ route('admin.markMessagesAsRead') }}',
                method: 'POST',
                data: {
                    receiver_id: currentChatUserId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Tin nhắn đã được đánh dấu là đã đọc');
                },
                error: function(xhr) {
                    console.error('Lỗi khi đánh dấu tin nhắn là đã đọc:', xhr.responseText);
                }
            });

        } else if (receiverId == userId) {
            let $chatItem = $('.chat-item').filter(function() {
                return $(this).data('user-id') == senderId;
            });
            if ($chatItem.length > 0) {
                let $unreadCount = $chatItem.find('.unread-count');
                if ($unreadCount.length > 0) {
                    $unreadCount.text(parseInt($unreadCount.text()) + 1);
                } else {
                    $chatItem.append('<span class="unread-count">1</span>');
                }
            }
        }
        scrollToBottom();
        loadUsers();
    } else {
        console.error('Dữ liệu tin nhắn không hợp lệ.');
    }
});

        $(document).on('click', '.chat-item', function() {
            let profileName = $(this).find('.profile_name').text();
            let profileImage = $(this).find('img').attr('src');
            currentChatUserId = $(this).data('user-id');
            $('#receiver_id').val(currentChatUserId);
            $('#chat_name').html(`<img src="${profileImage}" class="avatar" alt="${profileName}" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;"> ${profileName}`);
            $('#welcomeMessage').hide();
            $('#chatContainer').show();
            $(this).find('.unread-count').remove();

            $.ajax({
                url: '{{ route('admin.markMessagesAsRead') }}',
                method: 'POST',
                data: {
                    receiver_id: currentChatUserId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Tin nhắn đã được đánh dấu là đã đọc');
                },
                error: function(xhr) {
                    console.error('Lỗi khi đánh dấu tin nhắn là đã đọc:', xhr.responseText);
                }
            });

            $.ajax({
                url: '{{ route('admin.fetchMessages') }}',
                method: 'GET',
                data: {
                    receiver_id: currentChatUserId
                },
                success: function(response) {
                    $('#chatMessageContainer').empty();

                    response.messages.forEach(function(message) {
                        let isSender = message.sender_id == userId;
                        let userName = isSender ? '{{ Auth::user()->name }}' : profileName;

                        let messageTime = new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                        let messageHtml = `
                            <div class="chat-message ${isSender ? 'sender' : 'receiver'}">
                                <div class="message-content">
                                    <p> ${message.message}</p>
                                    <div class="timestamp">${messageTime}</div>
                                </div>
                            </div>`;
                        $('#chatMessageContainer').append(messageHtml);
                    });
                    scrollToBottom();
                },
                error: function(xhr) {
                    console.error('Lỗi khi lấy tin nhắn:', xhr.responseText);
                }
            });
        });

        $('#messageForm').submit(function(e) {
            e.preventDefault();

            let message = $('#messageInput').val().trim();
            let receiverId = $('#receiver_id').val();

            if (message !== '' && receiverId) {
                $.ajax({
                    url: '{{ route('admin.sendMessage') }}',
                    method: 'POST',
                    data: {
                        message: message,
                        receiver_id: receiverId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        let messageHtml = `
                            <div class="chat-message sender">
                                <div class="message-content">
                                    <p> ${message}</p>
                                    <div class="timestamp">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</div>
                                </div>
                            </div>`;
                        $('#chatMessageContainer').append(messageHtml);
                        $('#messageInput').val('');
                        scrollToBottom();
                    },
                    error: function(xhr) {
                        console.error('Lỗi khi gửi tin nhắn:', xhr.responseText);
                    }
                });
            }
        });

        function scrollToBottom() {
        $('.card-body.chat-window').animate({ scrollTop: $('.card-body.chat-window')[0].scrollHeight }, 300);
    }
        function loadUsers() {
            $.ajax({
                url: '{{ route('admin.getSortedUsers') }}',
                method: 'GET',
                success: function(response) {
                    let chatList = $('#chatList ul');
                    chatList.empty();

                    response.users.forEach(function(user) {
                        let unreadCountHtml = user.unread_count > 0 ? `<span class="unread-count">${user.unread_count}</span>` : '';
                        let userHtml = `
                            <li class="list-group-item d-flex align-items-center chat-item" data-user-id="${user.id}">
                                <img src="${user.avatar_url}" class="profile_img rounded-circle" alt="Profile Picture" style="width: 40px; height: 40px;">
                                <div class="profile_info d-flex justify-content-between w-100">
                                    <span class="profile_name font-weight-bold">${user.name}</span>
                                    ${unreadCountHtml}
                                </div>
                            </li>`;
                        chatList.append(userHtml);
                    });
                },
                error: function(xhr) {
                    console.error('Lỗi khi tải danh sách user:', xhr.responseText);
                }
            });
        }
    });
</script>
{{-- <script src="{{ asset('admin/js/dashmix.app.min.js') }}"></script>  --}}
@endsection