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
        max-height: calc(100vh - 290px);
        overflow-y: auto;
    }

    .chat-message-container {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #ffffff;
        margin-bottom: 10px;
        max-height: 100%;
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
        background-color: #f1f1f1;
        padding: 10px;
        border-radius: 5px;
        margin: 0 10px;
        max-width: 70%;
    }

    .chat-message.sender .message-content {
        background-color: #007bff;
        color: #fff;
        align-self: flex-end;
    }

    .chat-message.receiver .message-content {
        background-color: #f1f1f1;
        align-self: flex-start;
    }

    .chat-message .timestamp {
        font-size: 0.8em;
        color: #888;
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

</style>

<div class="row">
    <div class="col-md-12 mt-4 mb-4 grid-margin">
        <div class="row">
 
            <div class="col-md-4 col-lg-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Chats</h4>
                    </div>
                    <div class="list-group chat-list" id="chatList">
                        <ul class="list-group list-group-flush">
                            @foreach ($users as $user)
                                <li class="list-group-item d-flex align-items-center chat-item">
                                    <img src="{{ Storage::url($user->avatar) }}" class="profile_img rounded-circle" alt="Profile Picture" style="width: 40px; height: 40px;">
                                    <div class="profile_info d-flex justify-content-between w-100"> 
                                        <span class="profile_name font-weight-bold">{{ $user->name }}</span>
                                        @if ($user->unread_count > 0)
                                            <span class="unread-count">{{ $user->unread_count }}</span>
                                        @endif
                                        <span class="id" style="display: none;">{{ $user->id }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        
                    </div>
                </div>
            </div>

 
            <div class="col-md-8 col-lg-9">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
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
                                <button class="btn btn-primary" type="submit" id="sendMessageButton">Gửi</button>
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
@vite(['resources/js/app.js']) 
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
    var pusher = new Pusher('{{ $pusherKey }}', {
        cluster: '{{ $pusherCluster }}',
        encrypted: true
    });

    var userId = {{ Auth::id() }}; 
    var currentChatUserId = null; 

    var channel = pusher.subscribe('chat.' + userId); 

    channel.bind('user-message', function(data) {
        console.log('Tin nhắn đã nhận:', data);

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
                            <p><strong>${senderName}:</strong> ${messageText}</p>
                            <div class="timestamp">${messageTime}</div>
                        </div>
                    </div>`;

                $('#chatMessageContainer').append(messageHtml);

                scrollToBottom();
            } else if (receiverId == userId) {

                let $chatItem = $('.chat-item').filter(function() {
                    return $(this).find('.id').text() == senderId; 
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
        } else {
            console.error('Dữ liệu tin nhắn không hợp lệ.');
        }
    });

$('.chat-item').on('click', function() {
    let profileName = $(this).find('.profile_name').text();
    let profileImage = $(this).find('img').attr('src'); 
    currentChatUserId = $(this).find('.id').text(); 
    $('#receiver_id').val(currentChatUserId);

    $('#chat_name').html(`<img src="${profileImage}" class="avatar" alt="${profileName}" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;"> ${profileName}`);

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

    // Fetch messages
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
                            <p><strong>${userName}:</strong> ${message.message}</p>
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



    $('#messageForm').on('submit', function(e) {
        e.preventDefault(); 

        let message = $('#messageInput').val();

        if (currentChatUserId && message) {
            $.ajax({
                url: '{{ route('admin.sendMessage') }}',
                method: 'POST',
                data: {
                    receiver_id: currentChatUserId,
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#messageInput').val('');

                    let messageTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    let messageHtml = `
                        <div class="chat-message sender">
                            <div class="message-content">
                                <p><strong>{{ Auth::user()->name }}:</strong> ${message}</p>
                                <div class="timestamp">${messageTime}</div>
                            </div>
                        </div>`;

                    $('#chatMessageContainer').append(messageHtml);
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
});


</script>
@endsection
