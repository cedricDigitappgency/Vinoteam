<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="VinoTeam">

    <title>Vinoteam</title>
    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css') }}" type="text/css" media="screen">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css') }}" type="text/css" media="screen">
    <!-- Font Lato -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{URL::asset('css/slicknav.css') }}" type="text/css" media="screen">
    <!-- CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/style.css') }}" media="screen">
    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/responsive.css') }}" media="screen">
    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/color.css') }}" title="red" media="screen" />
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/chosen.min.css') }}" media="screen">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <script type="text/javascript" src="{{URL::asset('js/jquery-2.1.4.min.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.migrate.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/modernizrr.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.fitvids.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/nivo-lightbox.min.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.isotope.min.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.appear.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/count-to.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.textillate.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.lettering.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.easypiechart.min.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.parallax.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/mediaelement-and-player.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/jquery.slicknav.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/chosen.jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.ui.datepicker-fr.js') }}"></script>

    <meta property="og:title" content="VinoTeam | Prenez-en pour vos amis!">
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Foires aux vins, salon, visite chez un vigneron, bon plan sur internet, dégustation chez un caviste… Demandez à vos amis s’ils veulent que vous leur achetiez du vin ! Achetez-en plus et cumulez les avantages… en leur rendant service !">
    <meta property="og:image" content="{{ URL::asset('/images/facebook_share_picture.jpg') }}">
    <meta property="og:image:height" content="164">
    <meta property="og:image:width" content="230">

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}-->

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-84088503-1', 'auto');
      ga('send', 'pageview');
    </script>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
  </style>
</head>

<!-- <body id="app-layout" style="overflow:hidden;"> -->
<body id="app-layout">

    <div id="container">
    <div class="hidden-header"></div>
    <header class="clearfix">

      <!-- Start Top Bar -->
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
            </div>

            <div class="col-md-5">
              <!-- Social -->
              <ul class="social-list">
                <li>
                  <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="https://www.facebook.com/VinoTeam/" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="https://twitter.com/vinoteam" target="_blank"><i class="fa fa-twitter"></i></a>
                </li>

              </ul>
            </div><!-- End Social -->
          </div> <!-- End .row -->
        </div> <!-- End .container -->
      </div>  <!-- End .top-bar -->

       <!-- Start Logo et Menu  -->
      <div class="navbar navbar-default navbar-top">
        <div class="container">
          <div class="navbar-header">
            <!-- Start Toggle Nav Link For Mobiles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
            <!-- End Toggle Nav Link For Mobiles -->
            <a class="navbar-brand" href="{{ url('/') }}">
              <img class="logo" alt="" src="{{URL::asset('images/logo.png') }}">
            </a>
          </div>
          <div class="navbar-collapse collapse">

            <!-- Start Menu Liste -->
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
              <!--<li>
                <a class="@yield('sign')" href="{{ url('/register') }}">S'inscrire</a>
              </li>-->
              <li>
                <a class="@yield('comment-ca-marche')" href="{{ url('comment-ca-marche?tab=comment-ca-marche') }}">Comment ça marche ?</a>
              </li>
              <li>
                <a class="@yield('log')" href="{{ url('/login') }}">Se connecter</a>
              </li>
              @else
              @if (Auth::user()->emailValidate == 1)
              <li>
                <a class="@yield('comment-ca-marche')" href="{{ url('comment-ca-marche') }}">Comment ça marche ?</a>
              </li>

              <li>
                <a class="@yield('remboursements')" href="#">Remboursements</a>
                <ul class="dropdown">
                  <li><a class="@yield('rmb-amoi')" href="{{ url('/orders/mesdemandesderemboursement') }}">Demander un remboursement</a></li>
                  <li><a class="@yield('rmb-amesamis')" href="{{ url('/orders/remboursementsamavinoteam') }}">Rembourser un ami</a></li>
                </ul>
              </li>
              <li>
                <a class="@yield('vinocave')" href="#">Vinocave</a>
                <ul class="dropdown">
                  <li><a class="@yield('vino-mesvins')" href="{{ url('/houses/mesvins') }}">Ma Vinocave</a></li>
                  <li><a class="@yield('vino-mesamis')" href="{{ url('/houses/lesvinsdemesamis') }}">Vinocave de mes amis</a></li>
                </ul>
              </li>
              <li>
                <a class="@yield('ma-vinoteam')" href="#">Ma VinoTeam</a>
                <ul class="dropdown">
                  <li><a class="@yield('vinoteam')" href="{{ url('/ma-vinoteam') }}">Ma VinoTeam</a></li>
                  <li><a class="@yield('bon-plan')" href="{{ url('/proposer-un-bon-plan') }}">Proposer un bon plan</a></li>
                </ul>
              </li>
              <li>
                <a class="@yield('userAccount')" href="#">Mon compte</a>
                <ul class="dropdown">
                  <li><a class="@yield('editProfile')" href="{{ url('/users/'.Auth::user()->id.'/edit') }}">Profil</a></li>
                  <li><a class="@yield('editPaymentInfo')" href="{{ url('users/paymentInfo') }}">Coordonnées bancaires</a></li>
                  <li><a href="{{ url('logout') }}">Déconnexion</a></li>
                </ul>
              </li>
              @else
              <li>
                <a class="@yield('userAccount')" href="#">Mon compte</a>
                <ul class="dropdown">
                  <li><a href="{{ url('/users/profile') }}">Profil</a></li>
                  <li><a href="{{ url('logout') }}">Déconnexion</a></li>
                </ul>
              </li>
              @endif
              @endif
            </ul>
            <!-- End Menu Liste -->
          </div>
        </div>

        <!-- Mobile Menu Start -->
        <ul class="wpb-mobile-menu">
            @if(Auth::guest())
          <!--<li>
            <a class="@yield('sign')" href="{{ url('/register') }}">S'inscrire</a>
          </li>-->
          <li>
            <a class="@yield('comment-ca-marche')" href="{{ url('comment-ca-marche?tab=comment-ca-marche') }}">Comment ça marche ?</a>
          </li>
          <li>
            <a class="@yield('log')" href="{{ url('/home') }}">Se connecter</a>
          </li>
          @else
          <li>
            <a class="@yield('comment-ca-marche')" href="{{ url('comment-ca-marche') }}">Comment ça marche ?</a>
          </li>

          <li>
            <a class="@yield('remboursements')" href="#">Remboursements</a>
            <ul class="dropdown">
              <li><a class="@yield('rmb-amoi')" href="{{ url('/orders/mesdemandesderemboursement') }}">Demander un remboursement</a></li>
              <li><a class="@yield('rmb-amesamis')" href="{{ url('/orders/remboursementsamavinoteam') }}">Rembourser un ami</a></li>
            </ul>
          </li>
          <li>
            <a class="@yield('vinocave')" href="#">Vinocave</a>
            <ul class="dropdown">
              <li><a class="@yield('vino-mesvins')" href="{{ url('/houses/mesvins') }}">Ma Vinocave</a></li>
              <li><a class="@yield('vino-mesamis')" href="{{ url('/houses/lesvinsdemesamis') }}">Vinocave de mes amis</a></li>
            </ul>
          </li>
          <li>
            <a class="@yield('vinocave')" href="#">Ma VinoTeam</a>
            <ul class="dropdown">
              <li><a class="@yield('vinoteam')" href="{{ url('/ma-vinoteam') }}">Ma VinoTeam</a></li>
              <li><a class="@yield('bon-plan')" href="{{ url('/proposer-un-bon-plan') }}">Proposer un bon plan</a></li>
            </ul>
          </li>
          <li>
            <a class="@yield('userAccount')" href="#">Mon compte</a>
            <ul class="dropdown">
              <li><a class="@yield('editProfile')" href="{{ url('/users/'.Auth::user()->id.'/edit') }}">Profil</a></li>
              <li><a class="@yield('editPaymentInfo')" href="{{ url('users/'.Auth::user()->id.'/paymentInfo/edit') }}">Coordonnées bancaires</a></li>
              <li><a href="{{ url('logout') }}">Déconnexion</a></li>
            </ul>
          </li>
          @endif
        </ul> <!-- End Mobile Menu -->
      </div>  <!-- End Header Logo et Menu -->
    </header>  <!-- End Header Section -->

    @yield('content')

    <footer>
      <div class="container">
        <div class="row footer-widgets">

          <!-- Start Colonne 1 -->
          <div class="col-md-6 col-xs-6">
             <img src="{{URL::asset('images/logo-footer.png') }}" class="img-responsive" alt="Footer Logo" />
          </div>
          <!-- End Colonne 1 -->

          <!-- Start Colonne social -->
          <div class="col-md-6 col-xs-6">
            <div class="footer-widget social-widget">
              <ul class="social-icons">
                <li>
                  <a class="facebook" href="https://www.facebook.com/VinoTeam/" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a class="twitter" href="https://twitter.com/vinoteam" target="_blank"><i class="fa fa-twitter"></i></a>
                </li>
              </ul>
            </div>
          </div> <!-- End Colonne Social -->
        </div> <!-- .row -->


        <!-- Start Copyright -->
        <div class="copyright-section">
          <div class="row">
            <div class="col-md-6">
              <p>&copy; 2016 VinoTeam - Version 2</p>
            </div>

            <div class="col-md-6">
              <ul class="footer-nav">
                <li><a href="{{ url('/comment-ca-marche') }}">Comment ça marche ?</a>
                </li>
                <li><a href="{{ url('/comment-ca-marche?tab=contact') }}">Contact</a>
                </li>

              </ul>
            </div>

          </div>  <!-- .row -->

        </div> <!-- End Copyright -->
      </div><!-- End .container -->
    </footer> <!-- End Footer -->

  </div> <!-- End Body Container -->

  <!-- Go To Top  -->
  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <div id="loader">
    <div class="spinner">
      <div class="dot1"></div>
      <div class="dot2"></div>
    </div>
  </div>

  <script type="text/javascript" src="{{URL::asset('js/script.js') }}"></script>


   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}-->
</body>
</html>
