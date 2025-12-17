<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT. Kobar Indonesia</title>
  <meta name="description" content="Professional auto repair services with certified mechanics. We service all makes and models with top-quality parts.">
  <link rel="shortcut icon" href="{{ asset("images/ptkobarnobgnew.png") }}" />
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts untuk typography yang lebih baik -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Vite untuk Laravel Breeze (untuk login/register pages) -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  <!-- CSS Custom Kamu -->
  <style>
    /* TYPOGRAPHY */
    body {
      font-family: 'Poppins', sans-serif;
    }
    
    h1, h2, h3, h4, h5, h6 {
      font-family: 'Montserrat', sans-serif;
      font-weight: 600;
    }
    
    /* NAVBAR */
    .navbar {
      padding: 8px 0;
      background-color: white !important;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    /* LOGO NAVBAR - LEBIH KECIL */
    .navbar-brand img {
      height: 40px !important;
      width: auto;
      transition: all 0.3s ease;
    }

    /* Menu Navigasi */
    .navbar-nav .nav-item {
      display: flex;
      align-items: center;
    }

    .navbar-nav .nav-link {
      color: #333 !important;
      font-weight: 500;
      font-size: 0.95rem;
      padding: 8px 15px;
      margin: 0 2px;
      letter-spacing: 0.5px;
    }

    .navbar-nav .nav-link:hover {
      color: #0070c0 !important;
    }

    .navbar-nav .nav-link.active {
      color: #0070c0 !important;
      font-weight: 600;
    }

    /* TOMBOL LOGIN & SIGN UP - STYLE ASLI */
    .navbar-nav .nav-item .btn-nav-kobar {
      padding: 6px 20px !important;
      font-size: 0.8rem !important;
      font-weight: 600 !important;
      border-radius: 90px !important;
      margin: 0 5px !important;
      transition: all 0.3s ease !important;
      text-decoration: none !important;
      display: inline-block !important;
      border: 1px solid !important;
      cursor: pointer !important;
      visibility: visible !important;
      opacity: 1 !important;
      position: relative !important;
      z-index: 100 !important;
    }

    /* TOMBOL LOGIN */
    .navbar-nav .nav-item a.btn-login-kobar {
      background-color: #ff0000 !important;
      color: white !important;
      border-color: #ff0000 !important;
    }

    /* TOMBOL SIGNUP */
    .navbar-nav .nav-item a.btn-signup-kobar {
      background-color: transparent !important;
      color: #0070c0 !important;
      border-color: #0070c0 !important;
    }

    .navbar-nav .nav-item a.btn-login-kobar:hover {
      background-color: #0070c0 !important;
      border-color: #0070c0 !important;
      color: white !important;
    }

    .navbar-nav .nav-item a.btn-signup-kobar:hover {
      background-color: #ff0000 !important;
      color: #ffffff !important;
      border-color: #ff0000 !important;
    }
    
    /* UTILITY CLASSES */
    .bg-primary {
      background-color: #0070c0 !important;
    }
    
    .bg-light {
      background-color: #ffffffff !important;
    }
    
    .card-body {
      background-color: #000000ff !important;
      border-radius: 10px;
    }
    
    .text-primary {
      color: #0070c0 !important;
    }

    /* Hero Section */
    .hero-section {
      background: url('{{ asset("images/ptkobarindex2.jpg") }}') no-repeat center center;
      background-size: cover;
      padding: 300px 0 100px;
      text-align: left;
      position: relative;
    }

    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0,0,0,0.5);
      z-index: 0;
    }

    .hero-content {
      position: relative;
      z-index: 1;
      max-width: 600px;
    }

    .hero-section h1.display-4 {
      color: #ffffff !important;
      font-weight: 700;
      font-size: 2.8rem;
      margin-bottom: 20px;
      line-height: 1.2;
    }

    .hero-section p.lead {
      color: #ffffff;
      font-size: 1.2rem;
      margin-bottom: 30px;
      line-height: 1.6;
    }

    .btn-hero {
      padding: 8px 20px;
      font-size: 0.8rem;
      font-weight: 600;
      border-radius: 50px;
      margin-right: 15px;
      margin-bottom: 15px;
    }
    
    .btn-primary {
      background-color: #0070c0;
      border: 1px solid #0070c0;
    }

    /* ABOUT US SECTION - IMPROVED */
    #about {
      padding: 80px 0;
      background-color: #f8f9fa;
    }
    
    #about .section-title {
      font-size: 2.2rem; /* Diperkecil dari 2.5rem */
      font-weight: 700;
      color: #0070c0;
      margin-bottom: 15px;
      position: relative;
      padding-bottom: 0; /* Hapus padding untuk garis */
    }
    
    /* HAPUS GARIS MERAH DI BAWAH JUDUL */
    /* #about .section-title:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background-color: #ff0000;
      border-radius: 2px;
    } */
    
    #about .section-subtitle {
      font-size: 1.1rem; /* Diperkecil dari 1.3rem */
      color: #666;
      font-weight: 400;
      margin-bottom: 40px;
      line-height: 1.5;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      /* Batasi hanya 2 baris */
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    
    #about .feature-card {
      background: white;
      border-radius: 12px; /* Diperkecil dari 15px */
      padding: 25px 20px; /* Diperkecil dari 30px 25px */
      height: 100%;
      transition: all 0.3s ease;
      border: 1px solid #e9ecef;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05); /* Diperkecil shadow */
    }
    
    #about .feature-card:hover {
      transform: translateY(-8px); /* Diperkecil dari -10px */
      box-shadow: 0 12px 25px rgba(0, 112, 192, 0.12); /* Diperkecil shadow */
      border-color: #0070c0;
    }
    
    #about .feature-icon {
      font-size: 2.2rem; /* Diperkecil dari 2.5rem */
      color: #0070c0;
      margin-bottom: 15px; /* Diperkecil dari 20px */
      display: inline-block;
      background: rgba(0, 112, 192, 0.1);
      width: 65px; /* Diperkecil dari 70px */
      height: 65px; /* Diperkecil dari 70px */
      line-height: 65px; /* Diperkecil dari 70px */
      border-radius: 50%;
      text-align: center;
    }
    
    #about .feature-card h5 {
      font-size: 1.2rem; /* Diperkecil dari 1.3rem */
      font-weight: 600;
      color: #333;
      margin-bottom: 12px; /* Diperkecil dari 15px */
    }
    
    #about .feature-card p {
      color: #666;
      font-size: 0.95rem; /* Diperkecil dari 1rem */
      line-height: 1.5;
      margin-bottom: 0;
    }
    
    /* Back to Top Button */
    .back-to-top {
      position: fixed;
      right: 30px;
      bottom: 30px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #ffffffff;
      border: 1px solid #0070c0;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      z-index: 9999;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      border: 2px solid rgba(255,255,255,0.8);
    }
    
    .back-to-top.active {
      opacity: 1;
      visibility: visible;
    }
    
    .back-to-top:hover {
      background-color: #ffffffff;
      transform: translateY(-3px);
    }
    
    .back-to-top i {
      font-size: 20px;
    }
    
    .fas, .fab, .far, .fal, .fad {
      color: #0070c0 !important;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      /* Logo lebih kecil di mobile */
      .navbar-brand img {
        height: 28px !important;
      }
      
      .navbar-nav .nav-item .btn-nav-kobar {
        margin: 8px 0 !important;
        width: 100% !important;
        text-align: center !important;
        max-width: 200px !important;
      }
      
      .hero-section {
        padding: 200px 0 80px;
      }
      
      .hero-section h1.display-4 {
        font-size: 2rem;
      }
      
      /* About Us Responsive */
      #about {
        padding: 60px 0;
      }
      
      #about .section-title {
        font-size: 1.8rem; /* Diperkecil untuk mobile */
      }
      
      #about .section-subtitle {
        font-size: 1rem; /* Diperkecil untuk mobile */
        -webkit-line-clamp: 3; /* Di mobile bisa 3 baris */
      }
      
      #about .feature-card {
        padding: 20px 15px; /* Diperkecil untuk mobile */
      }
      
      #about .feature-card h5 {
        font-size: 1.1rem; /* Diperkecil untuk mobile */
      }
      
      #about .feature-icon {
        width: 60px; /* Diperkecil untuk mobile */
        height: 60px; /* Diperkecil untuk mobile */
        line-height: 60px; /* Diperkecil untuk mobile */
        font-size: 2rem; /* Diperkecil untuk mobile */
      }
    }
    
    /* Extra small devices */
    @media (max-width: 576px) {
      .navbar-brand img {
        height: 26px !important;
      }
      
      #about .section-title {
        font-size: 1.6rem; /* Lebih kecil untuk extra small */
      }
      
      #about .section-subtitle {
        font-size: 0.95rem; /* Lebih kecil untuk extra small */
        -webkit-line-clamp: 4; /* Di extra small bisa 4 baris */
      }
    }
  </style>
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <!-- LOGO LEBIH KECIL - height 32px -->
        <img src="{{ asset('images/ptkobar4.png') }}" alt="PT. Kobar Indonesia" height="32">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item mx-2">
            <!-- TOMBOL LOGIN -->
            <a href="{{ route('login') }}" 
               class="btn-nav-kobar btn-login-kobar">
              Login
            </a>
          </li>
          <li class="nav-item mx-2">
            <!-- TOMBOL SIGN UP -->
            <a href="{{ route('register') }}" 
               class="btn-nav-kobar btn-signup-kobar">
              Sign Up
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section" id="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="hero-content">
            <h1 class="display-4 fw-bold mb-4">PT. KOBAR INDONESIA</h1>
            <p class="lead mb-4">Terus berkembang dalam sektor otomotif dengan komitmen untuk memberikan layanan terbaik bagi seluruh pelanggan di Indonesia.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section - IMPROVED -->
  <section class="py-5" id="about">
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-10 mx-auto text-center">
          <h2 class="section-title mb-3">About Us</h2>
          <p class="section-subtitle mb-5">
            Sebagai pionir dalam industri komponen logam presisi, kami berkomitmen untuk memberikan solusi terbaik dengan kualitas tertinggi.
          </p>
          <div class="row g-4">
            <div class="col-md-6 col-lg-6">
              <div class="feature-card">
                <div class="feature-icon">
                  <i class="fas fa-award"></i>
                </div>
                <h5>Qualified Experts</h5>
                <p>Our experts in metal processing and stamping parts ensure precision, efficiency, and quality in every production stage.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-6">
              <div class="feature-card">
                <div class="feature-icon">
                  <i class="fas fa-shield-alt"></i>
                </div>
                <h5>Quality Assurance</h5>
                <p>Certified under ISO 9001:2015, every product undergoes strict quality control to ensure consistency and excellence.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-6">
              <div class="feature-card">
                <div class="feature-icon">
                  <i class="fas fa-tools"></i>
                </div>
                <h5>High-Quality Materials</h5>
                <p>We use premium stainless and selected metals that deliver strength and precision for automotive standards.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-6">
              <div class="feature-card">
                <div class="feature-icon">
                  <i class="fas fa-clock"></i>
                </div>
                <h5>Reliable Delivery</h5>
                <p>Through efficient production and strict scheduling, we ensure every order is delivered on time.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="py-5 bg-primary text-white">
    <div class="container py-5">
      <div class="row text-center g-5">
        <div class="col-md-3 col-6">
          <h2 class="display-4 fw-bold text-white">5+</h2>
          <p class="mb-0">Years Experience</p>
        </div>
        <div class="col-md-3 col-6">
          <h2 class="display-4 fw-bold text-white">10+</h2>
          <p class="mb-0">Metal Components Produced</p>
        </div>
        <div class="col-md-3 col-6">
          <h2 class="display-4 fw-bold text-white">95%</h2>
          <p class="mb-0">Customer Satisfaction</p>
        </div>
        <div class="col-md-3 col-6">
          <h2 class="display-4 fw-bold text-white">5+</h2>
          <p class="mb-0">Trusted Clients</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5" style="background-color: #000000ff;">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4">
          <!-- Logo di footer juga bisa diperkecil jika perlu -->
          <img src="{{ asset('images/ptkobarnobg.png') }}" alt="PT Kobar Indonesia" width="60" class="mb-3">
          <p style="color: rgba(255,255,255,0.8);">Precision Metal Components for a Reliable Future.<br>Built on quality and efficiency.</p>
          <div class="d-flex gap-3 mt-4">
            <a style="color: white;"><i class="fab fa-facebook-f"></i></a>
            <a style="color: white;"><i class="fab fa-twitter"></i></a>
            <a style="color: white;"><i class="fab fa-instagram"></i></a>
            <a style="color: white;"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
        
        <div class="col-lg-2 col-md-4">
          <h5 class="mb-4" style="color: white;">Quick Links</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#home" style="color: rgba(255,255,255,0.8); text-decoration: none;">Home</a></li>
            <li class="mb-2"><a href="#about" style="color: rgba(255,255,255,0.8); text-decoration: none;">About Us</a></li>
          </ul>
        </div>
        
        <div class="col-lg-3 col-md-4">
          <h5 class="mb-4" style="color: white;">Contact Info</h5>
          <ul class="list-unstyled">
            <li class="mb-3 d-flex align-items-start">
              <i class="fas fa-map-marker-alt me-2 mt-1" style="color: white;"></i>
              <span style="color: rgba(255,255,255,0.8);">Office :<br> Jl. Penggilingan, Komplek PIK, Blok G No. 18-20, Penggilingan Cakung, Jakarta Timur 13940</span>
            </li>
          </ul>
        </div>
        
        <div class="col-lg-3 col-md-4">
          <h5 class="mb-5" style="color: white;"></h5>
          <ul class="list-unstyled">
            <li class="mb-3 d-flex align-items-center">
              <i class="fas fa-phone-alt me-2 mt-1" style="color: white;"></i>
              <span style="color: rgba(255,255,255,0.8);">(021) 4683137</span>
            </li>
            <li class="mb-3 d-flex align-items-center">
              <i class="fas fa-envelope me-2" style="color: white;"></i>
              <span style="color: rgba(255,255,255,0.8);">ikakobar728@gmail.com</span>
            </li>
          </ul>
        </div>
      </div>
      
      <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
      
      <div class="row">
        <div class="col-md-6 text-center text-md-start">
          <p class="mb-0" style="color: rgba(255,255,255,0.8);">&copy; 2025 PT. Kobar Indonesia. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Back to Top Button -->
  <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Back to top button
    $(window).scroll(function() {
      if ($(this).scrollTop() > 300) {
        $('.back-to-top').addClass('active');
      } else {
        $('.back-to-top').removeClass('active');
      }
    });
    
    $('.back-to-top').click(function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop: 0}, 300);
    });
    
    // Smooth scrolling for navigation links
    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          event.preventDefault();
          $('html, body').animate({
            scrollTop: target.offset().top - 70
          }, 1000);
        }
      }
    });
    
    // Force display buttons if needed
    $(document).ready(function() {
      // Pastikan tombol terlihat
      setTimeout(function() {
        $('.btn-nav-kobar').each(function() {
          $(this).css({
            'display': 'inline-block',
            'visibility': 'visible',
            'opacity': '1'
          });
        });
      }, 100);
    });
  </script>
</body>
</html>