<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Site Metas -->
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <title>Cryptop</title>

  <!-- slider stylesheet -->
  <!-- slider stylesheet -->
  <!-- Add this in your layout file in the <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet">
  <style type="text/css" id="operaUserStyle"></style>
</head>

<body class="d-flex flex-column min-vh-100">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
   
          <a class="navbar-brand" href="index.html">
            <span>
              TanmiA
            </span>
          </a>
          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item ">
                  <a class="nav-link" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
                </li>

                {{-- <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span>Wallet</span> <img src="images/wallet.png" alt="">
                  </a>
                </li> --}}
              
                @auth
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
                <button class="btn btn-danger" onclick="document.getElementById('logout-form').submit();">
                Logout
                </button>
              @endauth
        
                  @guest
                <!-- Show login and register links if not authenticated -->
                <li class="nav-item">
                  <a class="nav-link" href="{{route('login')}}"> Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('register')}}"> Sign Up</a>
                </li>
              @endguest
              </ul>
              <div class="user_option">
                <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                </form>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

  </div>

  <main class="flex-grow-1">
    @yield('content')
  </main>

  <!-- info section -->
  <footer class="custom_nav-container text-white py-4 mt-auto">
    <div class="container text-center">
        <p class="mb-2">© {{ date('Y') }} TanmiA — All Rights Reserved</p>
        <div class="d-flex justify-content-center">
            <a href="#" class="text-white mx-3" style="font-size: 1.5rem;">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-white mx-3" style="font-size: 1.5rem;">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-white mx-3" style="font-size: 1.5rem;">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="text-white mx-3" style="font-size: 1.5rem;">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
    </div>
</footer>



  <!-- end info_section -->

  <!-- footer section -->

  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- owl carousel script 
      -->
  <script type="text/javascript">
    $(".owl-carousel").owlCarousel({
      loop: true,
      margin: 0,
      navText: [],
      center: true,
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        1000: {
          items: 3
        }
      }
    });
  </script>
  <!-- end owl carousel script -->

  @stack('scripts')
</body>

</html>