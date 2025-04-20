<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
    --main-bg: #dde7f4;
    --card-bg: #ffffff;
    --primary: #3a4e6d;
    --primary-hover: #2e3d55;
    --light-accent: #f3f6fb;
    --shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

body {
    background-color: var(--main-bg);
    font-family: 'Segoe UI', sans-serif;
}

.container {
    background-color: var(--card-bg);
    border-radius: 16px;
    box-shadow: var(--shadow);
    padding: 2.5rem;
    margin-top: 3rem;
    margin-bottom: 3rem;
}

h1, h2, h5, h6 {
    color: var(--primary);
    font-weight: 700;
}

.btn-custom {
    background: linear-gradient(135deg, var(--primary), var(--primary-hover));
    border: none;
    color: #fff;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    transition: 0.3s ease;
}

.btn-custom:hover {
    transform: translateY(-2px);
    filter: brightness(1.05);
}

.list-group-item {
    background-color: var(--light-accent);
    border: none;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 1rem;
    transition: 0.2s ease;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
}

.list-group-item:hover {
    transform: scale(1.01);
}

.badge-success, .badge-secondary {
    font-size: 0.8rem;
    padding: 0.4em 0.8em;
    border-radius: 20px;
}

.view-resume {
    color: var(--primary);
    font-weight: 500;
    text-decoration: none;
    transition: 0.2s ease;
}

.view-resume:hover {
    color: var(--primary-hover);
    text-decoration: underline;
}

#chat-box {
    height: 300px;
    overflow-y: auto;
    border: 1px solid #ccc;
    padding: 1rem;
    background: white;
    border-radius: 10px;
    box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.03);
}

.message {
    padding: 10px 15px;
    border-radius: 15px;
    max-width: 75%;
    word-wrap: break-word;
    margin-bottom: 10px;
}

.outgoing-message {
    background-color: #d1e9ff;
    margin-left: auto;
    text-align: right;
}

.incoming-message {
    background-color: #f0f0f0;
    margin-right: auto;
}

.message-time {
    font-size: 0.75rem;
    color: #666;
    margin-top: 4px;
}

#chat-message {
    width: calc(100% - 120px);
    border-radius: 10px;
    padding: 10px;
    border: 1px solid #ced4da;
    margin-right: 10px;
}

#send-button {
    background-color: var(--primary);
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: bold;
    transition: 0.2s ease;
}

#send-button:hover {
    background-color: var(--primary-hover);
}

/* Resume Modal & Tabs */
.modal-header {
    background-color: var(--primary);
    color: #fff;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.nav-tabs .nav-link {
    font-weight: 600;
    color: var(--primary);
}

.nav-tabs .nav-link.active {
    color: #fff;
    background-color: var(--primary);
    border: none;
    border-radius: 10px 10px 0 0;
}

.analysis-section {
    background-color: var(--light-accent);
    padding: 1.5rem;
    border-radius: 10px;
    margin-bottom: 1.5rem;
}

.skill-badge {
    display: inline-block;
    background-color: #d1e9ff;
    color: #1a73e8;
    padding: 6px 12px;
    border-radius: 50px;
    font-size: 0.85rem;
    margin-right: 8px;
    margin-bottom: 6px;
}

.alert {
    border-radius: 12px;
}

.btn-outline-secondary {
    border-radius: 8px;
}

.btn-primary {
    border-radius: 8px;
    background-color: var(--primary);
    border: none;
    font-weight: 600;
}



    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-user-tie mr-2"></i>Professional Dashboard</h1>
        <div class="action-buttons d-flex flex-wrap mb-4 pt-5 px-2">
    <a href="{{ route('professional.post_job.form') }}" class="btn btn-custom mr-3 mb-3">
        <i class="fas fa-briefcase mr-2"></i>Create Job
    </a>
    <a href="{{ route('events.create') }}" class="btn btn-custom mr-3 mb-3">
        <i class="fas fa-calendar-alt mr-2"></i>Create Event
    </a>
    <a href="{{ route('professional.chats') }}" class="btn btn-primary mb-3">
        <i class="fas fa-comments mr-2"></i>Chat with Students
    </a>
    <a href="{{ route('professional.profile', ['id' => Auth::guard('professional')->id()]) }}" class="btn btn-outline-secondary mb-3">
    <i class="fas fa-user mr-2"></i>View My Profile
</a>

</div>



        


    <!-- Active Jobs Section -->
    <div class="container">
        <h2><i class="fas fa-tasks mr-2"></i>Your Job Postings</h2>
        <div class="list-group mb-4">
            @foreach ($jobs as $job)
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">{{ $job->title }}</h5>
                        <small class="text-muted">
                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $job->location }} | 
                            <i class="fas fa-dollar-sign mr-1"></i>{{ $job->salary }}
                        </small>
                    </div>
                    <span class="badge badge-{{ $job->status == 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst($job->status) }}
                    </span>
                </div>
                
                @if (!$job->applications->isEmpty())
                <div class="mt-3">
                    <h6><i class="fas fa-users mr-1"></i>Applicants ({{ $job->applications->count() }})</h6>
                    <ul class="list-unstyled">
                        <!-- Added inside the applicants list loop in the dashboard -->
@foreach ($job->applications as $application)
<li class="py-2 border-top">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <strong>{{ $application->name }}</strong> - {{ $application->email }}
        </div>
        <div class="d-flex align-items-center">
            <a href="#" class="view-resume mr-3" 
               data-resume-url="{{ route('viewResume', $application->id) }}"
               data-application-id="{{ $application->id }}">
                <i class="fas fa-file-alt mr-1"></i>View Resume
            </a>
            <form action="{{ route('applications.respond', $application->id) }}" method="POST">
    @csrf
    <input type="hidden" name="response" value="accepted">
    <button type="submit" class="btn btn-success btn-sm">Accept</button>
</form>
>
            <form action="{{ route('applications.respond', $application->id) }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="response" value="rejected">
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-times"></i> Reject
                </button>
            </form>
        </div>
    </div>
</li>
@endforeach

                    </ul>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>

    <!-- Resume Modal -->
    <div class="modal fade" id="resumeModal" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resumeModalLabel">
                        <i class="fas fa-file-alt mr-2"></i>Applicant Resume Analysis
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="resumeTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="resume-tab" data-toggle="tab" href="#resumeContent" role="tab">
                                <i class="fas fa-file-pdf mr-1"></i>Resume View
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="analysis-tab" data-toggle="tab" href="#analysisContent" role="tab">
                                <i class="fas fa-chart-bar mr-1"></i>AI Analysis
                            </a>
                        </li>
                    </ul>
                    
                    <!-- Tab Content -->
                    <div class="tab-content">
                        <!-- Resume View Tab -->
                        <div class="tab-pane fade show active" id="resumeContent" role="tabpanel">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe id="resumeIframe" class="embed-responsive-item" src="" frameborder="0"></iframe>
                            </div>
                        </div>
                        
                        <!-- Analysis Tab -->
                        <div class="tab-pane fade" id="analysisContent" role="tabpanel">
                            <div class="loading-spinner" id="analysisSpinner">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <p class="mt-2">Analyzing resume...</p>
                            </div>
                            <div id="resumeAnalysis" class="p-4">
                                <!-- Analysis content will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Close
                    </button>
                    <button type="button" class="btn btn-primary" id="downloadAnalysisBtn">
                        <i class="fas fa-download mr-1"></i>Download Report
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
    $(document).ready(function() {
        // Initialize CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize chat functionality
        initializeChat();

        // Initialize resume viewer
        initializeResumeViewer();

        // Load initial messages
        loadMessages();
    });

    // Chat Functions
    function initializeChat() {
        // Send message handler
        $('#send-button').on('click', sendMessage);
        
        // Allow sending message with Enter key
        $('#chat-message').on('keypress', function(e) {
            if (e.which === 13) {
                sendMessage();
            }
        });
    }

    function sendMessage() {
        const $messageInput = $('#chat-message');
        const message = $messageInput.val().trim();
        
        if (!message) return;

        // Show sending state
        const $sendButton = $('#send-button');
        $sendButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sending...');

        // Add message to chat immediately
        appendMessage(message, 'outgoing');
        $messageInput.val('');
        scrollChatToBottom();

        // Send to server
        $.post('/send-message', { message: message })
            .done(function(data) {
                if (!data.success) {
                    appendMessage("Error: " + (data.message || "Message not delivered"), 'error');
                }
            })
            .fail(function(xhr) {
                appendMessage("Error: " + (xhr.responseJSON?.message || "Failed to send message"), 'error');
            })
            .always(function() {
                $sendButton.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i>Send');
            });
    }

    function appendMessage(message, type) {
        const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const messageClass = type === 'outgoing' ? 'outgoing-message' : 
                           type === 'error' ? 'error-message' : 'incoming-message';
        
        $('#chat-box').append(`
            <div class="message ${messageClass}">
                <div class="message-content">${escapeHtml(message)}</div>
                <div class="message-time">${timestamp}</div>
            </div>
        `);
        scrollChatToBottom();
    }

    function loadMessages() {
        $('#chat-box').html('<div class="text-center py-3"><i class="fas fa-spinner fa-spin"></i> Loading messages...</div>');
        
        $.get('/get-messages')
            .done(function(messages) {
                $('#chat-box').empty();
                if (messages.length === 0) {
                    $('#chat-box').html('<div class="text-center py-3 text-muted">No messages yet</div>');
                    return;
                }
                
                messages.forEach(function(msg) {
                    appendMessage(msg.message, msg.type || 'incoming');
                });
            })
            .fail(function() {
                $('#chat-box').html('<div class="alert alert-danger">Failed to load messages</div>');
            });
    }

    // Resume Analysis Functions
    function initializeResumeViewer() {
    $(document).on('click', '.view-resume', function(e) {
        e.preventDefault();
        const applicationId = $(this).data('application-id');
        const resumeUrl = $(this).data('resume-url');
      
        // Show modal
        const modal = $('#resumeModal');
        modal.modal('show');
        
        // Load resume in iframe with error handling
        $('#resumeIframe').attr('src', ''); // Clear previous
        $('#resumeIframe').on('load', function() {
            // Check if content loaded successfully
            try {
                if (this.contentDocument.body.innerHTML.includes('Not Found') || 
                    this.contentDocument.body.innerHTML.includes('Error')) {
                    showResumeError("Failed to load resume document");
                }
            } catch (e) {
                // Cross-origin error handling
                console.log("Resume loaded (cross-origin check prevented)");
            }
        }).attr('src', resumeUrl);
        
        // Reset analysis tab
        $('#resumeAnalysis').html('');
        $('#analysisSpinner').show();
        
        // Switch to analysis tab after a brief delay
        setTimeout(() => {
            $('.nav-tabs a[href="#analysisContent"]').tab('show');
            analyzeResume(applicationId);
        }, 300);
    });
}

function showResumeError(message) {
    $('#resumeContent').html(`
        <div class="alert alert-danger m-3">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            ${escapeHtml(message)}
        </div>
    `);
}

    function analyzeResume(applicationId) {
        $.ajax({
            url: '/extract-resume-data/' + applicationId,
            method: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#analysisSpinner').show();
                $('#resumeAnalysis').html('');
            }
        })
        .done(function(response) {
            if (response.success) {
                displayResumeAnalysis(response.data);
            } else {
                showAnalysisError(response.message || "Analysis failed");
            }
        })
        .fail(function(xhr) {
            showAnalysisError(xhr.responseJSON?.message || "Server error occurred");
        })
        .always(function() {
            $('#analysisSpinner').hide();
        });
    }

    function displayResumeAnalysis(data) {
        const skillsHtml = data.skills?.length ? 
            data.skills.map(skill => `<span class="skill-badge">${escapeHtml(skill)}</span>`).join('') : 
            '<div class="text-muted">No skills detected</div>';

        const educationHtml = data.education?.length ? 
            `<ul class="list-unstyled">${data.education.map(edu => `<li>${escapeHtml(edu)}</li>`).join('')}</ul>` : 
            '<div class="text-muted">No education information detected</div>';

        $('#resumeAnalysis').html(`
            <div class="analysis-section">
                <h5><i class="fas fa-user-tie mr-2"></i>Candidate Profile</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> ${escapeHtml(data.name || 'Not detected')}</p>
                        <p><strong>Email:</strong> ${escapeHtml(data.email || 'Not detected')}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Phone:</strong> ${escapeHtml(data.phone || 'Not detected')}</p>
                        <p><strong>Experience:</strong> ${escapeHtml(data.experience || 'Not specified')}</p>
                    </div>
                </div>
            </div>
            
            <div class="analysis-section">
                <h5><i class="fas fa-graduation-cap mr-2"></i>Education</h5>
                ${educationHtml}
            </div>
            
            <div class="analysis-section">
                <h5><i class="fas fa-tools mr-2"></i>Skills</h5>
                <div class="skills-container">${skillsHtml}</div>
            </div>
            
            <div class="analysis-section">
                <h5><i class="fas fa-chart-pie mr-2"></i>Analysis Summary</h5>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle mr-2"></i>
                    This candidate has ${data.skills?.length || 0} detectable skills and 
                    ${data.education?.length || 0} education entries.
                </div>
            </div>
        `);
        
        // Enable download button
        $('#downloadAnalysisBtn').prop('disabled', false).off('click').on('click', function() {
            downloadAnalysisReport(data);
        });
    }

    function showAnalysisError(message) {
        $('#resumeAnalysis').html(`
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                ${escapeHtml(message)}
                <button class="btn btn-sm btn-warning mt-2" onclick="retryAnalysis()">
                    <i class="fas fa-sync-alt mr-1"></i>Try Again
                </button>
            </div>
        `);
    }

    function retryAnalysis() {
        const applicationId = $('.view-resume').data('application-id');
        if (applicationId) {
            $('#analysisSpinner').show();
            $('#resumeAnalysis').html('');
            analyzeResume(applicationId);
        }
    }

    function downloadAnalysisReport(data) {
        // In a real implementation, this would generate a PDF or downloadable file
        alert("In a complete implementation, this would download a report PDF with all the analysis data.");
        console.log("Analysis data for download:", data);
    }

    // Utility Functions
    function scrollChatToBottom() {
        const chatBox = $('#chat-box')[0];
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function escapeHtml(unsafe) {
        if (!unsafe) return '';
        return unsafe.toString()
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
    </script>
</body>
</html>