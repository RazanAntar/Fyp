<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Chat</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (optional icons) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .chat-list {
            max-height: 500px;
            overflow-y: auto;
        }
        .chat-message-container {
            min-height: 400px;
            padding: 1rem;
            background-color: #fff;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
            overflow-y: auto;
        }
        .chat-message {
            display: flex;
            margin-bottom: 1rem;
        }
        .chat-message .message-content {
            max-width: 70%;
            padding: 0.75rem 1rem;
            border-radius: 1rem;
        }
        .chat-message.sender {
            justify-content: flex-end;
        }
        .chat-message.sender .message-content {
            background-color: #dcf8c6;
        }
        .chat-message.receiver .message-content {
            background-color: #f1f1f1;
        }
        .timestamp {
            font-size: 0.75rem;
            color: #888;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row">
            <!-- Left: Professionals List -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Professionals</h5>
                    </div>
                    <ul class="list-group chat-list" id="chatList">
                        @foreach ($professionals as $professional)
                            <li class="list-group-item chat-item d-flex justify-content-between align-items-center">
                                <span class="fw-bold">{{ $professional->name }}</span>
                                <span class="id d-none">{{ $professional->id }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Right: Chat Area -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 id="chat_name" class="mb-0">Chat</h5>
                    </div>
                    <div class="card-body chat-message-container" id="chatMessageContainer"></div>
                    <div class="card-footer">
                        <form id="messageForm">
                            @csrf
                            <input type="hidden" name="receiver_id" id="receiver_id">
                            <div class="input-group">
                                <input type="text" class="form-control" id="messageInput" name="message" placeholder="Type a message...">
                                <button class="btn btn-primary" type="submit" id="sendMessageButton">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-5 text-center text-muted">
            &copy; {{ now()->year }} Student Chat - All Rights Reserved
        </footer>
    </div>

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.chat-item').click(function () {
            const receiverId = $(this).find('.id').text();
            const profileName = $(this).find('.fw-bold').text();
            $('#receiver_id').val(receiverId);
            $('#chat_name').text('Chatting with ' + profileName);
            loadMessages(receiverId);
        });

        $('#messageForm').submit(function (e) {
            e.preventDefault();
            sendMessage();
        });

        function loadMessages(receiverId) {
            $.get("{{ route('fetch.messagesForStudent') }}", { receiver_id: receiverId }, function (response) {
                $('#chatMessageContainer').empty();
                response.messages.forEach(msg => {
                    displayMessage(msg.message, msg.sender_id == '{{ auth()->id() }}', msg.created_at);
                });
            });
        }

        function sendMessage() {
            const message = $('#messageInput').val().trim();
            const receiverId = $('#receiver_id').val();
            if (!message || !receiverId) return;

            $.post("{{ route('send.messageFromStudentToProfessional') }}", {
                message: message,
                receiver_id: receiverId
            }, function (response) {
                if (response.success) {
                    displayMessage(message, true);
                    $('#messageInput').val('');
                }
            });
        }

        function displayMessage(content, isSender, timestamp = null) {
            const time = timestamp ? new Date(timestamp).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const html = `
                <div class="chat-message ${isSender ? 'sender' : 'receiver'}">
                    <div class="message-content">
                        <p class="mb-1">${content}</p>
                        <div class="timestamp">${time}</div>
                    </div>
                </div>`;
            $('#chatMessageContainer').append(html).scrollTop($('#chatMessageContainer')[0].scrollHeight);
        }

        // Pusher setup
        const pusher = new Pusher('0984dcda606910d49e10', { cluster: 'mt1' });
        const channel = pusher.subscribe('student-messages');
        channel.bind('student-message', function (data) {
            if (data.sender_id !== '{{ auth()->id() }}') {
                displayMessage(data.message, false, data.created_at);
            }
        });
    </script>
</body>
</html>
