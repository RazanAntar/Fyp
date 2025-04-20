<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Professional Chat</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f5f0fa, #e7ddf2);
        }

        .chat-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
    background: #462755;
    color: #fff;
    width: 300px;
    display: flex;
    flex-direction: column;
    box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
}



        .sidebar-header {
            padding: 1.7rem;
            font-size: 1.3rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.05);
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .chat-list {
            flex: 1;
            overflow-y: auto;
        }

        .chat-item {
            padding: 15px 20px;
            cursor: pointer;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.25s ease;
        }

        .chat-item:hover,
        .chat-item.active {
            background: rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 0 8px rgba(255, 255, 255, 0.1);
        }

        .chat-item .profile_name {
            font-weight: 500;
        }

        /* Chat Area */
        .chat-area {
            flex: 1;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            display: flex;
            flex-direction: column;
            backdrop-filter: blur(3px);
        }

        .chat-header {
            background: #f0e7f8;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #d6c9e5;
            font-size: 1.1rem;
            font-weight: 600;
            backdrop-filter: blur(8px);
        }

        .chat-message-container {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .chat-message {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-end;
        }

        .chat-message.sender {
            justify-content: flex-end;
        }

        .chat-message .message-content {
            max-width: 70%;
            padding: 0.9rem 1.2rem;
            border-radius: 20px;
            line-height: 1.5;
            font-size: 0.95rem;
            position: relative;
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .chat-message.sender .message-content {
            background: linear-gradient(135deg, #a88bc4, #c5aadf);
            color: #fff;
            border-bottom-right-radius: 0;
        }

        .chat-message.receiver .message-content {
            background: #efe6f5;
            color: #3d3b4f;
            border-bottom-left-radius: 0;
        }

        .timestamp {
            font-size: 0.75rem;
            color: #9a8cad;
            margin-top: 0.3rem;
        }

        .chat-footer {
            padding: 1rem 1.5rem;
            background: #f5effb;
            border-top: 1px solid #d6c9e5;
        }

        .chat-footer .form-control {
            border-radius: 25px;
            padding: 0.75rem 1.25rem;
            background: #f3ecf8;
            border: none;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .chat-footer .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(174, 144, 218, 0.3);
        }

        .chat-footer .btn {
            border-radius: 50%;
            padding: 0.65rem 0.8rem;
            margin-left: 0.5rem;
            background: linear-gradient(135deg, #b89ed8, #e6dcf3);
            border: none;
            color: #fff;
            transition: background 0.3s ease;
        }

        .chat-footer .btn:hover {
            background: linear-gradient(135deg, #a082c0, #d3c3e9);
        }
    </style>
</head>

<body>
    <div class="chat-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">💬 Chat List</div>
            <div class="chat-list" id="chatList">
                @foreach ($users as $user)
                <div class="chat-item">
                    <span class="profile_name">{{ $user->name ?? 'Unknown User' }}</span>
                    <span class="id d-none">{{ $user->id }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Chat Area -->
        <div class="chat-area">
            <div class="chat-header" id="chat_name">🧑‍💼 Select a chat to begin</div>
            <div class="chat-message-container" id="chatMessageContainer"></div>
            <div class="chat-footer">
                <form id="messageForm">
                    @csrf
                    <input type="hidden" id="receiver_id" name="receiver_id">
                    <div class="d-flex">
                        <input type="text" class="form-control" id="messageInput" name="message"
                            placeholder="Type a message..." disabled>
                        <button type="submit" class="btn" id="sendMessageButton" disabled>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
        $(function () {
            let professionalId = '{{ session("LoggedProfessionalInfo") }}';

            $('.chat-item').click(function () {
                $('.chat-item').removeClass('active');
                $(this).addClass('active');

                let profileName = $(this).find('.profile_name').text();
                let receiverId = $(this).find('.id').text();

                $('#receiver_id').val(receiverId);
                $('#chat_name').text('💬 Chatting with ' + profileName);
                $('#messageInput, #sendMessageButton').prop('disabled', false);

                $.get("{{ route('professional.fetchMessages') }}", {
                    receiver_id: receiverId
                }, function (res) {
                    $('#chatMessageContainer').empty();
                    res.messages.forEach(function (msg) {
                        let isSender = msg.sender_id == professionalId;
                        displayMessage(msg.message, isSender, msg.created_at);
                    });
                });
            });

            $('#messageForm').submit(function (e) {
                e.preventDefault();

                let message = $('#messageInput').val().trim();
                let receiverId = $('#receiver_id').val();

                if (!message || !receiverId) return;

                $.post("{{ route('professional.sendMessage') }}", {
                    _token: '{{ csrf_token() }}',
                    message: message,
                    receiver_id: receiverId
                }, function (res) {
                    if (res.success) {
                        displayMessage(message, true);
                        $('#messageInput').val('');
                    }
                });
            });

            function displayMessage(msg, isSender, timestamp = null) {
                let time = timestamp ? new Date(timestamp).toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                }) : new Date().toLocaleTimeString();
                let html = `
                    <div class="chat-message ${isSender ? 'sender' : 'receiver'}">
                        <div class="message-content">
                            <p class="mb-1">${msg}</p>
                            <div class="timestamp">${time}</div>
                        </div>
                    </div>`;
                $('#chatMessageContainer').append(html).scrollTop($('#chatMessageContainer')[0].scrollHeight);
            }

            Pusher.logToConsole = false;
            const pusher = new Pusher('0984dcda606910d49e10', {
                cluster: 'mt1'
            });
            const channel = pusher.subscribe('professional-messages');

            channel.bind('user-message', function (data) {
                if (data.sender_id == $('#receiver_id').val()) {
                    displayMessage(data.message, false, data.created_at);
                }
            });
        });
    </script>
</body>

</html>
