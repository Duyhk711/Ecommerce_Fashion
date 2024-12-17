@extends('layouts.backend')

@section('css')
    <style>
        .chat-app {
            display: flex;
            height: calc(100vh - 138px);
            overflow: hidden;
        }

        .list-user {
            width: 30%;
            border-right: 1px solid #ddd;
            border-left: 1px solid #ddd;
            height: 100%;
            background-color: #FFFFFF;
            overflow-y: auto;
            box-sizing: border-box;
        }

        .chat-frame {
            width: 70%;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .chat-header {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            flex-shrink: 0;
        }

        #messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px;
            box-sizing: border-box;
            background-color: #EEF0F1;
        }

        #messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px;
            box-sizing: border-box;
            background-color: #EEF0F1;
            scrollbar-width: thin;
            scrollbar-color: #007bff #E4E4E4;
        }

        #messages::-webkit-scrollbar {
            width: 12px;
        }

        #messages::-webkit-scrollbar-track {
            background-color: #E4E4E4;
            border-radius: 10px;
        }

        #messages::-webkit-scrollbar-thumb {
            background-color: #CFD2D5;
            border-radius: 10px;
        }

        #messages::-webkit-scrollbar-thumb:hover {
            background-color: #0056b3;
        }

        .chat-header {
            display: flex;
        }

        .chat-footer {
            display: flex;
            gap: 10px;
            position: relative;
            align-items: center;
            border-top: 1px solid #ddd;
            flex-shrink: 0;
        }

        .chat-footer button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            height: 35px;
            padding: 0 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1;
        }

        .chat-footer input[type="text"] {
            flex-grow: 1;
            padding: 15px;
            box-sizing: border-box;
        }

        #user-list {
            list-style: none;

            padding: 0;
        }

        #user-list li {
            padding: 10px;
        }

        #user-list li:hover {
            background-color: #EEF0F1;
        }

        #user-list li.selected {
            background-color: #E5EFFF;
        }

        .list-header {
            text-align: center;
            border: 1px solid #ddd;
        }

        .chat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #FFFFFF;
        }

        #user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-header #end-session {
            margin-left: auto;
            background-color: #dc3545;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            height: 40px;
        }

        .message p {
            margin: 0;
            padding: 0;
            margin-bottom: 15px;
        }

        .message.user {
            text-align: left;
            background-color: #F7F7F7;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 10px;
            max-width: 70%;
            word-wrap: break-word;
            display: inline-block;
            clear: both;
            float: left;
            box-shadow: 0px 0px 1px 0px rgba(21, 39, 71, 0.25), 0px 1px 1px 0px rgba(21, 39, 71, 0.25);
        }

        .message.admin {
            text-align: left;
            background-color: #dbebff;
            color: #081b3a;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 10px;
            max-width: 70%;
            word-wrap: break-word;
            display: inline-block;
            clear: both;
            float: right;
            box-shadow: 0px 0px 1px 0px rgba(21, 39, 71, 0.25), 0px 1px 1px 0px rgba(21, 39, 71, 0.25);
        }

        .message-time {
            font-size: 12px;
        color: gray;
        text-align: left;
        margin-top: 5px;
        }

        #user-list li {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }

        #user-list li .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-grow: 1;
            white-space: nowrap;
            overflow: hidden;
        }

        #user-list li .user-name {
            max-width: calc(100% - 50px);
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            display: block;
        }

        #user-list li .unread-count {
            margin-left: 8px;
            color: #fff;
            background-color: #dc3545;
            padding: 6px 9px;
            border-radius: 50%;
            font-size: 0.7rem;
            width: 25px;
            height: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            white-space: nowrap;
        }

        #user-name {
            font-size: 1.125rem;
            font-weight: 500;
            line-height: 1.5;
        }

        button#end-session {
            max-width: 100px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 8px 16px;
            font-size: 14px;
            text-align: center;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: not-allowed;

        }
    </style>
@endsection


@section('content')
    <div class="chat-app">

        <div class="list-user">
            <div class="list-header">
                <h3>Danh sách user</h3>
            </div>
            <ul id="user-list"></ul>
        </div>

        <div class="chat-frame">
            <div class="chat-header" style="display: none;">
                <img id="user-avatar" src="" alt="User Avatar">
                <span id="user-name">Tên người dùng</span>
                <button id="end-session" disabled>Kết thúc</button>
            </div>
            <div class="welcome-frame" style="display: block; text-align: center; padding: 150px; flex-grow: 1;">
                <h2>Chào mừng bạn đến với hệ thống chat</h2>
                <p>Chọn một người dùng từ danh sách bên trái để bắt đầu trò chuyện.</p>
                <img src="https://cdn-icons-png.flaticon.com/512/8744/8744028.png" width="80px" alt=""
                    srcset="">
            </div>
            <div id="messages" style="display: none;"></div>
            <div class="chat-footer" style="display: none;">
                <input type="text" id="message" placeholder="Type your message..." style="width: 70%;">
                <button id="send" disabled><i class="bi bi-send"></i></button>

            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <script src="{{ asset('admin/js/lib/jquery.min.js') }}"></script>
    @vite(['resources/js/chat.js'])
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#user-list').on('click', 'li', function() {
                $('#user-list li').removeClass('selected');
                $(this).addClass('selected');
                $('.welcome-frame').hide();
                $('#messages').show();
                $('.chat-header').show();
                $('.chat-footer').show();
            });

            function scrollToBottom() {
                const messageBox = $('#messages');
                messageBox.scrollTop(messageBox[0].scrollHeight);
            }
            const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
            });
            let sessionId = null;
            const adminChannel = pusher.subscribe('admin-{{ auth()->id() }}');
            adminChannel.bind('new-session-assigned', function(data) {
                console.log('New session assigned to you:', data);

                loadSessions();
            });

            adminChannel.bind('new-message', function(data) {
                console.log('New message received:', data);

                loadSessions();
                if (sessionId === data.chat_session_id) {
                    markMessagesRead();
                }
            });

            function loadSessions() {
                $.ajax({
                    url: '/admin/list-sessions',
                    method: 'GET',
                    success: function(response) {
                        const sessions = response.sessions;
                        const userList = $('#user-list');
                        userList.empty();

                        if (Array.isArray(sessions)) {
                            sessions.forEach(session => {
                                const li = $('<li></li>');
                                const avatarPath = session.user.avatar;
                                const avatarUrl = avatarPath && avatarPath.startsWith(
                                        'avatars/') ?
                                    `{{ asset('storage/') }}/${avatarPath}` :
                                    avatarPath ?
                                    avatarPath :
                                    `http://fashion1.com/client/images/users/default-avatar.jpg`;

                                let sessionInfo = `<div class="user-info">
                                            <img src="${avatarUrl}" alt="img" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                                            <span class="user-name">${session.user.name}</span>
                                        </div>
                                    `;

                                if (session.unread_count > 0 && session.id !== sessionId) {
                                    sessionInfo += `
                                        <div class="unread-count">${session.unread_count}</div>
                                    `;
                                }

                                li.html(sessionInfo);
                                li.css('cursor', 'pointer');
                                li.on('click', function() {
                                    if (sessionId) {
                                        pusher.unsubscribe(`chat-session.${sessionId}`);
                                    }
                                    sessionId = session.id;
                                    loadMessages(sessionId);

                                    const avatarPath = session.user.avatar;
                                    const avatarUrl = avatarPath && avatarPath
                                        .startsWith('avatars/') ?
                                        `{{ asset('storage/') }}/${avatarPath}` :
                                        avatarPath ?
                                        avatarPath :
                                        `http://fashion1.com/client/images/users/default-avatar.jpg`;

                                    $('#user-avatar').attr('src', avatarUrl);
                                    $('#user-name').text(session.user.name);
                                    $('#message').attr('placeholder',
                                        `Nhập tin nhắn tới ${session.user.name}`);
                                    $('#send').prop('disabled', false);
                                    $('#end-session').prop('disabled', false);
                                    li.find('.unread-count')
                                        .remove();

                                    const channel = pusher.subscribe(
                                        `chat-session.${sessionId}`);
                                    channel.bind('session-ended', function(data) {
                                        if (data.initiatorId !== {{ auth()->id() }}) {
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Phiên chat đã kết thúc',
                                        text: 'Phiên hỗ trợ khách hàng đã được đóng.',
                                        confirmButtonText: 'OK'
                                    });
                                        pusher.unsubscribe(
                                            `chat-session.${sessionId}`);
                                        $('#user-list li.selected').removeClass(
                                            'selected');
                                        $('#messages')
                                            .empty();
                                        $('.chat-header')
                                            .hide();
                                        $('.chat-footer')
                                            .hide();
                                        $('.welcome-frame')
                                            .show();                               
                                        loadSessions();
    }
                                    });

                                    channel.bind('new-message', function(data) {
                                        const senderType = data.sender_id ===
                                            {{ auth()->id() }} ? 'admin' :
                                            'user';
                                        const formattedTime = new Date(data.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                                        appendMessage(data.message, senderType,
                                            formattedTime);

                                        if (sessionId === data
                                            .chat_session_id) {
                                            markMessagesRead();
                                        }
                                    });

                                    markMessagesRead
                                        ();
                                });
                                userList.append(li);
                            });
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }


            function appendMessage(content, senderType, timestamp) {
                const messageBox = $('#messages');
                const messageHtml = `
                                    <div class="message ${senderType}">
                                        <p>${content}</p>
                                        <div class="message-time">${timestamp}</div>
                                    </div>
                                    `;
                messageBox.append(messageHtml);
                scrollToBottom();
            }

            function markMessagesRead() {
                $.ajax({
                    url: `/admin/mark-messages-read/${sessionId}`,
                    method: 'POST',
                    success: function() {
                        const selectedUser = $('#user-list li.selected');
                        selectedUser.find('.unread-count').remove();
                    }
                });
            }

            function loadMessages(sessionId) {
                $.ajax({
                    url: `/admin/sessions/${sessionId}/messages`,
                    method: 'GET',
                    success: function(response) {
                        const messages = response.messages;
                        const messageBox = $('#messages');
                        messageBox.empty();
                        messages.forEach(msg => {
                            const senderType = msg.sender_id === {{ auth()->id() }} ? 'admin' :
                                'user';
                                const formattedTime = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                            appendMessage(msg.message, senderType, formattedTime);
                        });
                        scrollToBottom()
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

            $('#send').on('click', function() {
                const message = $('#message').val();
                if (!message || !sessionId) return;

                $.ajax({
                    url: `/admin/send-message/${sessionId}`,
                    method: 'POST',
                    data: {
                        message: message
                    },
                    success: function(response) {
                        $('#message').val('');
                        scrollToBottom();
                    },
                    error: function(error) {
                        console.error(error);
                        alert(
                            'Failed to send message.'
                        );
                    }
                });
            });

            $('#message').on('keypress', function(event) {
                if (event.key === 'Enter' && !event
                    .shiftKey) {
                    event.preventDefault();
                    $('#send').trigger('click');
                }
            });

            $('#end-session').on('click', function() {
    if (!sessionId) return;

    // Thay thế confirm bằng SweetAlert2
    Swal.fire({
        title: 'Kết thúc phiên chat?',
        text: 'Bạn có chắc chắn muốn kết thúc phiên chat này?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Hủy',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/admin/end-session/${sessionId}`,
                method: 'POST',
                success: function() {
                    pusher.unsubscribe(`chat-session.${sessionId}`);
                    sessionId = null;
                    $('#user-list li.selected').removeClass('selected');
                    $('#messages').empty(); // Xóa tin nhắn
                    $('.chat-header').hide();
                    $('.chat-footer').hide();
                    $('.welcome-frame').show();
                    loadSessions();

                    // Hiển thị thông báo SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: 'Phiên chat đã được kết thúc.',
                    });
                },
                error: function(error) {
                    console.error(error);
                    // Thông báo lỗi
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Không thể kết thúc phiên chat. Vui lòng thử lại.',
                    });
                }
            });
        }
    });
});

            loadSessions();
        });
    </script>
@endsection
