hayda code el admin dashboard: <!DOCTYPE html>
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
    <style>
        :root {
            --deep-navy: #003865;
            --light-blue: #dde7f4;
            --soft-purple: #5d4177; /* Softer purple for better contrast */
            --white: #ffffff;
            --light-gray: #f5f7fa;
            --sidebar-width: 260px;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-blue);
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            background-color: var(--deep-navy);
            color: var(--white);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        
        .sidebar-header h3 {
            color: var(--white);
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .sidebar-menu {
            padding: 20px 0;
            list-style: none;
            margin: 0;
            flex-grow: 1;
            overflow-y: auto;
        }
        
        .sidebar-menu li a {
            color: rgba(255, 255, 255, 0.9);
            padding: 12px 25px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.2s ease;
            margin: 5px 10px;
            border-radius: 6px;
        }
        
        .sidebar-menu li a:hover, 
        .sidebar-menu li a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
        }
        
        .sidebar-menu li a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            color: var(--light-blue);
        }
        
        .sidebar-menu .badge {
            margin-left: auto;
            background-color: var(--light-blue);
            color: var(--deep-navy);
            font-weight: 600;
            min-width: 24px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }
        
        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 25px;
            min-height: 100vh;
            background-color: var(--light-blue);
        }
        
        /* Header */
        .dashboard-header {
            background-color: var(--white);
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 4px solid var(--soft-purple); /* Purple accent */
        }
        
        .dashboard-header h2 {
            color: var(--deep-navy);
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        /* Notification */
        .notification-wrapper {
            position: relative;
        }
        
        .btn-notification {
            background-color: var(--soft-purple); /* Updated purple */
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .btn-notification:hover {
            background-color: #4a3560;
        }
        
        .btn-notification .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--light-blue);
            color: var(--deep-navy);
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            border: 1px solid var(--deep-navy);
        }
        
        .notification-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            width: 350px;
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.2s ease;
            border-top: 3px solid var(--soft-purple); /* Purple accent */
        }
        
        .notification-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .notification-header {
            padding: 15px 20px;
            border-bottom: 1px solid var(--light-blue);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: var(--light-blue);
        }
        
        .notification-header h5 {
            margin: 0;
            color: var(--deep-navy);
            font-weight: 600;
        }
        
        .notification-body {
            max-height: 400px;
            overflow-y: auto;
            padding: 10px 0;
        }
        
        .notification-item {
            padding: 12px 20px;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            margin: 5px 10px;
            border-radius: 6px;
        }
        
        .notification-item:hover {
            background-color: var(--light-blue);
            border-left: 3px solid var(--soft-purple); /* Purple accent */
        }
        
        .notification-item i {
            margin-right: 12px;
            color: var(--soft-purple); /* Updated purple */
        }
        
        /* Cards */
        .section-card {
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            overflow: hidden;
            border: 1px solid var(--light-blue);
        }
        
        .section-header {
            background-color: var(--deep-navy);
            color: white;
            padding: 15px 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 2px solid var(--soft-purple); /* Purple accent */
        }
        
        .section-header i {
            color: var(--light-blue);
        }
        
        .section-body {
            padding: 20px;
            background-color: var(--white);
        }
        
        /* Tables */
        .table-container {
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid var(--light-blue);
            background-color: var(--white);
        }
        
        .table {
            margin-top: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table thead {
            background-color: var(--deep-navy);
            color: white;
        }
        
        .table thead th {
            padding: 12px 15px;
            font-weight: 500;
            border: none;
        }
        
        .table tbody tr {
            transition: all 0.2s ease;
        }
        
        .table tbody tr:nth-child(even) {
            background-color: var(--light-blue);
        }
        
        .table tbody tr:hover {
            background-color: #c9d9f0;
        }
        
        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-top: 1px solid rgba(0, 0, 0, 0.03);
        }
        
        /* Status Badges */
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-badge.active {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: 1px solid #28a745;
        }
        
        .status-badge.inactive {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid #dc3545;
        }
        
        /* Buttons */
        .btn {
            transition: all 0.2s ease;
            font-weight: 500;
        }
        
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        
        .btn-info {
            background-color: var(--soft-purple); /* Updated purple */
            border-color: var(--soft-purple);
            color: white;
        }
        
        .btn-info:hover {
            background-color: #4a3560;
            border-color: #4a3560;
        }
        
        /* Chat */
        .chat-container {
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid var(--light-blue);
        }
        
        #chat-box {
            height: 300px;
            overflow-y: auto;
            padding: 15px;
            background-color: var(--light-blue);
        }
        
        .message {
            margin-bottom: 12px;
            max-width: 80%;
            padding: 8px 12px;
            border-radius: 6px;
            background-color: var(--white);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .message.sent {
            margin-left: auto;
            background-color: var(--soft-purple); /* Updated purple */
            color: white;
        }
        
        .chat-input-container {
            padding: 15px;
            background-color: var(--white);
            border-top: 1px solid var(--light-blue);
            display: flex;
            gap: 10px;
        }
        
        #chat-message {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid var(--light-blue);
            border-radius: 6px;
        }
        
        #send-button {
            padding: 10px 20px;
            background-color: var(--deep-navy);
            border: none;
            color: white;
            border-radius: 6px;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 30px 20px;
            color: var(--deep-navy);
            background-color: var(--light-blue);
            border-radius: 8px;
        }
        
        .empty-state i {
            font-size: 2rem;
            color: var(--soft-purple); /* Updated purple */
            margin-bottom: 10px;
        }
        
        /* Toggle Button for Mobile */
        .mobile-menu-btn {
            display: none;
            background-color: var(--soft-purple);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }
            
            .sidebar-header h3,
            .sidebar-menu li a span,
            .sidebar-menu .badge {
                display: none;
            }
            
            .sidebar-menu li a {
                justify-content: center;
                padding: 12px 0;
                margin: 5px 0;
            }
            
            .sidebar-menu li a i {
                margin-right: 0;
                font-size: 1.2rem;
            }
            
            .main-content {
                margin-left: 80px;
            }
            
            .mobile-menu-btn {
                display: block;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 260px;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            
            .dashboard-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .notification-dropdown {
                width: 280px;
                right: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-user-shield"></i> <span class="sidebar-title">Admin</span></h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li><a href="#students"><i class="fas fa-user-graduate"></i> <span>Students</span></a></li>
            <li><a href="#professionals"><i class="fas fa-user-tie"></i> <span>Professionals</span></a></li>
            <li><a href="#jobs"><i class="fas fa-briefcase"></i> <span>Jobs</span></a></li>
            <li><a href="#chat"><i class="fas fa-comments"></i> <span>Chat</span></a></li>
            <li><a href="#" id="notification-link"><i class="fas fa-bell"></i> <span>Notifications</span> 
                <span class="badge" id="sidebar-notification-count">{{ $inactiveProfessionals + $pendingJobsCount }}</span></a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <button class="mobile-menu-btn" id="toggle-sidebar">
            <i class="fas fa-bars"></i> Menu
        </button>
        
        <div class="dashboard-header">
            <h2><i class="fas fa-tachometer-alt"></i> Dashboard Overview</h2>
            <div class="notification-wrapper">
                <button class="btn-notification" id="notification-icon">
                    <i class="fas fa-bell"></i>
                    <span class="badge" id="notification-count">{{ $inactiveProfessionals + $pendingJobsCount }}</span>
                </button>
                <div class="notification-dropdown" id="notification-dropdown">
                    <div class="notification-header">
                        <h5><i class="fas fa-bell me-2"></i>Notifications</h5>
                    </div>
                    <div class="notification-body">
                        <div class="notification-item">
                            <i class="fas fa-user-tie"></i>
                            <strong>{{ $inactiveProfessionals }}</strong> professionals waiting for approval
                        </div>
                        <div class="notification-item">
                            <i class="fas fa-briefcase"></i>
                            <strong>{{ $pendingJobsCount }}</strong> jobs waiting for approval
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Section -->
        <div class="section-card" id="students">
            <div class="section-header">
                <i class="fas fa-user-graduate"></i>
                <span>Students Management</span>
            </div>
            <div class="section-body">
                <div class="table-container">
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
                                <tr><td colspan="5" class="empty-state">
                                    <i class="fas fa-user-slash"></i>
                                    <h5>No inactive student accounts</h5>
                                </td></tr>
                            @else
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td><span class="status-badge {{ $student->status === 'active' ? 'active' : 'inactive' }}">
                                        {{ $student->status }}
                                    </span></td>
                                    <td>
                                        <form action="{{ route('admin.activate-student', $student->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Professionals Section -->
        <div class="section-card" id="professionals">
            <div class="section-header">
                <i class="fas fa-user-tie"></i>
                <span>Professionals Management</span>
            </div>
            <div class="section-body">
                <div class="table-container">
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
                                <td><span class="status-badge {{ $professional->status === 'active' ? 'active' : 'inactive' }}">
                                    {{ $professional->status }}
                                </span></td>
                                <td>
                                    <form action="{{ route('admin.professionals.activate', $professional->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Jobs Section -->
        <div class="section-card" id="jobs">
            <div class="section-header">
                <i class="fas fa-briefcase"></i>
                <span>Job Listings Management</span>
            </div>
            <div class="section-body">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Major</th>
                                <th>Salary</th>
                                <th>Location</th>
                                <th>Requirements</th>
                                <th>Actions</th>
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
                                    <div class="d-flex gap-2">
                                        <button onclick="evaluateJob({{ $job->id }})" class="btn btn-info btn-sm">Evaluate</button>
                                        <form action="{{ route('admin.jobs.activate', $job->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="description" value="{{ $job->description }}">
                                            <input type="hidden" name="requirements" value="{{ $job->requirements }}">
                                            <input type="hidden" name="salary" value="{{ $job->salary }}">
                                            <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Chat Section -->
        <div class="section-card" id="chat">
            <div class="section-header">
                <i class="fas fa-comments"></i>
                <span>Chat with Professionals</span>
            </div>
            <div class="section-body p-0">
                <div id="chat-box">
                    <!-- Messages will be displayed here -->
                </div>
                <div class="chat-input-container">
                    <input type="text" id="chat-message" placeholder="Type a message..." class="form-control">
                    <button id="send-button">Send</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // All original JavaScript functionality remains exactly the same
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
                return response.json().then(err => {
                    throw new Error(err.error || 'Unknown error occurred');
                });
            }
            return response.json();
        })
        .then(data => {
            alert(`Evaluation Results:\nMajor Accepted: ${data.major_accepted}\nSalary Evaluation: ${data.salary_evaluation}\nLocation Evaluation: ${data.location_evaluation}\nRequirements Evaluation: ${data.requirements_evaluation}`);
        })
        .catch(error => {
            console.error('Error:', error);
            alert(`Error: ${error.message}`);
        });
    }

    $(document).ready(function () {
        $('#toggle-sidebar').click(function() {
            $('#sidebar').toggleClass('active');
        });
        
        $('#notification-icon, #notification-link').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('#notification-dropdown').toggleClass('show');
        });
        
        $(document).click(function() {
            $('#notification-dropdown').removeClass('show');
        });
        
        $('#notification-dropdown').click(function(e) {
            e.stopPropagation();
        });

        $('.sidebar-menu a').on('click', function(e) {
            if (this.hash !== "" && !$(this).is('#notification-link')) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $(this.hash).offset().top - 20
                }, 800);
                $('.sidebar-menu a').removeClass('active');
                $(this).addClass('active');
                if ($(window).width() < 992) {
                    $('#sidebar').removeClass('active');
                }
            }
        });

        $('#send-button').click(function() {
            const message = $('#chat-message').val().trim();
            if (message !== '') {
                $.post('/send-message', { message: message }, function(data) {
                    if (data.success) {
                        $('#chat-box').append('<div class="message sent">' + message + '</div>');
                        $('#chat-message').val('');
                        $('#chat-box').scrollTop($('#chat-box').prop('scrollHeight'));
                    }
                }).fail(function(xhr, status, error) {
                    alert('Error: ' + xhr.responseText);
                });
            }
        });

        function loadMessages() {
            $.get('/get-messages', function(messages) {
                $('#chat-box').empty();
                messages.forEach(function(msg) {
                    $('#chat-box').append('<div class="message ' + (msg.user === 'You' ? 'sent' : 'received') + '">' + msg.message + '</div>');
                });
                $('#chat-box').scrollTop($('#chat-box').prop('scrollHeight'));
            });
        }

        loadMessages();
    });

    document.addEventListener('DOMContentLoaded', function() {
        Pusher.logToConsole = {{ config('app.env') === 'local' ? 'true' : 'false' }};
        var pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
            encrypted: true
        });

        var channel = pusher.subscribe('notification');
        channel.bind('test.notification', function(data) {
            console.log('Received data:', data);
            const currentCount = parseInt($('#notification-count').text());
            $('#notification-count').text(currentCount + 1);
            $('#sidebar-notification-count').text(currentCount + 1);

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
                        timeOut: 5000,
                        extendedTimeOut: 2000,
                        positionClass: 'toast-top-right',
                        enableHtml: true
                    }
                );
            }
        });
    });
    </script>
</body>
</html>