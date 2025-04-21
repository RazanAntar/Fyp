<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-color: #7e57c2;
            --primary-dark: #5e35b1;
            --light-blue: #e3f2fd;
            --background-color: #f4f7fc;
            --text-heading: #283593;
            --text-muted: #607d8b;
        }

        body {
            background: var(--background-color);
            font-family: 'Segoe UI', sans-serif;
            color: var(--text-heading);
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 8px rgba(126, 87, 194, 0.08);
            border-bottom: 2px solid var(--light-blue);
        }

        .navbar-brand img {
            height: 48px;
        }

        .header-buttons a {
            margin-right: 15px;
            font-weight: 600;
            border-radius: 8px;
        }

        h2 {
            color: var(--text-heading);
            margin-bottom: 2rem;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(126, 87, 194, 0.1);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .card-text {
            color: var(--text-muted);
        }

        .list-group-item {
            border: none;
            border-radius: 12px;
            background: var(--light-blue);
            margin-bottom: 10px;
        }

        .btn-sm {
            border-radius: 8px;
            padding: 6px 12px;
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .modal-content {
            border-radius: 16px;
            overflow: hidden;
        }

        .nav-tabs .nav-link {
            color: var(--primary-color);
            font-weight: 600;
        }

        .nav-tabs .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .badge-info {
            background-color: #d1c4e9;
            color: #512da8;
            border-radius: 20px;
            padding: 5px 10px;
        }

        .embed-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        .applicant-name {
            font-weight: 600;
            cursor: pointer;
            color: var(--primary-color);
        }

        .applicant-name:hover {
            text-decoration: underline;
        }

        .modal-footer {
            background: #f5f5f5;
        }
        .applicant-name:hover {
    text-decoration: underline;
}

.view-resume:hover {
    color: #5e35b1;
    text-decoration: none;
}

.bg-white {
    background-color: #fff !important;
}

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light px-4">
    <a class="navbar-brand" href="{{ route('welcome') }}">
        <img src="{{ asset('images/logos/rhu-logo.png') }}" alt="RHU Logo">
    </a>
    <div class="ml-auto header-buttons">
        <a href="{{ route('professional.post_job.form') }}" class="btn btn-outline-primary">
            <i class="fas fa-briefcase mr-1"></i> Post Job
        </a>
        <a href="{{ route('events.create') }}" class="btn btn-outline-secondary">
            <i class="fas fa-calendar-alt mr-1"></i> Create Event
        </a>
        <a href="{{ route('professional.chats') }}" class="btn btn-outline-success">
            <i class="fas fa-comments mr-1"></i> Chat
        </a>
        <a href="{{ route('professional.myEvents') }}" class="dropdown-item">
    <i class="fas fa-calendar-check mr-2"></i> My Hosted Events
</a>

    </div>
</nav>

<div class="row">
    @foreach ($jobs as $job)
        <div class="col-lg-6 mb-5">
            <div class="shadow-sm bg-white p-4 rounded-lg border border-light" style="border-radius: 20px;">
                <!-- Job Info -->
                <div class="mb-3">
                    <small class="text-uppercase font-weight-bold" style="color: #7e57c2;">{{ strtoupper($job->category ?? 'Job') }}</small>
                    <h4 class="font-weight-bold text-dark mt-1">{{ $job->title }}</h4>
                    <p class="mb-1 text-muted">{{ $job->description }}</p>
                    <p class="mb-1 text-muted"><i class="fas fa-map-marker-alt mr-1"></i>{{ $job->location }}</p>
                    <p class="mb-1 text-muted"><i class="fas fa-dollar-sign mr-1"></i>{{ $job->salary }}</p>
                    <span class="badge badge-{{ $job->status == 'active' ? 'success' : 'secondary' }}">{{ ucfirst($job->status) }}</span>
                </div>

                <!-- Applicants Section -->
                <div>
                    <h6 class="text-muted mb-3"><i class="fas fa-users mr-1"></i>Applicants ({{ $job->applications->count() }})</h6>
                    <div class="row">
                        @foreach ($job->applications as $application)
                            <div class="col-md-12 mb-3">
                                <div class="p-3 border rounded bg-light">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        <div>
                                            <span class="applicant-name font-weight-bold text-primary" style="cursor:pointer;"
                                                  data-name="{{ $application->name }}"
                                                  data-type="{{ $application->student->user_type ?? 'Unknown' }}"
                                                  data-experience='@json($application->student->experiences)'>
                                                {{ $application->name }} ({{ $application->email }})
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center mt-2 mt-sm-0">
                                            <a href="#"
                                               class="btn btn-sm btn-outline-primary mr-2 view-resume"
                                               data-resume-url="{{ route('viewResume', $application->id) }}"
                                               data-application-id="{{ $application->id }}">
                                                <i class="fas fa-file-alt mr-1"></i> View Resume
                                            </a>

                                            <form action="{{ route('applications.respond', $application->id) }}" method="POST" class="mr-2">
                                                @csrf
                                                <input type="hidden" name="response" value="accepted">
                                                <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                            </form>

                                            <form action="{{ route('applications.respond', $application->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="response" value="rejected">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if ($job->applications->isEmpty())
                            <div class="col-12 text-muted">
                                No applicants yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


<!-- Modals -->
<div class="modal fade" id="applicantModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Applicant Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <span id="modalName"></span></p>
                <p><strong>User Type:</strong> <span id="modalType"></span></p>
                <div id="modalExperience"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="resumeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-file-alt mr-2"></i>Applicant Resume Analysis</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body p-0">
                <ul class="nav nav-tabs" id="resumeTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#resumeContent" role="tab">Resume View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#analysisContent" role="tab">AI Analysis</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="resumeContent" role="tabpanel">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe id="resumeIframe" class="embed-responsive-item" src="" frameborder="0"></iframe>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="analysisContent" role="tabpanel">
                        <div class="p-4" id="resumeAnalysis">
                            <div class="spinner-border text-primary" role="status" id="analysisSpinner">
                                <span class="sr-only">Analyzing resume...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="downloadAnalysisBtn">Download Report</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).on('click', '.applicant-name', function () {
        const name = $(this).data('name');
        const type = $(this).data('type');
        const experience = $(this).data('experience');

        $('#modalName').text(name);
        $('#modalType').text(type);

        let html = '<strong>Experience:</strong><ul>';
        if (experience && experience.length > 0) {
            experience.forEach(exp => {
                html += `<li><b>${exp.title}</b> at ${exp.company || 'N/A'} (${exp.start_date} to ${exp.is_current ? 'Present' : exp.end_date})</li>`;
            });
        } else {
            html += '<li>No experience available</li>';
        }
        html += '</ul>';
        $('#modalExperience').html(html);
        $('#applicantModal').modal('show');
    });

    $(document).on('click', '.view-resume', function (e) {
        e.preventDefault();
        const resumeUrl = $(this).data('resume-url');
        const applicationId = $(this).data('application-id');

        $('#resumeIframe').attr('src', resumeUrl);
        $('#resumeAnalysis').html('');
        $('#analysisSpinner').show();
        $('#resumeModal').modal('show');

        setTimeout(() => {
            $('.nav-tabs a[href="#analysisContent"]').tab('show');
            analyzeResume(applicationId);
        }, 300);
    });

    function analyzeResume(applicationId) {
        $.ajax({
            url: '/extract-resume-data/' + applicationId,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#analysisSpinner').hide();
                if (response.success) {
                    displayResumeAnalysis(response.data);
                } else {
                    $('#resumeAnalysis').html(`<div class="alert alert-danger">${response.message}</div>`);
                }
            },
            error: function () {
                $('#resumeAnalysis').html(`<div class="alert alert-danger">Error analyzing resume</div>`);
                $('#analysisSpinner').hide();
            }
        });
    }

    function displayResumeAnalysis(data) {
        const skills = data.skills?.length
            ? data.skills.map(s => `<span class="badge badge-info mr-1 mb-1">${s}</span>`).join('')
            : 'No skills found';

        const education = data.education?.length
            ? '<ul>' + data.education.map(e => `<li>${e}</li>`).join('') + '</ul>'
            : 'No education listed';

        $('#resumeAnalysis').html(`
            <h5>Candidate Info</h5>
            <p><strong>Name:</strong> ${data.name || 'N/A'}</p>
            <p><strong>Email:</strong> ${data.email || 'N/A'}</p>
            <p><strong>Phone:</strong> ${data.phone || 'N/A'}</p>
            <p><strong>Experience:</strong> ${data.experience || 'N/A'}</p>
            <h5>Skills</h5>
            <div>${skills}</div>
            <h5>Education</h5>
            <div>${education}</div>
        `);

        $('#downloadAnalysisBtn').prop('disabled', false).off('click').on('click', function () {
            alert("This would download the analysis as a PDF in a full implementation.");
        });
    }
</script>
</body>
</html>
