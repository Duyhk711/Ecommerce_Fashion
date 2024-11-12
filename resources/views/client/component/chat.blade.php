<style>
    .chat-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .chat-button {
        background-color: #0084ff;
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        font-size: 25px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .chat-button:hover {
        background-color: #006dbf;
        transform: scale(1.1);
    }

    .chat-box {
        display: none;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        height: 450px;
        /* Cố định chiều cao của khung chat */
        width: 350px;
        position: fixed;
        bottom: 80px;
        right: 20px;
        display: flex;
        flex-direction: column;
        /* Chia chiều dọc cho header, body và footer */
    }

    .chat-header {
        background-color: #fff;
        color: rgb(0, 0, 0);
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 5px 5px 0 0;
        border: 1px solid #ddd;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .close-chat {
        background: none;
        border: none;
        color: rgb(14, 1, 1);
        font-size: 20px;
        cursor: pointer;
        transition: color 0.3s;
    }

    .close-chat:hover {
        color: #ff6b6b;
    }

    .chat-body {
        padding: 10px;
        flex: 1;
        /* Chiếm toàn bộ không gian còn lại */
        overflow-y: auto;
        overflow-x: hidden;
        border-bottom: 1px solid #ddd;
    }

    .message {
        margin-bottom: 10px;
        display: flex;
        flex-direction: column;
        max-width: 70%;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .sent {
        margin-left: 30%;
        align-self: flex-end;
        background-color: #0084ff;
        color: white;
        border-radius: 10px;
        padding: 10px;
        text-align: right;
        animation: slideInRight 0.3s;
    }

    .received {
        align-self: flex-start;
        background-color: #f0f0f0;
        color: black;
        border-radius: 10px;
        padding: 10px;
        text-align: left;
        animation: slideInLeft 0.3s;
    }

    .message-time {
        font-size: 10px;
        color: #888;
        margin-top: 5px;
    }

    .chat-footer {
        display: flex;
        align-items: center;
        padding: 10px;
        /* Thêm padding để tạo khoảng cách */
        background-color: #f8f8f8;
    }

    .chat-footer textarea {
        flex: 1;
        resize: none;
        border-radius: 20px;
        padding: 10px 15px;
        /* Thêm padding để tạo khoảng cách giữa nội dung và viền */
        min-height: 35px;
        margin-right: 10px;
        /* Tạo khoảng cách giữa textarea và nút gửi */
    }


    .chat-footer textarea:focus {
        border-color: #0084ff;
    }

    .chat-footer button {
        margin-left: 10px;
        border-radius: 50%;
        height: 35px;
        width: 35px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
    }

    .chat-footer button:hover {
        background-color: #006dbf;
    }

    #chatWithAdminName {
        font-weight: 400;
        font-size: large;
    }

    @keyframes slideInRight {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }

        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideInLeft {
        0% {
            transform: translateX(-100%);
            opacity: 0;
        }

        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .chat-box {
            width: 90%;
            max-height: 80%;
            right: 5%;
            bottom: 10px;
        }
    }

    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #f44336;
        /* Màu đỏ */
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 1001;
        /* Nằm trên chatbox */
    }
</style>

<div class="chat-container">
    <div class="chat-button" id="chatButton">
        <i class="anm anm-chat"></i>
    </div>
    <div class="chat-box" id="chatBox" style="display: none;">
        <div class="chat-header">
            <span id="chatWithAdminName">Trò chuyện Hỗ trợ</span>
            <button class="close-chat" id="closeChat">&times;</button>
        </div>
        <div class="chat-body">
            <div id="chatMessages" class="chat-messages">
                <div class="message received">
                    <div class="message-text"></div>
                    <div class="message-time"></div>
                </div>
                <div class="message sent">
                    <div class="message-text"></div>
                    <div class="message-time"></div>
                </div>
            </div>
        </div>
        <div class="chat-footer">
            <textarea id="messageInput" class="form-control" rows="1" placeholder="Type a message..."></textarea>
            <button id="sendMessage" class="btn btn-primary">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>
    </div>
</div>


<script src="{{ asset('admin/js/lib/jquery.min.js') }}"></script>
{{-- @vite(['resources/js/chat.js']) --}}
<script>
    $(document).ready(function() {
        let adminId;
        let userId = {{ Auth::check() ? Auth::id() : 'null' }};
        $('#chatButton').click(function() {
            // Kiểm tra nếu người dùng chưa đăng nhập
            if (userId === null) {
                alert('Bạn phải đăng nhập để bắt đầu chat !'); // Thông báo yêu cầu đăng nhập
                return; // Dừng việc mở chatbox
            }
            $('#chatBox').slideToggle(300);
            $.get('/get-first-admin', function(response) {
                if (response.admin_id) {
                    adminId = response.admin_id;
                    //$('#chatWithAdminName').text('   ' + response.admin_name);
                    $.get('/fetch-messages', {
                        receiver_id: adminId
                    }, function(messagesResponse) {
                        $('#chatMessages').empty();
                        messagesResponse.messages.forEach(function(message) {
                            let messageTime = new Date(message.created_at)
                                .toLocaleTimeString([], {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                });
                            let messageHtml = `
                                <div class="message ${message.sender_id == userId ? 'sent' : 'received'}">
                                    <div class="message-text">${message.message}</div>
                                    <div class="message-time">${messageTime}</div>
                                </div>`;
                            $('#chatMessages').append(messageHtml);
                        });
                        scrollToBottom();
                    });
                }
            });
        });

        $('#closeChat').click(function() {
            $('#chatBox').slideUp(300);
        });

        $('#sendMessage').click(function() {
            sendMessage();
        });

        $('#messageInput').keypress(function(event) {
            if (event.which == 13 && !event.shiftKey) {
                event.preventDefault();
                sendMessage();
            }
        });

        function sendMessage() {
            let message = $('#messageInput').val().trim();
            if (message) {
                $.post('/send-message', {
                    _token: '{{ csrf_token() }}',
                    message: message,
                    receiver_id: adminId
                }, function(response) {
                    if (response.success) {
                        let messageTime = new Date().toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        let messageHtml = `
                            <div class="message sent">
                                <div class="message-text">${message}</div>
                                <div class="message-time">${messageTime}</div>
                            </div>`;
                        $('#chatMessages').append(messageHtml);
                        $('#messageInput').val('');
                        scrollToBottom();
                    }
                });
            }
        }

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        var channel = pusher.subscribe('chat.' + userId);
        channel.bind('admin-message', function(data) {
            let messageTime = new Date(data.created_at).toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
            let messageHtml = `
                <div class="message received">
                    <div class="message-text">${data.message}</div>
                    <div class="message-time">${messageTime}</div>
                </div>`;

            $('#chatMessages').append(messageHtml);
            scrollToBottom();
        });

        function scrollToBottom() {
            const chatBody = $('.chat-body');
            chatBody.animate({
                scrollTop: chatBody[0].scrollHeight
            }, 300);
        }
    });
</script>
