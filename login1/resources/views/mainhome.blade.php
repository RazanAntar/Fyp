<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Career Network</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --navy-blue: #001f3f;
            --accent-blue: #0d6efd;
            --light-blue: #e7f1ff;
        }
        
        /* Header Styles */
        .university-header {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1020;
        }
        
        .logo-img {
            height: 50px;
            width: auto;
        }
        
        /* Hero Section Styles */
        .hero-container {
            height: 70vh;
            min-height: 500px;
        }
        
        .hero-image {
            transition: opacity 0.4s ease;
            opacity: 1;
        }
        
        .hero-image.default {
            background-image: url('{{ asset("images/logos/alumni-hover.jpeg") }}');
            opacity: 1;
        }
        
        .hero-image.student {
            background-image: url('{{ asset("images/logos/students-hover.jpeg") }}');
            opacity: 0;
        }
        
        .hero-image.company {
            background-image: url('{{ asset("images/logos/companies-hover.jpeg") }}');
            opacity: 0;
        }
        
        .hero-overlay {
            background: rgba(0, 31, 63, 0.5);
        }
        
        .selector-btn:hover {
            background-color: var(--navy-blue) !important;
            border-color: var(--navy-blue) !important;
            transform: translateY(-3px);
        }
        
        .selector-btn.active {
            background-color: var(--navy-blue) !important;
            border-color: var(--navy-blue) !important;
            color: white !important;
            transform: translateY(-3px);
        }
        
        #hero-btn {
            background-color: white;
            color: var(--navy-blue);
            border: 2px solid white;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        #hero-btn:hover {
            background-color: var(--navy-blue) !important;
            border-color: var(--navy-blue) !important;
            color: white !important;
            transform: translateY(-2px);
        }

        .bg-gradient-overlay {
        background: linear-gradient(to top, rgba(0,31,63,0.8) 0%, rgba(0,31,63,0) 100%);
    }
    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }
    .rounded-4 {
        border-radius: 1rem !important;
    }
        
           
        /* Footer Styles */
        .footer {
            background-color: var(--navy-blue);
            color: white;
            padding: 3rem 0;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-icons a {
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            background: var(--accent-blue);
            transform: translateY(-3px);
        }
        
        @media (max-width: 768px) {
            .hero-container {
                height: 80vh;
            }
            
            .platform-section {
                padding: 3rem 0;
            }
        }
    </style>

    <!-- Quiz Styles -->
<style>
/* Quiz Container Styles */
#quiz-container {
    min-height: 500px;
    position: relative;
}

.progress {
    height: 10px;
    border-radius: 5px;
    background-color: #f0f4f8;
    margin-bottom: 2rem;
}

.progress-bar {
    transition: width 0.5s ease;
    background: linear-gradient(90deg, #4f46e5, #7c3aed);
    border-radius: 5px;
}

/* Question Styles */
.question-card {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 1.5rem;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.question-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.question-category {
    color: #7c3aed;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    font-size: 0.8rem;
    margin-bottom: 0.5rem;
}

.question-text {
    font-size: 1.4rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 1.5rem;
    line-height: 1.4;
}

/* Option Styles */
.option-item {
    display: block;
    position: relative;
    padding: 1rem 1rem 1rem 3rem;
    margin-bottom: 0.75rem;
    border-radius: 8px;
    border: 2px solid #e2e8f0;
    cursor: pointer;
    transition: all 0.2s ease;
}

.option-item:hover {
    border-color: #a5b4fc;
    background-color: #f8fafc;
}

.option-item.selected {
    border-color: #6366f1;
    background-color: #eef2ff;
}

.option-input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.option-checkbox {
    position: absolute;
    top: 1.1rem;
    left: 1rem;
    height: 1.25rem;
    width: 1.25rem;
    background-color: white;
    border: 2px solid #cbd5e0;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.option-radio {
    position: absolute;
    top: 1.1rem;
    left: 1rem;
    height: 1.25rem;
    width: 1.25rem;
    background-color: white;
    border: 2px solid #cbd5e0;
    border-radius: 50%;
    transition: all 0.2s ease;
}

.option-item input:checked ~ .option-checkbox {
    background-color: #6366f1;
    border-color: #6366f1;
}

.option-item input:checked ~ .option-radio {
    border-color: #6366f1;
}

.option-item input:checked ~ .option-radio::after {
    content: "";
    position: absolute;
    top: 3px;
    left: 3px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #6366f1;
}

.option-label {
    font-size: 1.05rem;
    color: #4a5568;
    font-weight: 500;
}

/* Button Styles */
.quiz-btn {
    padding: 0.8rem 1.8rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
}

.btn-outline-secondary {
    border: 2px solid #cbd5e0;
    color: #4a5568;
}

.btn-outline-secondary:hover {
    background-color: #f8fafc;
    border-color: #a5b4fc;
    color: #4a5568;
}

.btn-success {
    background: linear-gradient(135deg, #10b981, #34d399);
    border: none;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
}

/* Quiz Intro Styles */
.quiz-intro {
    padding: 2rem;
    text-align: center;
}

.quiz-icon {
    height: 120px;
    margin-bottom: 1.5rem;
    filter: drop-shadow(0 5px 10px rgba(99, 102, 241, 0.2));
}

.intro-features {
    text-align: left;
    display: inline-block;
    margin: 1.5rem 0;
}

.intro-features li {
    padding: 0.5rem 0;
    font-size: 1.05rem;
}

.intro-features i {
    color: #6366f1;
    margin-right: 0.75rem;
}

/* Results Styles */
.results-container {
    padding: 2rem;
}

.results-icon {
    height: 120px;
    margin-bottom: 1.5rem;
    filter: drop-shadow(0 5px 10px rgba(16, 185, 129, 0.2));
}

.results-summary {
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 2rem;
    padding: 0 1rem;
}

.career-card {
    border-radius: 12px;
    overflow: hidden;
    border: none;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.career-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.career-card.best-match {
    border: 2px solid #6366f1;
    position: relative;
}

.best-match-badge {
    position: absolute;
    top: -12px;
    right: 20px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: white;
    padding: 0.25rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.8rem;
    box-shadow: 0 3px 10px rgba(99, 102, 241, 0.3);
}

.match-badge {
    background: linear-gradient(135deg, #10b981, #34d399);
    color: white;
    padding: 0.25rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.8rem;
    display: inline-block;
    margin-bottom: 1rem;
}

.career-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
}

.career-description {
    color: #4a5568;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.learn-more-btn {
    background: white;
    color: #6366f1;
    border: 2px solid #e0e7ff;
    font-weight: 600;
    width: 100%;
}

.learn-more-btn:hover {
    background: #eef2ff;
    color: #6366f1;
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(99, 102, 241, 0.2);
}

/* Navigation Buttons */
.nav-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
}

/* No Answers Styling */
#no-answers-container {
    background-color: #fff8f8;
    border-radius: 0.5rem;
    margin: 1.5rem;
}

#no-answers-container .text-warning {
    color: #ffc107 !important;
}

/* Results Container Transition */
.results-container {
    transition: all 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    #quiz-container {
        min-height: 400px;
    }
    
    .question-text {
        font-size: 1.2rem;
    }
    
    .option-label {
        font-size: 1rem;
    }
    
    .quiz-btn {
        padding: 0.7rem 1.5rem;
        font-size: 0.9rem;
    }
    
    .nav-buttons {
        flex-direction: column;
        gap: 1rem;
    }
    
    .nav-buttons button {
        width: 100%;
    }
    
    .career-card {
        margin-bottom: 1.5rem;
    }
}
</style>
</head>
<body class="bg-light">
    <!-- University Header -->
    <header class="university-header bg-white py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <img src="{{ asset('images/logos/university-logo.png') }}" alt="University Logo" class="logo-img">
                </div>
               
            </div>
        </div>
    </header>

    <!-- Hero Section (Your existing section) -->
    <div class="hero-container position-relative overflow-hidden">
        <!-- Background Images -->
        <div class="hero-image default position-absolute top-0 start-0 w-100 h-100 bg-cover bg-center"></div>
        <div class="hero-image student position-absolute top-0 start-0 w-100 h-100 bg-cover bg-center"></div>
        <div class="hero-image company position-absolute top-0 start-0 w-100 h-100 bg-cover bg-center"></div>
        
        <!-- Content Overlay -->
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center text-white p-5">
            <h1 class="display-3 fw-semibold mb-4 lh-1 text-shadow" id="hero-title">I am an Alumnus</h1>
            <p class="fs-3 mb-5 w-75 mx-auto text-shadow" id="hero-description">Fill your profile and join the network</p>
            <a href="#" class="btn fw-bold px-5 py-2" id="hero-btn">ACCESS YOUR ACCOUNT</a>
        </div>
        
        <!-- Selector Buttons -->
        <div class="position-absolute bottom-0 start-0 w-100 d-flex justify-content-center gap-3 p-4 z-3 flex-wrap">
            <div class="selector-btn btn btn-outline-light rounded-1 border-2 px-4 py-2 fw-bold text-uppercase active" data-target="alumni">ALUMNI</div>
            <div class="selector-btn btn btn-outline-light rounded-1 border-2 px-4 py-2 fw-bold text-uppercase" data-target="student">STUDENTS</div>
            <div class="selector-btn btn btn-outline-light rounded-1 border-2 px-4 py-2 fw-bold text-uppercase" data-target="company">COMPANIES</div>
        </div>
    </div>

<!-- Platform Impact Section -->
<section class="py-6 position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <!-- Decorative circles -->
    <div class="position-absolute top-0 end-0">
        <div class="bg-primary bg-opacity-10 rounded-circle" style="width: 300px; height: 300px; transform: translate(30%, -30%);"></div>
    </div>
    <div class="position-absolute bottom-0 start-0">
        <div class="bg-warning bg-opacity-10 rounded-circle" style="width: 400px; height: 400px; transform: translate(-30%, 30%);"></div>
    </div>

    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-white p-5 rounded-4 shadow-lg">
                    <div class="row align-items-center">
                        <!-- Left Column -->
                        <div class="col-lg-5 mb-4 mb-lg-0">
                            <span class="badge bg-primary bg-opacity-10 mb-3" style="color: #003865;">PLATFORM IMPACT</span>
                            <h2 class="display-6 fw-bold mb-4">Transforming Career Journeys</h2>

                            <!-- Metric 1 -->
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                                        <i class="fas fa-rocket fs-4" style="color: #003865;"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="mb-0" style="color: #003865;">500+</h3>
                                    <p class="small mb-0">Active Companies</p>
                                </div>
                            </div>

                            <!-- Metric 2 -->
                            <div class="d-flex mb-3">
                                <div class="me-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px;">
                                        <i class="fas fa-user-graduate fs-4" style="color: #003865;"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1" style="color: #003865;">3x More Interviews</h5>
                                    <p class="text-muted small mb-0">Students secure more interviews through our network</p>
                                </div>
                            </div>

                            <!-- Button -->
                            <a href="#" class="btn mt-3 px-4 py-2" style="background-color: #003865; color: #fff;">
                                See Success Metrics <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>

                        <!-- Right Column -->
                        <div class="col-lg-7">
                            <div class="ps-lg-5">
                                <!-- Image Card -->
                                <div class="card border-0 overflow-hidden rounded-4 mb-4">
                                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                                         alt="Successful team" 
                                         class="img-fluid">
                                    <div class="card-img-overlay d-flex align-items-end bg-gradient-overlay">
                                        <div class="text-white">
                                            <h5 class="mb-1">Featured Success Story</h5>
                                            <p class="small mb-0">How Maria landed her dream job at TechCorp</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Summary Metrics -->
                                <div class="d-flex justify-content-between">
                                    <div class="text-center">
                                        <h3 class="mb-0" style="color: #003865;">500+</h3>
                                        <p class="small mb-0">Active Companies</p>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="mb-0" style="color: #003865;">85%</h3>
                                        <p class="small mb-0">Placement Rate</p>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="mb-0" style="color: #003865;">4.8★</h3>
                                        <p class="small mb-0">User Satisfaction</p>
                                    </div>
                                </div>
                                <!-- End Summary Metrics -->
                            </div>
                        </div>
                        <!-- End Right Column -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Career Path Quiz Section -->
<section class="py-6 bg-gradient-to-b from-gray-50 to-white">
    <div class="container">
    <div class="row justify-content-center" style="margin-top: 100px">  <!-- custom pixel value -->
    <div class="col-lg-8 text-center mb-5">
        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 mb-3 rounded-pill">CAREER DISCOVERY</span>
        <h2 class="display-5 fw-bold mb-3">Discover Your Ideal Career Path</h2>
        <p class="lead text-muted">Take our quick 5-minute quiz to uncover careers perfectly aligned with your unique skills, interests, and personality.</p>
    </div>
</div>
<!-- Quiz Container -->
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
            <div class="card-body p-4 p-md-5">
                <div id="quiz-container">
                    <!-- Enhanced Quiz Intro Screen -->
                    <div id="quiz-intro" class="text-center p-5 rounded-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                        <div class="mb-5">
                            <div class="icon-container mx-auto mb-4" style="width: 100px; height: 100px; background-color: #6a4c7d; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 20px rgba(106, 76, 125, 0.3);">
                                <i class="fas fa-clipboard-check text-white" style="font-size: 2.5rem;"></i>
                            </div>
                            <h3 class="fw-bold mb-3" style="font-size: 2rem; color: #2d3748;">Discover Your Career Match</h3>
                            <p class="text-muted mb-4" style="font-size: 1.1rem;">This personalized assessment will match you with careers that fit:</p>
                            
                            <div class="feature-grid mx-auto" style="max-width: 500px;">
                                <div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background-color: rgba(106, 76, 125, 0.08); border-left: 4px solid #6a4c7d;">
                                    <div class="me-3" style="width: 32px; height: 32px; background-color: #6a4c7d; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-graduation-cap text-white" style="font-size: 0.9rem;"></i>
                                    </div>
                                    <span style="font-weight: 500; color: #2d3748;">Academic background</span>
                                </div>
                                
                                <div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background-color: rgba(106, 76, 125, 0.08); border-left: 4px solid #6a4c7d;">
                                    <div class="me-3" style="width: 32px; height: 32px; background-color: #6a4c7d; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-lightbulb text-white" style="font-size: 0.9rem;"></i>
                                    </div>
                                    <span style="font-weight: 500; color: #2d3748;">Skills & strengths</span>
                                </div>
                                
                                <div class="d-flex align-items-center p-3 mb-3 rounded-3" style="background-color: rgba(106, 76, 125, 0.08); border-left: 4px solid #6a4c7d;">
                                    <div class="me-3" style="width: 32px; height: 32px; background-color: #6a4c7d; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-heart text-white" style="font-size: 0.9rem;"></i>
                                    </div>
                                    <span style="font-weight: 500; color: #2d3748;">Personal interests</span>
                                </div>
                                
                                <div class="d-flex align-items-center p-3 rounded-3" style="background-color: rgba(106, 76, 125, 0.08); border-left: 4px solid #6a4c7d;">
                                    <div class="me-3" style="width: 32px; height: 32px; background-color: #6a4c7d; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-briefcase text-white" style="font-size: 0.9rem;"></i>
                                    </div>
                                    <span style="font-weight: 500; color: #2d3748;">Work environment</span>
                                </div>
                            </div>
                        </div>
                        
                        <button id="start-quiz" class="btn btn-lg px-5 py-3 fw-bold mt-4" style="background-color: #6a4c7d; border: none; color: white; box-shadow: 0 8px 20px rgba(106, 76, 125, 0.3); transition: all 0.3s ease;">
                            Begin Your Assessment <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>

                    <!-- Quiz questions (initially hidden) -->
                    <div id="quiz-questions" style="display: none;">
                        <div class="progress">
                            <div id="quiz-progress" class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                        
                        <div class="question-card">
                            <h4 id="question-category" class="question-category"></h4>
                            <h3 id="question-text" class="question-text"></h3>
                            <div id="question-options" class="mb-4"></div>
                        </div>
                        
                        <div class="nav-buttons">
                            <button id="prev-question" class="btn btn-outline-secondary quiz-btn" disabled>
                                <i class="fas fa-arrow-left me-2"></i>Previous
                            </button>
                            <div>
                                <button id="next-question" class="btn btn-primary quiz-btn">
                                    Next<i class="fas fa-arrow-right ms-2"></i>
                                </button>
                                <button id="submit-quiz" class="btn btn-success quiz-btn" style="display: none;">
                                    Get Results<i class="fas fa-chart-bar ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quiz results (initially hidden) -->
                    <div id="quiz-results" style="display: none;">
                        <div class="results-container text-center">
                            <div class="mb-4">
                                <img src="{{ asset('images/logos/results-icon.png') }}" alt="Results" class="results-icon">
                            </div>
                            <h3 class="mb-3 fw-bold">Your Personalized Career Recommendations</h3>
                            <p class="results-summary" id="results-summary"></p>
                        </div>
                        
                        <div id="career-results" class="row g-4"></div>
                        
                        <div class="text-center mt-5 pt-3">
                            <button id="retake-quiz" class="btn btn-outline-primary me-3 quiz-btn">
                                <i class="fas fa-redo me-2"></i>Retake Quiz
                            </button>
                            <button id="save-results" class="btn btn-primary quiz-btn">
                                <i class="fas fa-save me-2"></i>Save to Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Enhanced Call-to-Action Section with Proper Routing -->
<!-- Full Call-to-Action Section with #dde7f4 Background -->
<section class="cta-section py-6 position-relative overflow-hidden" style="background-color: #dde7f4;">
    <div class="container position-relative z-2">
        <div class="row align-items-center">
            <!-- Left Column: CTA Text -->
            <div class="col-lg-7 mb-5 mb-lg-0">
                <span class="badge bg-white text-primary rounded-pill px-4 py-2 mb-3 d-inline-flex align-items-center">
                    <i class="fas fa-rocket me-2"></i> TAKE THE NEXT STEP
                </span>
                <h2 class="display-5 fw-bold text-dark mb-4">Ready to Launch Your Career?</h2>
                <p class="lead text-muted mb-4">Join our network of 25,000+ students and alumni who have accelerated their careers through our platform.</p>
                
                
            </div>

            <!-- Right Column: Registration Card -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="card-body p-5">
                        <h5 class="fw-bold mb-4 text-center text-dark">Get Started in 30 Seconds</h5>

                <!-- Buttons -->
<div class="d-grid gap-3">
    <a href="{{ route('welcome') }}" class="btn btn-lg py-3 fw-bold" style="background-color: #462755; color: #fff;">
        <i class="fas fa-user-graduate me-2"></i> Student Registration
    </a>
    <a href="{{ route('alumni.home') }}" class="btn btn-lg py-3 fw-bold" style="border: 2px solid #003865; color: #003865; background-color: transparent;">
        <i class="fas fa-user-tie me-2"></i> Alumni Registration
    </a>
</div>



                        <!-- Avatar Group -->
                        <div class="d-flex align-items-center mt-4">
                            <div class="flex-shrink-0">
                                <div class="position-relative">
                                    <div class="avatar-group d-flex">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-1" alt="User" style="width: 40px; height: 40px;">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-1" alt="User" style="width: 40px; height: 40px;">
                                        <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle" alt="User" style="width: 40px; height: 40px;">
                                    </div>
                                </div>
                            </div>
                            <div class="ms-3">
                                <p class="small mb-0 text-muted">Join our community of professionals</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Right Column -->
        </div>
    </div>
</section>


<style>
 
    
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid white;
        object-fit: cover;
    }
    
    .avatar-group {
        display: flex;
    }
    
    .avatar-group .avatar {
        margin-left: -15px;
    }
    
    .avatar-group .avatar:first-child {
        margin-left: 0;
    }
    
    .text-white-80 {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .rounded-3 {
        border-radius: 1rem !important;
    }
    
    .z-1 {
        z-index: 1;
    }
    
    .z-2 {
        z-index: 2;
    }

    .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background-color: rgba(13, 110, 253, 0.1);
}
</style>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-4">University Career Network</h5>
                    <p>Connecting talent with opportunity since 1999</p>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Quick Links</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="#">About Us</a></li>
                        <li class="mb-2"><a href="#">Services</a></li>
                        <li class="mb-2"><a href="#">Resources</a></li>
                        <li class="mb-2"><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="mb-4">Legal</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="#">Privacy Policy</a></li>
                        <li class="mb-2"><a href="#">Terms of Service</a></li>
                        <li class="mb-2"><a href="#">Cookie Policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="mb-4">Contact Us</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Rafik Hariri University, Lebanon, Mechref</p>
                    <p><i class="fas fa-phone me-2"></i> +123 456 7890</p>
                    <p><i class="fas fa-envelope me-2"></i> careers@university.edu</p>
                </div>
            </div>
            <hr class="my-4 bg-light opacity-10">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 University Career Network. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Your existing JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.selector-btn');
            const images = {
                alumni: document.querySelector('.hero-image.default'),
                student: document.querySelector('.hero-image.student'),
                company: document.querySelector('.hero-image.company')
            };
            const title = document.getElementById('hero-title');
            const description = document.getElementById('hero-description');
            const accessBtn = document.getElementById('hero-btn');
            
            // Route URLs
            const routes = {
                alumni: "{{ route('alumni.home') }}",
                student: "{{ route('welcome') }}",
                company: "{{ route('home') }}"
            };
            
            // Content for each section
            const content = {
                alumni: {
                    title: "I am an Alumnus",
                    description: "Fill your profile and join the network"
                },
                student: {
                    title: "I am a Student",
                    description: "Fill your profile and join the network"
                },
                company: {
                    title: "I am a Recruiter",
                    description: "Meet our alumni and post your job offers"
                }
            };
            
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    // Remove active class from all buttons
                    buttons.forEach(btn => {
                        btn.classList.remove('active');
                    });
                    
                    // Add active class to current button
                    this.classList.add('active');
                    
                    // Get target section
                    const target = this.getAttribute('data-target');
                    
                    // Hide all images
                    Object.values(images).forEach(img => img.style.opacity = 0);
                    
                    // Show target image
                    images[target].style.opacity = 1;
                    
                    // Update content
                    title.textContent = content[target].title;
                    description.textContent = content[target].description;
                    accessBtn.href = routes[target];
                });
                
                // Optional click handler
                button.addEventListener('click', function() {
                    const target = this.getAttribute('data-target');
                    window.location.href = routes[target];
                });
            });
        });

        
    </script>

   <!-- Quiz Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quiz data structure
    const quizData = {
        questions: [
            // Major/Field of Study
            {
                category: "Academic Background",
                text: "What is your major or primary field of study?",
                options: [
                    { text: "Engineering (all disciplines)", value: "engineering" },
                    { text: "Computer Science/IT", value: "cs_it" },
                    { text: "Business/Finance/Economics", value: "business" },
                    { text: "Natural Sciences (Biology, Chemistry, Physics)", value: "sciences" },
                    { text: "Social Sciences (Psychology, Sociology, etc.)", value: "social_sciences" },
                    { text: "Arts/Humanities", value: "arts" },
                    { text: "Health Sciences/Medicine", value: "health" }
                ],
                type: "single"
            },
            
            // Skills
            {
                category: "Skills",
                text: "Which of these skills do you excel at? (Select all that apply)",
                options: [
                    { text: "Analytical thinking", value: "analytical" },
                    { text: "Creative problem solving", value: "creative" },
                    { text: "Communication and public speaking", value: "communication" },
                    { text: "Leadership and teamwork", value: "leadership" },
                    { text: "Technical/computer skills", value: "technical" },
                    { text: "Research and data analysis", value: "research" },
                    { text: "Artistic/design skills", value: "artistic" }
                ],
                type: "multiple"
            },
            
            // Interests
            {
                category: "Interests",
                text: "What types of activities interest you most?",
                options: [
                    { text: "Building or creating things", value: "building" },
                    { text: "Solving complex problems", value: "solving" },
                    { text: "Helping or teaching others", value: "helping" },
                    { text: "Analyzing data or research", value: "analyzing" },
                    { text: "Designing or artistic expression", value: "designing" },
                    { text: "Leading or managing projects", value: "leading" }
                ],
                type: "single"
            },
            
            // Work Environment
            {
                category: "Work Preferences",
                text: "What kind of work environment do you prefer?",
                options: [
                    { text: "Structured and predictable", value: "structured" },
                    { text: "Dynamic and fast-paced", value: "dynamic" },
                    { text: "Creative and flexible", value: "creative_env" },
                    { text: "Independent and self-directed", value: "independent" },
                    { text: "Collaborative team-based", value: "collaborative" }
                ],
                type: "single"
            },
            
            // Values
            {
                category: "Career Values",
                text: "What's most important to you in a career?",
                options: [
                    { text: "High earning potential", value: "earnings" },
                    { text: "Work-life balance", value: "balance" },
                    { text: "Opportunities for advancement", value: "advancement" },
                    { text: "Making a positive impact", value: "impact" },
                    { text: "Intellectual challenge", value: "challenge" },
                    { text: "Creative freedom", value: "freedom" }
                ],
                type: "single"
            }
        ],
        
        // Career matching logic
        careers: [
            {
                title: "Software Engineer",
                description: "Design, develop, and test software systems. Work in tech companies, startups, or as a freelancer.",
                matchCriteria: ["cs_it", "engineering", "technical", "building", "solving", "dynamic", "earnings", "challenge"],
                image: "software-engineer.jpg"
            },
            {
                title: "Data Scientist",
                description: "Analyze complex data to help organizations make decisions. Work in tech, finance, healthcare, etc.",
                matchCriteria: ["cs_it", "engineering", "analytical", "research", "analyzing", "structured", "challenge"],
                image: "data-scientist.jpg"
            },
            {
                title: "Financial Analyst",
                description: "Evaluate financial data to guide business decisions. Work in banks, corporations, or investment firms.",
                matchCriteria: ["business", "analytical", "research", "structured", "earnings", "advancement"],
                image: "financial-analyst.jpg"
            },
            {
                title: "Marketing Manager",
                description: "Develop strategies to promote products/services. Work in agencies or corporate marketing departments.",
                matchCriteria: ["business", "communication", "creative", "leading", "dynamic", "collaborative"],
                image: "marketing-manager.jpg"
            },
            {
                title: "Biomedical Researcher",
                description: "Conduct research to improve human health. Work in labs, universities, or pharmaceutical companies.",
                matchCriteria: ["health", "sciences", "research", "analyzing", "impact", "challenge"],
                image: "biomedical-researcher.jpg"
            },
            {
                title: "UX Designer",
                description: "Create user-friendly digital experiences. Work in tech companies or design agencies.",
                matchCriteria: ["cs_it", "artistic", "designing", "creative_env", "freedom", "collaborative"],
                image: "ux-designer.jpg"
            },
            {
                title: "Social Worker",
                description: "Help individuals and communities overcome challenges. Work in nonprofits or government agencies.",
                matchCriteria: ["social_sciences", "helping", "communication", "impact", "balance"],
                image: "social-worker.jpg"
            },
            {
                title: "Management Consultant",
                description: "Advise organizations on strategy and operations. Work for consulting firms or as an independent consultant.",
                matchCriteria: ["business", "analytical", "communication", "leading", "dynamic", "advancement"],
                image: "management-consultant.jpg"
            }
        ]
    };

    // Quiz state
    let currentQuestion = 0;
    let answers = {};
    let selectedOptions = [];
    
    // DOM elements
    const quizIntro = document.getElementById('quiz-intro');
    const quizQuestions = document.getElementById('quiz-questions');
    const quizResults = document.getElementById('quiz-results');
    const startQuizBtn = document.getElementById('start-quiz');
    const prevQuestionBtn = document.getElementById('prev-question');
    const nextQuestionBtn = document.getElementById('next-question');
    const submitQuizBtn = document.getElementById('submit-quiz');
    const retakeQuizBtn = document.getElementById('retake-quiz');
    const saveResultsBtn = document.getElementById('save-results');
    const questionCategory = document.getElementById('question-category');
    const questionText = document.getElementById('question-text');
    const questionOptions = document.getElementById('question-options');
    const quizProgress = document.getElementById('quiz-progress');
    const resultsSummary = document.getElementById('results-summary');
    const careerResults = document.getElementById('career-results');
    
    // Start quiz
    startQuizBtn.addEventListener('click', function() {
        quizIntro.style.display = 'none';
        quizQuestions.style.display = 'block';
        showQuestion(currentQuestion);
    });
    
    // Show question
    function showQuestion(index) {
        const question = quizData.questions[index];
        
        // Update progress bar
        const progress = ((index + 1) / quizData.questions.length) * 100;
        quizProgress.style.width = `${progress}%`;
        
        // Update question elements
        questionCategory.textContent = question.category;
        questionText.textContent = question.text;
        questionOptions.innerHTML = '';
        
        // Create options
        question.options.forEach((option, i) => {
            const optionElement = document.createElement('label');
            optionElement.className = 'option-item';
            
            const inputType = question.type === 'single' ? 'radio' : 'checkbox';
            const inputName = question.type === 'single' ? 'quizOption' : `quizOption-${i}`;
            
            optionElement.innerHTML = `
                <input class="option-input" type="${inputType}" name="${inputName}" value="${option.value}">
                ${question.type === 'single' ? 
                    '<span class="option-radio"></span>' : 
                    '<span class="option-checkbox"></span>'}
                <span class="option-label">${option.text}</span>
            `;
            
            questionOptions.appendChild(optionElement);
            
            // Check if this option was previously selected
            if (answers[index] && answers[index].includes(option.value)) {
                optionElement.querySelector('.option-input').checked = true;
                optionElement.classList.add('selected');
            }
            
            // Add click handler for visual feedback
            optionElement.addEventListener('click', function() {
                if (question.type === 'single') {
                    document.querySelectorAll('.option-item').forEach(item => {
                        item.classList.remove('selected');
                    });
                    this.classList.add('selected');
                } else {
                    this.classList.toggle('selected');
                }
            });


        });
        
        // Update navigation buttons
        prevQuestionBtn.disabled = index === 0;
        nextQuestionBtn.style.display = index < quizData.questions.length - 1 ? 'inline-flex' : 'none';
        submitQuizBtn.style.display = index === quizData.questions.length - 1 ? 'inline-flex' : 'none';
    }
    
    // Next question
    nextQuestionBtn.addEventListener('click', function() {
        saveAnswer(currentQuestion);
        currentQuestion++;
        showQuestion(currentQuestion);
          // scroll to top of question container
    const questionContainer = document.getElementById('quiz-container'); // or whatever your container ID is
    if (questionContainer) {
        questionContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    });
    
    // Previous question
    prevQuestionBtn.addEventListener('click', function() {
        currentQuestion--;
        showQuestion(currentQuestion);
    });
    
    // Save answer
    function saveAnswer(index) {
        const question = quizData.questions[index];
        const selected = [];
        
        if (question.type === 'single') {
            const selectedOption = document.querySelector('.option-item.selected input');
            if (selectedOption) {
                selected.push(selectedOption.value);
            }
        } else {
            document.querySelectorAll('.option-item.selected input').forEach(option => {
                selected.push(option.value);
            });
        }
        
        answers[index] = selected;
    }
    
    // Submit quiz
    submitQuizBtn.addEventListener('click', function() {
        saveAnswer(currentQuestion);
        calculateResults();
    });
    
    function calculateResults() {
    // Flatten all selected answers into one array
    const allAnswers = Object.values(answers).flat();

    // If no answers were selected
    if (allAnswers.length === 0) {
        quizQuestions.style.display = 'none';
        quizResults.style.display = 'block';
        resultsSummary.innerHTML = `
            <div class="alert alert-warning text-center">
                <strong>No answers selected!</strong><br>Please answer the questions to get your career match.
            </div>
        `;
      
        // Attach listener to inner retake button
        document.getElementById('retake-quiz-inner').addEventListener('click', function() {
            currentQuestion = 0;
            answers = {};
            quizResults.style.display = 'none';
            quizIntro.style.display = 'block';
        });

        return;
    }

    // Calculate match score for each career
    const careerMatches = quizData.careers.map(career => {
        const matchCount = career.matchCriteria.filter(criteria =>
            allAnswers.includes(criteria)
        ).length;

        const matchPercentage = (matchCount / career.matchCriteria.length) * 100;

        return {
            ...career,
            matchPercentage: matchPercentage
        };
    });

    // Filter out careers with 0% match
    const filteredMatches = careerMatches.filter(career => career.matchPercentage > 0);

    // Sort by best match
    filteredMatches.sort((a, b) => b.matchPercentage - a.matchPercentage);

    // Get top 3 matches
    const topMatches = filteredMatches.slice(0, 3);

    // Display results
    displayResults(topMatches);
}

    // Display results
    function displayResults(topMatches) {
        quizQuestions.style.display = 'none';
        quizResults.style.display = 'block';
        
        // Generate summary text based on best match
        const bestMatch = topMatches[0];
        let summaryText = '';
        
        if (bestMatch.matchPercentage > 80) {
            summaryText = `Based on your answers, <strong class="text-primary">${bestMatch.title}</strong> is an excellent match for you (${Math.round(bestMatch.matchPercentage)}% match)!`;
        } else if (bestMatch.matchPercentage > 60) {
            summaryText = `Your skills and interests align well with a career as a <strong class="text-primary">${bestMatch.title}</strong> (${Math.round(bestMatch.matchPercentage)}% match).`;
        } else {
            summaryText = `Consider exploring a career as a <strong class="text-primary">${bestMatch.title}</strong> (${Math.round(bestMatch.matchPercentage)}% match) based on your profile.`;
        }
        
        resultsSummary.innerHTML = summaryText;
        
        // Display all top matches
        careerResults.innerHTML = '';
        
        topMatches.forEach((career, index) => {
            const isBestMatch = index === 0;
            const matchColor = isBestMatch ? 'text-primary' : 'text-secondary';
            
            const careerCard = document.createElement('div');
            careerCard.className = `col-md-${isBestMatch ? '12' : '6'} mb-4`;
            careerCard.innerHTML = `
                <div class="career-card ${isBestMatch ? 'best-match' : ''} h-100">
                    ${isBestMatch ? '<div class="best-match-badge">Best Match</div>' : ''}
                    <div class="card-body p-4">
                        <div class="match-badge">${Math.round(career.matchPercentage)}% Match</div>
                        <h5 class="career-title ${matchColor}">${career.title}</h5>
                        <p class="career-description">${career.description}</p>
                        <button class="btn learn-more-btn" data-career="${career.title}">
                            <i class="fas fa-info-circle me-2"></i>Learn More
                        </button>
                    </div>
                </div>
            `;
            
            careerResults.appendChild(careerCard);
        });
    }
    
    // Retake quiz
    retakeQuizBtn.addEventListener('click', function() {
        currentQuestion = 0;
        answers = {};
        quizResults.style.display = 'none';
        quizIntro.style.display = 'block';
    });
    
    // Save results (would need backend integration)
    saveResultsBtn.addEventListener('click', function() {
        // In a real implementation, this would send data to your server
        const toast = document.createElement('div');
        toast.className = 'position-fixed bottom-0 end-0 p-3';
        toast.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Results saved!</strong> Your career recommendations have been saved to your profile.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        document.body.appendChild(toast);
        
        // Remove toast after 5 seconds
        setTimeout(() => {
            toast.remove();
        }, 5000);
    });
    
    // Learn more about a career (would link to detailed pages)
    document.addEventListener('click', function(e) {
        if (e.target.closest('.learn-more-btn')) {
            const careerTitle = e.target.closest('.learn-more-btn').getAttribute('data-career');
            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">${careerTitle}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>In a full implementation, this would show detailed information about ${careerTitle}, including:</p>
                            <ul>
                                <li>Salary ranges</li>
                                <li>Job outlook</li>
                                <li>Required education</li>
                                <li>Day-to-day responsibilities</li>
                                <li>Related career paths</li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">View Full Profile</button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            
            // Initialize and show modal
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
            
            // Remove modal from DOM after it's hidden
            modal.addEventListener('hidden.bs.modal', function() {
                modal.remove();
            });
        }
    });
});
</script>
</body>
</html>