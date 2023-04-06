<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">

    <title>Sistem Parkir</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('templatemo/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('templatemo/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('templatemo/css/templatemo-softy-pinko.css') }}">

    </head>

    <body>
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo">
                            <img src="{{ asset('images/dparagon.png') }}" width="20%" alt="Softy Pinko"/>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            @guest
                            <li><a href="{{ route('login') }}">Login</a></li>    
                            @endguest
                            @auth
                            <li><a href="{{ route('home') }}">Home</a></li>
                            @endauth
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header> 
    <!-- ***** Header Area End ***** -->

    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">

        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-sm-12">
                        <h1><strong>Stay With Style</strong></h1>
                        <p>Jaringan Kos Eksklusif Terbesar</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <section class="section padding-top-70 padding-bottom-0" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 align-self-center" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="{{ asset('images/dparagon.png') }}" class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-top-fix">
                    <div class="left-heading">
                        <h2 class="section-title">About US</h2>
                    </div>
                    <div class="left-text">
                        <p>D’PARAGON sejak 2010 merupakan Hospitality manajemen yang konsisten menyediakan tempat hunian sementara dalam bentuk Kost Eksklusif dan Guest House yang bernuansa nyaman, eksklusif dan berprivasi tinggi, untuk para pelanggannya. D ’PARAGON memiliki konsep hunian yaitu “ STAY WITH STYLE” kami berusaha memberikan produk layanan dan fasilitas hunian yang lebih mencerminkan gaya hidup modern masyarakat milenial yang eksklusif.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="hr"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->
    
    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="social">
                        <li><a href="https://www.facebook.com/promodparagon/"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/DParagonKost"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://id.linkedin.com/company/pt-royal-dparagon-land?original_referer=https%3A%2F%2Fwww.google.com%2F"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright">Copyright &copy; {{ date('Y') }} ROYAL DPARAGON LAND</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- jQuery -->
    <script src="{{ asset('templatemo/js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('templatemo/js/popper.js') }}"></script>
    <script src="{{ asset('templatemo/js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('templatemo/js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('templatemo/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('templatemo/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('templatemo/js/imgfix.min.js') }}"></script> 
    
    <!-- Global Init -->
    <script src="{{ asset('templatemo/js/custom.js') }}"></script>

  </body>
</html>