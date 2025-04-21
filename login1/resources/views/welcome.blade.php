<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RHU | Student Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

  <style>
    :root {
      --primary: #462755;
      --secondary: #083F6B;
      --light-bg: #dde7f4;
      --highlight: #6c8fbf;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--light-bg);
      margin: 0;
    }

    nav.navbar {
      background-color: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .navbar-brand img {
      height: 55px;
    }

    .navbar a {
      color: var(--primary);
      font-weight: 600;
    }

    .navbar a:hover {
      color: var(--secondary);
    }

    .hero-section {
      background-color: #462755;
      color: white;
      text-align: center;
      padding: 90px 20px 60px;
      border-bottom-left-radius: 60px;
      border-bottom-right-radius: 60px;
    }

    .hero-section h1 {
      font-size: 3rem;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .hero-section p {
      font-size: 1.2rem;
      opacity: 0.9;
    }

    section {
      padding: 80px 0;
    }

    .section-heading {
      text-align: center;
      margin-bottom: 50px;
    }

    .section-heading h2 {
      color: var(--primary);
      font-size: 2.6rem;
      font-weight: 700;
    }

    .section-heading p {
      color: #555;
      font-size: 1.1rem;
      max-width: 700px;
      margin: 10px auto 0;
    }

    .feature-block {
      border-radius: 20px;
      padding: 40px 30px;
      transition: all 0.3s ease;
      box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }

    .feature-block:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    }

    .feature-block.light {
      background: #fff;
      color: var(--secondary);
    }

    .feature-block.dark {
      background: var(--primary);
      color: white;
    }

    .feature-block h4 {
      font-weight: 600;
      font-size: 1.5rem;
      margin-bottom: 15px;
    }

    .feature-block p {
      font-size: 1rem;
      line-height: 1.7;
      opacity: 0.95;
    }

    .highlight-card {
      background-color: #f9f9fb;
      border-radius: 24px;
      padding: 40px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .highlight-card h2 {
      font-size: 1.8rem;
      font-weight: 700;
      color: #3b2d4a;
    }

    .highlight-tag {
      display: inline-block;
      border: 2px solid var(--highlight);
      padding: 4px 14px;
      border-radius: 8px;
      color: var(--highlight);
      font-size: 1rem;
      margin-top: 10px;
    }

    .highlight-card p {
      color: #444;
      font-size: 1.05rem;
      line-height: 1.8;
      margin-top: 20px;
    }

    .highlight-card a {
      background-color: var(--highlight);
      color: white;
      padding: 10px 22px;
      border-radius: 40px;
      text-decoration: none;
      font-weight: 500;
      align-self: flex-start;
      margin-top: auto;
    }

    .footer-section {
      background-color: white;
      padding: 40px 20px;
      text-align: center;
      color: var(--secondary);
      font-size: 0.95rem;
      border-top: 1px solid #ccc;
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
        
        @media (max-width: 768px) {
            .hero-container {
                height: 80vh;
            }
            
            .platform-section {
                padding: 3rem 0;
            }
        }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg px-4">
  
  <div class="container-fluid">
    <a href="/" class="navbar-brand">
      <img src="{{ asset('images/logos/rhulogo-removebg-preview.png') }}" alt="RHU Logo">
    </a>

    <div class="d-flex">
      <a href="{{ route('login') }}" class="me-4">Login</a>
      <a href="{{ route('register.student') }}">Register</a>
    </div>
  </div>
</nav>


<!-- Hero -->
<div class="hero-section">
<a href="/" style="position: absolute; top: 100px; left: 20px;">
  <img src="{{ asset('images/logos/blue-arrow.png') }}"
       alt="Back to Home"
       style="width: 32px; height: 32px; cursor: pointer; transition: transform 0.2s ease;"
       onmouseover="this.style.transform='scale(1.1)'"
       onmouseout="this.style.transform='scale(1)'">
</a>

  <h1>Welcome to Your Career Journey at RHU</h1>
  <p>Discover internships, jobs, mentorship, and resources that power your future.</p>
</div>


<!-- Career Tools -->
<section style="background-color:  #dde7f4">
  <div class="container">
    <div class="section-heading" data-aos="fade-up">
      <h2>RHU CAREER TOOLS</h2>
      <p>Discover the features designed to empower your journey at Rafik Hariri University.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6" data-aos="fade-right">
        <div class="feature-block light">
          <h4>Job & Internship Search</h4>
          <p>Discover tailored opportunities aligned with your career goals and academic background.</p>
        </div>
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <div class="feature-block dark">
          <h4>Event Participation</h4>
          <p>Participate in exclusive university-hosted job fairs, career events, and skill workshops.</p>
        </div>
      </div>
      <div class="col-md-6" data-aos="fade-right">
        <div class="feature-block light">
          <h4>AI Chatbot Assistance</h4>
          <p>Use our smart AI chatbot to get instant answers and support—anytime, anywhere.</p>
        </div>
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <div class="feature-block dark">
          <h4>Mentorship & Alumni Network</h4>
          <p>Get mentored by RHU alumni who can guide you with real-world career experience.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Highlight Cards Section with Light Blue Cards and #003865 Accents -->
<section style="position: relative; padding: 120px 20px 100px; background-color: #462755; font-family: 'Poppins', sans-serif; color: white; overflow: hidden;">

  <!-- Decorative Top Shape -->
  <div style="position: absolute; top: 0; left: 0; width: 100%; overflow: hidden; line-height: 0;">
    <svg viewBox="0 0 500 100" preserveAspectRatio="none" style="height: 100px; width: 100%;">
      <path d="M0,100 C150,0 350,200 500,100 L500,00 L0,0 Z" style="stroke: none; fill: #dde7f4;"></path>
    </svg>
  </div>

  <div class="container position-relative">
    <div class="row g-4 mt-3"> <!-- This pushes cards down -->

      <!-- Card 1 -->
      <div class="col-md-6 d-flex" data-aos="fade-up">
        <div class="highlight-card shadow" style="background-color: #dde7f4; color: #003865; border-left: 6px solid #003865; border-radius: 24px; padding: 40px;">
          <h2 style="font-size: 1.8rem; font-weight: 700;">
            DISCOVER YOUR PATH WITH 
            <div class="highlight-tag" style="display: inline-block; border: 2px solid #003865; padding: 4px 14px; border-radius: 8px; color: #003865; font-size: 1rem; margin-top: 10px;">
              PERSONALIZED OPPORTUNITIES
            </div>
          </h2>
          <p style="font-size: 1.05rem; line-height: 1.8; margin-top: 20px;">
            Find internships and job opportunities curated for your background, interests, and goals. The RHU Career Portal is your companion in launching a successful journey — from campus to career.
          </p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
        <div class="highlight-card shadow" style="background-color: #dde7f4; color: #003865; border-left: 6px solid #003865; border-radius: 24px; padding: 40px;">
          <h2 style="font-size: 1.8rem; font-weight: 700;">
            CONNECT, GROW & SUCCEED WITH 
            <div class="highlight-tag" style="display: inline-block; border: 2px solid #003865; padding: 4px 14px; border-radius: 8px; color: #003865; font-size: 1rem; margin-top: 10px;">
              REAL MENTORSHIP
            </div>
          </h2>
          <p style="font-size: 1.05rem; line-height: 1.8; margin-top: 20px;">
            RHU connects you with mentors, alumni, and professionals who’ve walked the path before you. Gain insights, receive feedback, and open doors to opportunities that matter.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

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

<!-- Scripts -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });
</script>

<!-- Chatbot Embed -->

</body>
</html>
