<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Home - {{ config('app.name') }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Lora:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
    <!-- Add this to your head tag if not already included -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --purple-main: #502159;
            --purple-secondary: #513D70;
            --purple-dark: #462755;
            --purple-light: #91569C;
            --navy-blue: #001f3f;
            --accent-blue: #0d6efd;
            --light-blue: #e7f1ff;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .alumni-header {
    background-color: #462755; /* Main Purple */
    color: white;
    padding: 4rem 0 3rem;
    margin-bottom: 0;
    position: relative;
    overflow: hidden;
        }


        
        .alumni-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(255,255,255,0.05)" d="M0,0 L100,0 L100,100 L0,100 Z" /></svg>');
            opacity: 0.1;
        }
        
        .header-content {
            position: relative;
            z-index: 2;
        }
        
        .alumni-features {
            padding: 4rem 0;
            background-color: white;
        }
        
        .feature-card {
            border: none;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            height: 100%;
            border-top: 4px solid var(--purple-light);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(81, 45, 112, 0.15);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--purple-main);
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--purple-main) 0%, var(--navy-blue) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }
        
        .cta-section {
            background: linear-gradient(135deg, var(--purple-secondary) 0%, var(--navy-blue) 100%);
            color: white;
            padding: 4rem 0;
            border-radius: 12px;
            margin: 3rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(255,255,255,0.1)" d="M0,0 L100,0 L100,100 L0,100 Z" /></svg>');
            opacity: 0.1;
        }
        
        .cta-content {
            position: relative;
            z-index: 2;
        }
        
        .btn-purple {
            background-color: var(--purple-main);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-purple:hover {
            background-color: var(--purple-light);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(81, 45, 112, 0.3);
        }
        
        .btn-outline-purple {
            border: 2px solid var(--purple-main);
            color: var(--purple-main);
            background: transparent;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-purple:hover {
            background-color: var(--purple-main);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(81, 45, 112, 0.3);
        }
        
        .profile-alert {
            background-color: white;
            border-left: 5px solid var(--purple-light);
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 2rem;
            margin-top: -2rem;
            position: relative;
            z-index: 10;
        }
        
        .stats-section {
            background-color: var(--light-blue);
            padding: 3rem 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 1.5rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--purple-main);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: var(--navy-blue);
            font-weight: 600;
        }
        
    /* Footer Styles */
    .footer {
            background-color: #001f3f;
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
        
        .section-title {
            position: relative;
            margin-bottom: 2.5rem;
            color: var(--purple-main);
        }
        
        .section-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--purple-main) 0%, var(--navy-blue) 100%);
            border-radius: 2px;
        }
        
        .testimonial-card {
            background-color: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--purple-light);
        }
        
        .testimonial-text {
            font-style: italic;
            color: var(--navy-blue);
            margin-bottom: 1.5rem;
        }
        
        .testimonial-author {
            font-weight: 600;
            color: var(--purple-main);
        }
        
        .testimonial-role {
            color: var(--purple-secondary);
            font-size: 0.9rem;
        }
    </style>
    <style>


.alumni-header::before {
    content: "";
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background-color: rgba(103, 58, 183, 0.1);
    border-radius: 50%;
}

.alumni-header::after {
    content: "";
    position: absolute;
    bottom: -30px;
    right: 100px;
    width: 150px;
    height: 150px;
    background-color: rgba(103, 58, 183, 0.1);
    border-radius: 50%;
}

.btn-purple {
    background-color: #673ab7;
    color: white;
    border-radius: 50px;
    transition: all 0.3s ease;
}



.btn-outline-purple {
    border-color: #673ab7;
    color: #673ab7;
    border-radius: 50px;
    transition: all 0.3s ease;
}


.alumni-image-container {
    transition: all 0.4s ease;
   
}

.alumni-image-container:hover {
    transform: scale(1.03);
}
</style>
<style>
.cta-section {
    background: linear-gradient(135deg, #2a1454 0%);
}

.tilted-cta-box {
    background: rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
    transform: skewX(-10deg);
    border-radius: 8px;
    margin: 0 -20px;
    border: 1px solid rgba(255,255,255,0.1);
}

.tilted-cta-box > .row {
    transform: skewX(10deg);
    padding: 20px 0;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .tilted-cta-box {
        transform: skewX(-5deg);
        margin: 0 -15px;
    }
    .tilted-cta-box > .row {
        transform: skewX(5deg);
    }
}

@media (max-width: 768px) {
    .tilted-cta-box {
        transform: none;
        margin: 0;
    }
    .tilted-cta-box > .row {
        transform: none;
        text-align: center;
    }
    .tilted-cta-box .d-flex {
        justify-content: center !important;
    }
}
</style>

<style>
    :root {
        --deep-navy: #003865;
        --light-blue: #dde7f4;
        --deep-purple: #462755;
    }

    .alumni-header {
        background-color: var(--light-blue);
        color: var(--deep-navy);
    }

    .alumni-header h1 {
        color: var(--deep-purple);
        font-family: 'Playfair Display', serif;
    }

    .alumni-header p {
        color: var(--deep-navy);
        font-size: 1.1rem;
    }

    .btn-alumni {
        background-color: var(--deep-purple);
        color: white;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 50%;
        padding: 0.6rem 1.5rem;
        text-align: center;
        border: none;
    }

    .btn-alumni:hover {
        background-color: var(--deep-navy);
        color: white;
    }

    .alumni-image-container img {
        border: 4px solid white;
        border-radius: 1rem;
    }

    .alumni-bg-shape {
        background: rgba(0, 56, 101, 0.1);
        z-index: -1;
    }

    .circle-top-left {
        background: rgba(0, 56, 101, 0.1);
        border-radius: 50%;
        width: 120px;
        height: 120px;
        z-index: -1;
        transform: translate(-60px, -30px);
    }

    .circle-bottom-right {
        background: rgba(70, 39, 85, 0.15);
        border-radius: 50%;
        width: 120px;
        height: 120px;
        z-index: -1;
        transform: translate(50px, 40px);
    }

    @media (max-width: 768px) {
        .btn-alumni {
            width: 100%;
        }
    }
</style>
</head>
<body>


<header class="alumni-header py-5">

<!-- Hero -->
<div class="hero-section position-relative" style="padding-top: 2rem;">

  <!-- Clickable Custom Arrow -->
  <a href="/" style="position: absolute; top: 5px; left: 30px;">
    <img src="{{ asset('images/logos/purple-arrow.png') }}"
         alt="Back to Home"
         style="width: 32px; height: 32px; cursor: pointer; transition: transform 0.2s ease;"
         onmouseover="this.style.transform='scale(1.1)'"
         onmouseout="this.style.transform='scale(1)'">
  </a>

</div>




    <div class="container header-content">
        <div class="row align-items-center gx-4">
            <div class="col-lg-7">
            <h1 class="display-4 fw-bold mb-4" style="margin-top: -10px;">Welcome Back, Alumni!</h1>
            <p class="lead mb-5" style="margin-top: 1.5rem;">
  Join our vibrant network of professionals, share your journey, and inspire the next generation of leaders from Rafik Hariri University.
</p>

                <div style="display: flex; justify-content: center; gap: 2rem; margin-top: 2.5rem; flex-wrap: wrap;">
    <!-- Login Button -->
    <a href="/login"
       style="background-color: #462755; color: white; padding: 1rem 0; width: 240px; font-size: 1.1rem;
              border-radius: 50px; font-weight: 600; text-decoration: none; text-align: center;
              transition: all 0.3s ease; box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1); display: inline-block;"
       onmouseover="this.style.backgroundColor='#2c1e3f';"
       onmouseout="this.style.backgroundColor='#462755';">
       Login
    </a>

    <!-- Register Button -->
    <a href="{{ route('register.alumni') }}"
       style="background-color: #462755; color: white; padding: 1rem 0; width: 240px; font-size: 1.1rem;
              border-radius: 50px; font-weight: 600; text-decoration: none; text-align: center;
              transition: all 0.3s ease; box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1); display: inline-block;"
       onmouseover="this.style.backgroundColor='#2c1e3f';"
       onmouseout="this.style.backgroundColor='#462755';">
       Register
    </a>
</div>

            </div>

            <div class="col-lg-5 d-none d-lg-flex justify-content-end">
  <div class="alumni-image-container position-relative me-5" style="max-width: 340px; margin-top: -40px;">
    <img src="/images/logos/alumni-hover-2.jpeg" alt="Alumni Network" 
         class="img-fluid shadow-lg">
    
    <!-- Decorative Background Shapes -->
    <div class="position-absolute top-0 start-0 w-100 h-100 rounded-4 alumni-bg-shape" 
         style="transform: rotate(10deg) translate(10px, 12px);">
    </div>

    <div class="position-absolute top-0 start-0 circle-top-left"></div>
    <div class="position-absolute bottom-0 end-0 circle-bottom-right"></div>
  </div>
</div>

    </div>
</header>




<!-- Profile Completion Alert - Motivational Message -->
<div class="container my-0">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="profile-alert bg-gradient-primary p-2 rounded-3 shadow-sm border-start border-5 border-warning">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <h4 class="mb-2" style="font-family: 'Playfair Display', serif; font-weight: 700; font-size: 1.6rem; color: #2d3436; line-height: 1.3;">
                            "The right opportunity is out there—<span style="color: #e17055;">stay ready</span> so you don't have to get ready." 
                        </h4>
                        <p class="mb-0 mt-2" style="font-family: 'Lora', serif; font-weight: 500; color: #636e72; font-size: 1.05rem; font-style: italic; line-height: 1.4;">
                            Update your profile to get matched with top roles that fit your skills.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    
    <!-- Features Section -->
    <section class="alumni-features">
        <div class="container">
            <h2 class="text-center section-title">How You Can Make an Impact</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3>Mentor Students</h3>
                        <p>Guide current students through one-on-one mentorship sessions, sharing your industry insights and career advice.</p>
                        <p class="btn mt-3"
                        style="color: #462755; border: 2px solid #462755; border-radius: 30px; padding: 0.5rem 1.5rem; font-weight: 600;">
                        Become a Mentor
                        </p>

                       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3>Share Opportunities</h3>
                        <p>Post job openings, internships, or projects from your company to help students kickstart their careers.</p>
                        <p class="btn mt-3"
                        style="color: #462755; border: 2px solid #462755; border-radius: 30px; padding: 0.5rem 1.5rem; font-weight: 600;">
                        Post Opportunity
                        </p>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-network-wired"></i>
                        </div>
                        <h3>Expand Network</h3>
                        <p>Connect with fellow alumni across industries and locations to create powerful professional connections.</p>
                        <p class="btn mt-3"
                        style="color: #462755; border: 2px solid #462755; border-radius: 30px; padding: 0.5rem 1.5rem; font-weight: 600;">
                        Explore Network
                        </p>

                   
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Modern CTA Section -->
<section class="position-relative overflow-hidden py-5"
         style="background-color: #003865;">
    <div class="container position-relative">
        <div class="p-4 p-md-5"
             style="background-color: #dde7f4; border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,0.1);">
            <div class="row align-items-center">
                <div class="col-lg-8 pe-lg-5">
                    <h2 class="display-5 fw-bold mb-3" style="color: #462755;">Ready to Make a Difference?</h2>
                    <p class="lead mb-4 mb-lg-0" style="color: #003865;">
                        Join hundreds of alumni who are shaping the future of Rafik Hariri University students through mentorship, opportunities, and shared knowledge.
                    </p>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="d-flex flex-wrap gap-3 justify-content-lg-end justify-content-center">
                    <a href="/register"
   style="background-color: #462755; color: white; padding: 1rem 0; width: 260px; font-size: 1.1rem;
          border-radius: 20px; font-weight: 700; text-decoration: none; text-align: center;
          transition: background-color 0.3s ease, color 0.3s ease;
          box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); display: inline-block;"
   onmouseover="this.style.backgroundColor='#003865'; this.style.color='white';"
   onmouseout="this.style.backgroundColor='#462755'; this.style.color='white';">
   Create Your Account
</a>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


   <!-- Events Section with Modals -->
   <section class="pt-5 pb-5 mt-5 mb-5">
    <div class="container">
    <h2 class="text-center section-title mb-5 pt-3 pb-3">Upcoming Alumni Events</h2>

        <div class="row">

            <!-- Event 1 -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-img-top bg-purple-secondary text-white p-4" style="background-color: var(--purple-secondary);">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">15</h5>
                            <span>JUN</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Annual Alumni Meet</h5>
                        <p class="card-text">Join us for our yearly gathering to reconnect with classmates and meet new alumni.</p>
                        <button 
    class="btn btn-sm"
    style="background-color: #462755; color: white; font-weight: 600; padding: 0.5rem 1.2rem;
           border: none; border-radius: 20px; transition: background-color 0.3s ease;"
    onmouseover="this.style.backgroundColor='#003865';"
    onmouseout="this.style.backgroundColor='#462755';"
    data-bs-toggle="modal" 
    data-bs-target="#eventModal1">
    Learn More
</button>

                    </div>
                </div>
            </div>
            
            <!-- Event 2 -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-img-top bg-purple-secondary text-white p-4" style="background-color: var(--purple-secondary);">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">22</h5>
                            <span>JUL</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Career Panel: Tech Industry</h5>
                        <p class="card-text">Hear from alumni working in leading tech companies about industry trends.</p>
                        <button 
    class="btn btn-sm"
    style="background-color: #462755; color: white; font-weight: 600; padding: 0.5rem 1.2rem;
           border: none; border-radius: 20px; transition: background-color 0.3s ease;"
    onmouseover="this.style.backgroundColor='#003865';"
    onmouseout="this.style.backgroundColor='#462755';"
    data-bs-toggle="modal" 
    data-bs-target="#eventModal2">
    Learn More
</button>

                    </div>
                </div>
            </div>
            
            <!-- Event 3 -->
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-img-top bg-purple-secondary text-white p-4" style="background-color: var(--purple-secondary);">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">05</h5>
                            <span>AUG</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Mentorship Workshop</h5>
                        <p class="card-text">Learn how to be an effective mentor to current students in this interactive session.</p>
                        <button 
    class="btn btn-sm"
    style="background-color: #462755; color: white; font-weight: 600; padding: 0.5rem 1.2rem;
           border: none; border-radius: 20px; transition: background-color 0.3s ease;"
    onmouseover="this.style.backgroundColor='#003865';"
    onmouseout="this.style.backgroundColor='#462755';"
    data-bs-toggle="modal" 
    data-bs-target="#eventModal3">
    Learn More
</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
        <button 
    class="btn"
    style="color: #462755; border: 2px solid #462755; background-color: transparent;
           font-weight: 600; padding: 0.6rem 1.5rem; border-radius: 20px; 
           transition: background-color 0.3s ease, color 0.3s ease;"
    onmouseover="this.style.backgroundColor='#003865'; this.style.color='white';"
    onmouseout="this.style.backgroundColor='transparent'; this.style.color='#462755';"
    data-bs-toggle="modal" 
    data-bs-target="#registerModal">
    View All Events
</button>

        </div>
    </div>
</section>

<!-- Event 1 Modal -->
<div class="modal fade" id="eventModal1" tabindex="-1" aria-labelledby="eventModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: var(--purple-secondary);">
                <h5 class="modal-title text-white" id="eventModal1Label">Annual Alumni Meet</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <strong>Date:</strong> June 15, 2023
                    </div>
                    <div>
                        <strong>Time:</strong> 6:00 PM - 9:00 PM
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Location:</strong> University Main Campus, Alumni Hall
                </div>
                <p>This year's annual alumni meet will feature:</p>
                <ul>
                    <li>Campus tours showcasing new developments</li>
                    <li>Keynote from the University President</li>
                    <li>Class reunion sessions by graduation year</li>
                    <li>Networking reception with food and drinks</li>
                </ul>
                <div class="alert alert-info mt-3">
                    <strong>Registration required:</strong> Please RSVP by June 10th
                </div>
            </div>
            <div class="modal-footer">
                
            <button type="button"
        class="btn"
        style="color: #462755; border: 2px solid #462755; font-weight: 600; padding: 0.5rem 1.2rem;
               border-radius: 20px; transition: background-color 0.3s ease, color 0.3s ease;"
        onmouseover="this.style.backgroundColor='#003865'; this.style.color='white';"
        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#462755';"
        data-bs-dismiss="modal">
    Close
</button>

            </div>
        </div>
    </div>
</div>

<!-- Event 2 Modal -->
<div class="modal fade" id="eventModal2" tabindex="-1" aria-labelledby="eventModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: var(--purple-secondary);">
                <h5 class="modal-title text-white" id="eventModal2Label">Career Panel: Tech Industry</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <strong>Date:</strong> July 22, 2023
                    </div>
                    <div>
                        <strong>Time:</strong> 4:00 PM - 6:30 PM
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Location:</strong> Virtual (Zoom link provided after registration)
                </div>
                <p>Featured panelists include:</p>
                <ul>
                    <li>Sarah Johnson (Class of '12) - Senior Engineer at TechCorp</li>
                    <li>Michael Chen (Class of '15) - Product Manager at InnovateCo</li>
                    <li>David Wilson (Class of '08) - CTO at Startup Ventures</li>
                </ul>
                <p>Topics will include career paths, emerging technologies, and how to break into the industry.</p>
            </div>
            <div class="modal-footer">
               
            <button type="button"
        class="btn"
        style="color: #462755; border: 2px solid #462755; font-weight: 600; padding: 0.5rem 1.2rem;
               border-radius: 20px; transition: background-color 0.3s ease, color 0.3s ease;"
        onmouseover="this.style.backgroundColor='#003865'; this.style.color='white';"
        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#462755';"
        data-bs-dismiss="modal">
    Close
</button>

            </div>
        </div>
    </div>
</div>

<!-- Event 3 Modal -->
<div class="modal fade" id="eventModal3" tabindex="-1" aria-labelledby="eventModal3Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: var(--purple-secondary);">
                <h5 class="modal-title text-white" id="eventModal3Label">Mentorship Workshop</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <strong>Date:</strong> August 5, 2023
                    </div>
                    <div>
                        <strong>Time:</strong> 10:00 AM - 2:00 PM
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Location:</strong> Business School, Room 204
                </div>
                <p>This interactive workshop will cover:</p>
                <ul>
                    <li>Effective mentoring techniques</li>
                    <li>Setting expectations with mentees</li>
                    <li>Career guidance best practices</li>
                    <li>Networking strategies for mentees</li>
                </ul>
                <p>Includes lunch and networking with current students.</p>
            </div>
            <div class="modal-footer">
     
            <button type="button"
        class="btn"
        style="color: #462755; border: 2px solid #462755; font-weight: 600; padding: 0.5rem 1.2rem;
               border-radius: 20px; transition: background-color 0.3s ease, color 0.3s ease;"
        onmouseover="this.style.backgroundColor='#003865'; this.style.color='white';"
        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#462755';"
        data-bs-dismiss="modal">
    Close
</button>

            </div>
        </div>
    </div>
</div>

<!-- Register First Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="registerModalLabel">Registration Required</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-exclamation-triangle-fill text-warning display-4 mb-3"></i>
                <h5>You need to register first to view all events</h5>
                <p class="mb-4">Create your alumni account to access the full events calendar and registration.</p>
                <div class="d-flex justify-content-center gap-3">
    <!-- Filled Register Button -->
    <a href="/register"
       style="background-color: #462755; color: white; padding: 0.75rem 1.5rem; font-weight: 600; 
              border-radius: 25px; text-decoration: none; transition: background-color 0.3s ease;"
       onmouseover="this.style.backgroundColor='#003865';"
       onmouseout="this.style.backgroundColor='#462755';">
       Register Now
    </a>

    <!-- Outlined Login Button -->
    <a href="/login"
       style="color: #462755; border: 2px solid #462755; padding: 0.75rem 1.5rem; font-weight: 600; 
              border-radius: 25px; text-decoration: none; transition: all 0.3s ease;"
       onmouseover="this.style.backgroundColor='#003865'; this.style.color='white';"
       onmouseout="this.style.backgroundColor='transparent'; this.style.color='#462755';">
       Login
    </a>
</div>

            </div>
        </div>
    </div>
</div>


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
</body>
</html>