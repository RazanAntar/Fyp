<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Professional Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap and Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
    :root {
        --deep-navy: #003865;
        --light-blue: #dde7f4;
        --deep-purple: #462755;
    }
    body {
    font-family: 'Poppins', sans-serif;
    background: url('/images/your-background.png') no-repeat center center fixed;
    background-size: cover;
    color: #003865; /* deep navy */
    line-height: 1.7;
}


    h1, h2, h3, h4, h5 {
        font-weight: 700;
        color: var(--deep-purple);
    }
    .hero-attractive {
    background: linear-gradient(135deg, var(--deep-navy), #462755);
    padding: 100px 20px;
    border-bottom-left-radius: 60px;
    border-bottom-right-radius: 60px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
}

.hero-title {
    font-size: 48px;
    font-weight: 700;
    color: var(--light-blue);
    letter-spacing: 1px;
}

.hero-subtext {
    font-size: 18px;
    max-width: 700px;
    margin: 0 auto;
    color: #f1f1f1;
    line-height: 1.6;
}

.hero-btn {
    background-color: var(--light-blue);
    color: var(--deep-navy);
    padding: 12px 36px;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid var(--light-blue);
    min-width: 180px;
    text-align: center;
}

.hero-btn:hover {
    background-color: var(--deep-purple);
    color: white;
    border-color: var(--deep-purple);
}

.hero-btn.btn-outline {
    background-color: transparent;
    color: var(--light-blue);
    border: 2px solid var(--light-blue);
}

.hero-btn.btn-outline:hover {
    background-color: var(--light-blue);
    color: var(--deep-navy);
}


    .same-size-btn {
        display: inline-block;
        min-width: 160px;
        text-align: center;
        padding: 10px 20px;
        margin: 5px;
        font-weight: 500;
        border-radius: 8px;
        color: #fff;
        background-color: var(--deep-purple);
        transition: background 0.3s ease;
    }

    .same-size-btn:hover {
        background-color: var(--deep-navy);
    }

    section {
        padding: 80px 20px;
    }

    .section-title {
        font-size: 36px;
        margin-bottom: 60px;
        text-align: center;
        font-weight: 600;
    }

    .values-section {
        background: var(--light-blue);
    }

    .value-card {
        background: white;
        border-radius: 16px;
        padding: 40px 20px;
        text-align: center;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        height: 100%;
    }

    .value-icon {
        font-size: 36px;
        color: var(--deep-purple);
        margin-bottom: 20px;
    }

    .value-title {
        font-size: 16px;
        font-weight: 500;
        text-transform: uppercase;
        color: var(--deep-navy);
    }

    .why-join {
        background-color: var(--light-blue);
    }

    .why-join img {
        width: 100%;
        border-radius: 12px;
        object-fit: cover;
    }

    .why-join .content {
        padding-left: 50px;
    }

    .why-join li {
        margin-bottom: 12px;
        font-size: 15px;
        color: var(--deep-navy);
    }

    .feature-icon {
        font-size: 36px;
        color: var(--deep-purple);
        margin-bottom: 20px;
    }

    .feature-text h5 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--deep-purple);
    }

    .feature-text p {
        font-size: 15px;
        color: #444;
    }

    .feature-img {
        max-width: 80px;
    }

    .cta-section {
        background: var(--deep-navy);
        color: white;
        text-align: center;
        padding: 80px 20px;
    }

    .cta-section h2 {
        font-size: 32px;
        margin-bottom: 20px;
        color: #fff;
    }


    .btn-register {
    background-color: var(--deep-purple);
    color: var(--light-blue);
    border: 3px solid var(--deep-purple);
    width: 200px; /* same size */
    padding: 12px 0;
    font-weight: 600;
    border-radius: 10px;
    text-align: center;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-register:hover {
    background-color: var(--light-blue);
    color: var(--deep-navy);
    border-color: var(--deep-purple);
}

.btn-register-professional {
    background-color: var(--deep-purple);
    color: white;
    border: none;
    padding: 14px 32px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.btn-register-professional:hover {
    background-color: var(--light-blue );
    color: var(--deep-navy);
}




    [data-aos] {
        opacity: 0;
        transition: opacity 0.6s ease, transform 0.6s ease;
    }

    [data-aos].aos-animate {
        opacity: 1;
        transform: translateY(0);
    }

    .comma {
    color: var(--deep-navy);
    font-weight: bold;
}


    .footer {
    background-color: #001f3f;
    color: var(--light-blue);
    padding: 60px 0;
    font-size: 15px;
    
}

.footer h5 {
    color: var(--light-blue);
    font-weight: 600;
}

.footer a {
    color: var(--light-blue);
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer a:hover {
    color: white;
}

.footer .social-icons a {
    display: inline-block;
    width: 40px;
    height: 40px;
    background-color: #1a2c45;
    color: white;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    margin-right: 10px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.footer .social-icons a:hover {
    background-color: var(--light-blue);
    color: var(--deep-navy);
}

.footer hr {
    border-color: #ffffff1a;
}

/* Icon wrapper background */
.icon-wrapper {
    width: 52px;
    height: 52px;
    background-color: var(--light-blue);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Icon color */
.icon-wrapper i {
    font-size: 20px;
    color: var(--deep-navy);
}

/* Title text */
.feature-title {
    font-size: 14px;
    color: var(--deep-navy);
}

/* Optional: Feature card hover animation */
.feature-card:hover {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
    transform: translateY(-4px);
    transition: all 0.3s ease;
}

        @media (max-width: 768px) {
            .hero-container {
                height: 80vh;
            }
            
            .platform-section {
                padding: 3rem 0;
            }
        }

    @media (max-width: 768px) {
        .why-join .content {
            padding-left: 0;
            margin-top: 30px;
        }

        .feature-text {
            text-align: center;
        }

        .feature-img {
            margin: 20px 0;
        }
    }
</style>

</head>
<body>

<!-- HERO -->
<section class="hero-attractive text-white text-center d-flex align-items-center position-relative">

  <!-- Back Arrow (Adjusted Position) -->
  <a href="/" style="position: absolute; top: 30px; left: 35px;">
    <img src="{{ asset('images/logos/blue-arrow.png') }}"
         alt="Back to Home"
         style="width: 32px; height: 32px; cursor: pointer; transition: transform 0.2s ease;"
         onmouseover="this.style.transform='scale(1.1)'"
         onmouseout="this.style.transform='scale(1)'">
  </a>
  
  <div class="container">
  <h1 class="hero-title mb-4">Professional Career Portal</h1>
<p class="hero-subtext mt-3 mb-4">
  Discover top talent. Post internships and jobs. <br class="d-none d-md-block">
  Engage in meaningful career events — all in one place.
</p>

<div class="d-flex justify-content-center flex-wrap gap-4 pt-3">


      <a href="/professional/login" class="btn hero-btn">Login</a>
      <a href="/register-professional" class="btn hero-btn btn-outline">Register Now</a>
    </div>
  </div>
</section>




    <!-- WHAT WE STAND FOR -->
    <section class="values-section" style="padding-top: 100px;">

        <div class="container">
            <h2 class="section-title">What We Stand For</h2>
            <div class="row g-4">
                @php
                    $values = [
                        ['icon' => 'fa-award', 'title' => 'Inclusive Environment'],
                        ['icon' => 'fa-house', 'title' => 'Unique Perspectives'],
                        ['icon' => 'fa-briefcase', 'title' => 'Empowering Differences'],
                        ['icon' => 'fa-chart-line', 'title' => 'Equal Opportunities'],
                    ];
                @endphp
                @foreach ($values as $value)
                    <div class="col-md-6 col-lg-3">
                        <div class="value-card h-100">
                            <div class="value-icon"><i class="fas {{ $value['icon'] }}"></i></div>
                            <div class="value-title">{{ $value['title'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


<!-- 👥 WHY JOIN US - STYLED AS TESTIMONIAL -->
<section style="padding: 100px 0; background-color: #f6f9fc;">
    <div class="container">
        <h2 class="text-center fw-bold text-uppercase mb-5" style="letter-spacing: 1px;">What Our Professionals Say</h2>

        <div class="bg-white rounded-4 shadow-sm p-5 text-center" style="max-width: 900px; margin: 90px auto 0;">

            <div class="mb-4">
                <i class="fas fa-quote-left text-primary" style="font-size: 32px;"></i>
            </div>
            <blockquote class="blockquote mb-4" style="font-size: 18px; line-height: 1.7;">
            <p class="testimonial-text">
    "As a professional user<span class="comma">,</span> I was able to find highly qualified candidates and communicate with them instantly. 
    The event hosting feature helped me connect with fresh graduates in a meaningful way."
</p>

            </blockquote>
            <footer class="blockquote-footer text-uppercase mt-3" style="letter-spacing: 1px; font-size: 13px; color: #5281c3;">
                LAYAL HADDAD, HR CONSULTANT
            </footer>

            <!-- Pagination Dots (for future testimonials or animation) -->
            <div class="mt-4">
                <span class="dot bg-primary"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </div>
</section>


<!-- 💼 PROFESSIONAL FEATURES SECTION - FINAL DESIGN WITH EVENTS -->
<section style="padding: 40px 0 100px 0; background-color: #f6f8fc;">

    <div class="container">
    <h2 class="text-center fw-bold" style="font-size: 32px; margin-bottom: 100px; margin-top: -10px;">
    What You Can Do
</h2>

        <div class="row g-4">
            @php
                $features = [
                    [
                        'icon' => 'fa-magnifying-glass', // Search icon
                        'title' => 'Search Students & Alumni',
                        'desc' => 'Use smart filters to find top talent based on majors, experience, and skillsets.'
                    ],
                    [
                        'icon' => 'fa-bullhorn',
                        'title' => 'Post Jobs & Internships',
                        'desc' => 'Create custom listings and manage applications all from your dashboard.'
                    ],
                    [
                        'icon' => 'fa-comment-dots',
                        'title' => 'Real-Time Communication',
                        'desc' => 'Engage directly with candidates through messaging for follow-ups and interviews.'
                    ],
                    [
                        'icon' => 'fa-calendar-check',
                        'title' => 'Participate in Events',
                        'desc' => 'Join or host career fairs, workshops, and networking sessions with students and alumni.'
                    ]
                ];
            @endphp

            @foreach($features as $feature)
<div class="col-md-6 col-lg-6">
    <div class="d-flex align-items-start p-4 bg-white rounded-4 shadow-sm h-100 feature-card">
        <div class="me-3">
            <div class="icon-wrapper">
                <i class="fas {{ $feature['icon'] }}"></i>
            </div>
        </div>
        <div>
            <h6 class="fw-bold mb-1 text-uppercase feature-title">{{ $feature['title'] }}</h6>
            <p class="text-muted small mb-0">{{ $feature['desc'] }}</p>
        </div>
    </div>
</div>
@endforeach

        </div>
    </div>
</section>



    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <h2>Ready to connect with top talent?</h2>
            <p>Start today and shape the future of your workforce.</p>
            <a href="/register-professional" class="btn btn-register-professional">Register as a Professional</a>

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

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        AOS.init({ once: true });
    });
    </script>
</body>
</html>
