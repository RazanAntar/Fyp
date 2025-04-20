<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Toastr JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Pusher JavaScript -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 2rem;
        }
        h1, h2 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }
        .notification-container {
            margin-bottom: 2rem;
        }
        .btn-notification {
            background-color: #3498db;
            border-color: #3498db;
            color: #fff;
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-notification:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
        }
        .badge {
            margin-left: 0.5rem;
        }
        .alert-info {
            background-color: #e9f5ff;
            border-color: #b6e0fe;
            color: #2c3e50;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }
        .table {
            margin-top: 1.5rem;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table thead {
            background-color: #3498db;
            color: #fff;
        }
        .table th, .table td {
            padding: 1rem;
            vertical-align: middle;
        }
        .table tbody tr {
            transition: background-color 0.3s ease;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .btn-success {
            background-color: #2ecc71;
            border-color: #2ecc71;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-success:hover {
            background-color: #27ae60;
            border-color: #27ae60;
        }
        .chat-container {
            margin-top: 2rem;
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        #chat-box {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
            border-radius: 10px;
            margin-bottom: 1rem;
        }
        #chat-message {
            width: 75%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-right: 0.5rem;
        }
        #send-button {
            padding: 0.75rem 1.5rem;
            background-color: #3498db;
            border: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        #send-button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        /* Add this CSS to your existing styles */
    .toast-info .toast-message {
        display: flex;
        align-items: center;
    }
    .toast-info .toast-message i {
        margin-right: 10px;
    }
    .toast-info .toast-message .notification-content {
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <!-- Notification Section -->
        <div class="notification-container">
            <button class="btn btn-notification" id="notification-icon">
                <i class="fas fa-bell"></i>
                <span class="badge bg-danger" id="notification-count">{{ $inactiveProfessionals + $pendingJobsCount }}</span>
            </button>
            <div class="alert alert-info" id="notification-message" style="display: none;">
                There are <strong>{{ $inactiveProfessionals }}</strong> professionals waiting for approval.<br>
                There are <strong>{{ $pendingJobsCount }}</strong> jobs waiting for approval.
            </div>
        </div>
        <h2>Students</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($students->isEmpty())
                <tr><td colspan="5" class="text-center">No inactive student accounts.</td></tr>
            @else
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->status }}</td>
                    <td>
                        <form action="{{ route('admin.activate-student', $student->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Activate</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
        <!-- Table of Professionals -->
        <h2>Professionals</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($professionals as $professional)
                <tr>
                    <td>{{ $professional->id }}</td>
                    <td>{{ $professional->name }}</td>
                    <td>{{ $professional->email }}</td>
                    <td>{{ $professional->status }}</td>
                    <td>
                        <form action="{{ route('admin.professionals.activate', $professional->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Activate</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Table of Jobs -->
        <h2>Jobs</h2>
        <table class="table">
            <thead>
                <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Major</th>
                <th>Salary</th>
                <th>Location</th>
                <th>Requirements</th>
                <th>Evaluate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                <tr data-job-id="{{ $job->id }}">
                <td>{{ $job->id }}</td>
                <td>{{ $job->title }}</td>
                <td class="job-major">{{ $job->major }}</td>
                <td class="job-salary">{{ $job->salary }}</td>
                <td class="job-location">{{ $job->location }}</td>
                <td class="job-requirements">{{ $job->requirements }}</td>
                    <td>
                    <button onclick="evaluateJob({{ $job->id }})" class="btn btn-info">Evaluate</button>
                        <form action="{{ route('admin.jobs.activate', $job->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="description" value="{{ $job->description }}">
    <input type="hidden" name="requirements" value="{{ $job->requirements }}">
    <input type="hidden" name="salary" value="{{ $job->salary }}">
    <button type="button" id="evaluate-job-button" class="btn btn-info">Evaluate Job</button>
                            <button type="submit" class="btn btn-success">Activate</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Chat Interface -->
        <div class="chat-container">
            <h2>Chat with Professionals</h2>
            <div id="chat-box">
                <!-- Messages will be displayed here -->
            </div>
            <div class="d-flex">
                <input type="text" id="chat-message" placeholder="Type a message..." />
                <button id="send-button">Send</button>
            </div>
        </div>
    </div>
    <script>
    // Define the function in the global scope to ensure it's accessible from `onclick` attributes
    function evaluateJob(jobId) {
        const row = document.querySelector(`tr[data-job-id="${jobId}"]`);
        const major = row.querySelector('.job-major').textContent.trim();
        const salary = parseFloat(row.querySelector('.job-salary').textContent.trim());
        const location = row.querySelector('.job-location').textContent.trim();
        const requirements = row.querySelector('.job-requirements').textContent.trim();

        fetch('{{ route('evaluate_job') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ major, salary, location, requirements })
        })
        .then(response => {
            if (!response.ok) {
                // If the response is not OK, parse the error message
                return response.json().then(err => {
                    throw new Error(err.error || 'Unknown error occurred');
                });
            }
            return response.json(); // Parse the JSON response if successful
        })
        .then(data => {
            // Display the evaluation results in an alert
            alert(`Evaluation Results:\nMajor Accepted: ${data.major_accepted}\nSalary Evaluation: ${data.salary_evaluation}\nLocation Evaluation: ${data.location_evaluation}\nRequirements Evaluation: ${data.requirements_evaluation}`);
        })
        .catch(error => {
            // Display the exact error message in an alert
            console.error('Error:', error);
            alert(`Error: ${error.message}`);
        });
    }

    // DOM Ready function for other initializations
    $(document).ready(function () {
        // Notification handling
        const notificationIcon = $('#notification-icon');
        const notificationMessage = $('#notification-message');
        notificationIcon.click(function () {
            notificationMessage.toggle(); // Toggle the display of notification message
        });

        // Message sending via AJAX
        $('#send-button').click(function() {
            const message = $('#chat-message').val().trim();
            if (message !== '') {
                $.post('/send-message', { message: message }, function(data) {
                    if (data.success) {
                        $('#chat-box').append('<div>' + message + '</div>');
                        $('#chat-message').val('');
                        $('#chat-box').scrollTop($('#chat-box').prop('scrollHeight'));
                    }
                }).fail(function(xhr, status, error) {
                    alert('Error: ' + xhr.responseText); // Debugging purposes
                });
            }
        });

        // Load messages
        function loadMessages() {
            $.get('/get-messages', function(messages) {
                $('#chat-box').empty(); // Clear chat box before loading messages
                messages.forEach(function(msg) {
                    $('#chat-box').append('<div>' + msg.message + '</div>');
                });
            });
        }

        loadMessages(); // Load messages when the page loads
    });


    // Only initialize if Pusher is needed on this page
    document.addEventListener('DOMContentLoaded', function() {
        // Enable Pusher logging only in development
        Pusher.logToConsole = {{ config('app.env') === 'local' ? 'true' : 'false' }};
        
        // Initialize Pusher with your credentials from .env
        var pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
            encrypted: true
        });

        // Subscribe to the channel
        var channel = pusher.subscribe('notification');

        // Bind to the event
        channel.bind('test.notification', function(data) {
            console.log('Received data:', data); // Debugging line

            // Display Toastr notification with icons and inline content
            if (data.author && data.title) {
                toastr.info(
                    `<div class="notification-content">
                        <i class="fas fa-user"></i> <span>   ${data.author}</span>
                        <i class="fas fa-book" style="margin-left: 20px;"></i> <span>  ${data.title}</span>
                    </div>`,
                    'New Post Notification',
                    {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 0, // Set timeOut to 0 to make it persist until closed
                        extendedTimeOut: 0, // Ensure the notification stays open
                        positionClass: 'toast-top-right',
                        enableHtml: true
                    }
                );
            } else {
                console.error('Invalid data received:', data);
            }
        });

        // Debugging line
        pusher.connection.bind('connected', function() {
            console.log('Pusher connected');
        });
    });

</script>

</body>
</html>