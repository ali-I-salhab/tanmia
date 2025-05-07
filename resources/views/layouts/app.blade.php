<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>نظام إدارة المستفيدين</title>

  <!-- Fonts & Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<!-- Tajawal Arabic font -->
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- Bootstrap & AOS Animation -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Animate.css & Hover.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">

  <!-- Custom Styles -->
  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --accent-color: #4cc9f0;
      --dark-color: #1a1a2e;
      --light-color: #f8f9fa;
    }
    
    body {
      font-family: 'Tajawal', sans-serif;
      background-color: #f5f7fa;
      color: #333;
    }
    
    .navbar {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      padding: 0.8rem 1rem;
    }
    
    .navbar-brand {
      font-weight: 700;
      font-size: 1.8rem;
      background: linear-gradient(to right, #fff, #f8f9fa);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    
    .nav-link {
      font-weight: 500;
      margin: 0 0.5rem;
      position: relative;
    }
    
    .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      right: 0;
      background-color: var(--accent-color);
      transition: width 0.3s ease;
    }
    
    .nav-link:hover::after {
      width: 100%;
      right: auto;
      left: 0;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border: none;
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      background-color: var(--secondary-color);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
    }
    
    .table-responsive {
      border-radius: 12px;
      overflow: hidden;
    }
    
    .table {
      margin-bottom: 0;
    }
    
    .table thead th {
      background-color: var(--primary-color);
      color: white;
      font-weight: 500;
    }
    
    .table-hover tbody tr {
      transition: all 0.2s ease;
    }
    
    .table-hover tbody tr:hover {
      background-color: rgba(67, 97, 238, 0.05);
      transform: scale(1.01);
    }
    
    footer {
      background: linear-gradient(135deg, var(--dark-color), #16213e);
      color: white;
      padding: 2rem 0;
      margin-top: 3rem;
    }
    
    .social-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
      margin: 0 0.5rem;
      transition: all 0.3s ease;
    }
    
    .social-icon:hover {
      background-color: var(--accent-color);
      transform: translateY(-3px);
      color: white;
    }
    
    /* Custom animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .animate-fade-in-up {
      animation: fadeInUp 0.6s ease forwards;
    }
    
    /* Pulse animation for important actions */
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    
    .pulse {
      animation: pulse 2s infinite;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
      background: var(--primary-color);
      border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: var(--secondary-color);
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">
  <!-- Header -->
  <header class="header-section animate__animated animate__fadeInDown">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand hvr-grow" href="{{ route('index') }}">
          <i class="fas fa-hands-helping me-2"></i>
          Tanmia {{-- نظام تانية --}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link hvr-underline-from-center" href="">
                <i class="fas fa-users me-1"></i> المستفيدين
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link hvr-underline-from-center" href="{{ route('plans.index') }}">
                <i class="fas fa-project-diagram me-1"></i> المخططات
              </a>
            </li>
          </ul>
          
          <div class="d-flex">
            @auth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            <button class="btn btn-outline-light hvr-icon-wobble-horizontal" onclick="document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt hvr-icon me-1"></i> تسجيل الخروج
            </button>
            @endauth
            @guest
            <a class="btn btn-outline-light me-2 hvr-grow" href="{{ route('login') }}">
              <i class="fas fa-sign-in-alt me-1"></i> تسجيل الدخول
            </a>
            <a class="btn btn-primary hvr-grow" href="{{ route('register') }}">
              <i class="fas fa-user-plus me-1"></i> حساب جديد
            </a>
            @endguest
          </div>
        </div>
      </div>
    </nav>
  </header>

  <!-- Main Content -->
  <main class="flex-grow-1 py-4" data-aos="fade-in" data-aos-duration="800">
    <div class="container">
      @yield('content')
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-white py-4 mt-auto" data-aos="fade-up" data-aos-duration="800">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          <h5 class="mb-3"><i class="fas fa-hands-helping me-2"></i>
            Tanmia
            </h5>
          <p class="mb-0">منصة متكاملة لإدارة المستفيدين وتوزيع المساعدات بكفاءة</p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <div class="mb-3">
            <a href="#" class="social-icon hvr-grow"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon hvr-grow"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-icon hvr-grow"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon hvr-grow"><i class="fab fa-linkedin-in"></i></a>
          </div>
          <p class="mb-0">© {{ date('Y') }} جميع الحقوق محفوظة</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    // Initialize AOS animation
    AOS.init({
      once: true,
      duration: 800,
      easing: 'ease-out-quad'
    });
    
    // Add animation to table rows
    document.querySelectorAll('tbody tr').forEach((row, index) => {
      row.style.opacity = '0';
      row.style.transform = 'translateY(20px)';
      row.style.animation = `fadeInUp 0.5s ease forwards ${index * 0.1}s`;
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
    
    // Add pulse animation to important buttons
    document.querySelectorAll('.btn-primary, .btn-success').forEach(btn => {
      btn.addEventListener('mouseenter', () => {
        btn.classList.add('pulse');
      });
      btn.addEventListener('mouseleave', () => {
        btn.classList.remove('pulse');
      });
    });
  </script>

  @stack('scripts')
</body>
</html>