<style>
    #chat-icon,
    #chatbox {
        z-index: 9999;
        position: fixed;
    }

    #chat-icon {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: white;
        border-radius: 50%;
        padding: 15px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    #chatbox {
        position: fixed;
        bottom: 80px;
        right: 20px;
        width: 350px;
        height: 450px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: none;
        overflow: hidden;
        flex-direction: column;
    }

    #chat-header {
        background-color: #007bff;
        color: white;
        padding: 15px;
        text-align: center;
        font-weight: bold;
        position: relative;
        font-size: 16px;
    }

    #end-chat {
        position: absolute;
        top: 12px;
        right: 12px;
        background: none;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    #messages {
        height: 340px;
        overflow-y: auto;
        padding: 15px;
        display: flex;
        flex-direction: column;
        background-color: #EEF0F1;
    }

    .message {
        max-width: 75%;
        margin: 8px 0;
        padding: 10px 15px;
        border-radius: 10px;
        word-wrap: break-word;
        font-size: 14px;
        line-height: 1.5;
    }

    .message.user {
        background-color: #dbebff;
        color: #081b3a;
        align-self: flex-end;
        box-shadow: 0px 0px 1px 0px rgba(21, 39, 71, 0.25), 0px 1px 1px 0px rgba(21, 39, 71, 0.25);
    }

    .message.admin {
        background-color: #F7F7F7;
        border-radius: 10px;
        align-self: flex-start;
        box-shadow: 0px 0px 1px 0px rgba(21, 39, 71, 0.25), 0px 1px 1px 0px rgba(21, 39, 71, 0.25);
    }

    .message-time {
        font-size: 12px;
        color: gray;
        text-align: left;
        margin-top: 5px;
    }

    #chat-footer {
        padding: 10px 15px;
        background-color: white;
        border-top: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    #message {
        flex: 1;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 20px;
        outline: none;
        margin-right: 10px;
    }

    #send {
        padding: 8px 14px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 14px;
    }

    #send:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }

    #start-chat-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    #start-chat-btn {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<div id="chat-icon">💬</div>

<div id="chatbox">
    <div id="chat-header">
        Hỗ trợ khách hàng
        <button id="end-chat">❌</button>
    </div>
    <div id="start-chat-container" style="display: none;">
        <button id="start-chat-btn">Bắt đầu chat</button>
    </div>
    <div id="messages" style="display: none;"></div>
    <div id="chat-footer" style="display: none;">
        <input type="text" id="message" placeholder="Nhập tin nhắn để gửi...">
        <button id="send" disabled><i class="bi bi-send-fill"></i></button>
    </div>
</div>

<script src="{{ asset('admin/js/lib/jquery.min.js') }}"></script>
@vite(['resources/js/chat.js'])
<script>
    const currentUserId = {{ auth()->check() ? auth()->id() : 'null' }};
</script>
<script>
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var sessionId = null;
        var debounceTimeout;

        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        });

        const userRole = '{{ auth()->user() ? auth()->user()->role : '' }}'; // Lấy role từ backend

        if (userRole === 'admin') {
            $('#chat-icon').hide(); // Ẩn nút chatbox nếu người dùng có role là admin
        }
        $('#chat-icon').on('click', function() {
            if (currentUserId === null) {
                Swal.fire({
                    icon: 'info',
                    title: 'Bạn chưa đăng nhập',
                    text: 'Vui lòng đăng nhập để sử dụng chức năng chat.',
                    confirmButtonText: 'OK'
                });
                return;
            }
            $('#chatbox').slideToggle();
            checkExistingSession();
        });


        function checkExistingSession() {
            $.ajax({
                url: '/check-session',
                type: 'GET',
                success: function(response) {
                    if (response.session) {
                        sessionId = response.session.id;
                        $('#start-chat-container').hide();
                        $('#messages').show();
                        $('#chat-footer').show();
                        $('#send').prop('disabled', false);
                        $('#end-chat').prop('disabled', false);
                        setupPusherChannel(sessionId);
                        loadMessages(sessionId);
                    } else {
                        $('#start-chat-container').show();
                        $('#messages').hide();
                        $('#chat-footer').hide();
                        $('#send').prop('disabled', true);
                        $('#end-chat').prop('disabled', true);
                    }
                }
            });
        }

        $(document).on('click', '#start-chat-btn', function() {
            startChatSession();
        });

        function startChatSession() {
            $.ajax({
                url: '/start-session',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    const session = response.session;
                    sessionId = session.id;
                    $('#start-chat-container').hide();
                    $('#messages').show();
                    $('#chat-footer').show();
                    $('#send').prop('disabled', false);
                    $('#end-chat').prop('disabled', false);
                    setupPusherChannel(sessionId);
                    loadMessages(sessionId);
                },
                error: function() {
                    alert('No admin available at the moment.');
                }
            });
        }

        function setupPusherChannel(sessionId) {
            const userChannel = pusher.subscribe('chat-session.' + sessionId);
            userChannel.bind('session-ended', function(data) {
                if (data.initiatorId !== currentUserId) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Phiên chat đã kết thúc',
                        text: 'Phiên hỗ trợ khách hàng đã được đóng.',
                        confirmButtonText: 'OK'
                    });
                    $('#send').prop('disabled', true);
                    $('#end-chat').prop('disabled', true);
                    $('#start-chat-container').show();
                    $('#messages').hide();
                    $('#chat-footer').hide();
                }
            });
            userChannel.bind('new-message', function(data) {
                const currentUserId = {{ auth()->check() ? auth()->id() : 'null' }};
                if (data.sender_id !== currentUserId) {
                    const time = new Date().toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    $('#messages').append(`
                        <div class="message admin">
                            ${data.message}
                            <div class="message-time">${time}</div>
                        </div>
                    `);
                    scrollToBottom();
                }
            });
        }
        $('#send').on('click', function() {
            const message = $('#message').val();
            if (message && sessionId) {
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(function() {
                    $.ajax({
                        url: `/send-message/${sessionId}`,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            message: message
                        },
                        success: function() {
                            const time = new Date().toLocaleTimeString([], {
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                            $('#messages').append(`
                                <div class="message user">
                                    ${message}
                                    <div class="message-time">${time}</div>
                                </div>
                            `);
                            $('#message').val('');
                            scrollToBottom();
                        },
                        error: function() {
                            alert('Failed to send message.');
                        },
                    });
                }, 10);
            }
        });

        $('#message').on('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                $('#send').trigger('click');
            }
        });

        $('#end-chat').on('click', function() {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn kết thúc phiên chat không?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Có, kết thúc!',
                cancelButtonText: 'Hủy',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    endChatSession();
                    Swal.fire(
                        'Đã kết thúc!',
                        'Phiên chat của bạn đã được kết thúc.',
                        'success'
                    );
                }
            });
        });

        function endChatSession() {
            $.ajax({
                url: `/end-session/${sessionId}`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function() {
                    sessionId = null;
                    $('#send').prop('disabled', true);
                    $('#end-chat').prop('disabled', true);
                    $('#start-chat-container').show();
                    $('#messages').hide();
                    $('#chat-footer').hide();
                },
                error: function() {
                    Swal.fire(
                        'Lỗi!',
                        'Không thể kết thúc phiên chat. Vui lòng thử lại.',
                        'error'
                    );
                }
            });
        }


        function scrollToBottom() {
            const messagesDiv = $('#messages');
            messagesDiv.scrollTop(messagesDiv.prop('scrollHeight'));
        }

        function loadMessages(sessionId) {
            $.ajax({
                url: `/messages/${sessionId}`,
                type: 'GET',
                success: function(messagesResponse) {
                    const messagesDiv = $('#messages');
                    messagesDiv.empty();

                    if (messagesResponse && Array.isArray(messagesResponse.messages)) {
                        messagesResponse.messages.forEach(function(message) {
                            const time = new Date(message.created_at).toLocaleTimeString(
                                [], {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                });
                            const cssClass = message.sender_id === currentUserId ? 'user' :
                                'admin';

                            messagesDiv.append(`
                                <div class="message ${cssClass}">
                                    ${message.message}
                                    <div class="message-time">${time}</div>
                                </div>
                            `);
                        });
                    }
                    scrollToBottom();
                },
                error: function() {
                    alert('Failed to load messages.');
                }
            });
        }

        function endChatSession() {
            $.ajax({
                url: `/end-session/${sessionId}`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function() {
                    sessionId = null;
                    $('#send').prop('disabled', true);
                    $('#end-chat').prop('disabled', true);
                    $('#start-chat-container').show();
                    $('#messages').hide();
                    $('#chat-footer').hide();
                },
                error: function() {
                    Swal.fire(
                        'Lỗi!',
                        'Không thể kết thúc phiên chat. Vui lòng thử lại.',
                        'error'
                    );
                }
            });
        }
    });
</script>
