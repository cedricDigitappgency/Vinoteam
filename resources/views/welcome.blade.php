@extends('layouts.app')

@section('log')
@endsection
@section('sign')
@endsection
@section('how')
@endsection

@section('content')
<!-- Start Home Page Slider -->
    <section id="home">
      <!-- Carousel -->
      <div id="main-slide" class="carousel slide" data-ride="carousel">

        <!-- Carousel inner -->
        <div class="carousel-inner">
          <div class="item active">
            <img class="img-responsive" src="{{ URL::asset('/images/img-home.jpg') }}" alt="slider">
            <div class="slider-content">
              <div class="col-md-12 text-center">
                <h2><span class="amis">Prenez-en pour vos amis !</span></h2>
              </div>
            </div>
    </section>
    <!-- End Slider -->


  <!-- Start Call Action -->

<br/>
<div class="container">
  <div class="row">
    <div class="call-action call-action-boxed clearfix">
      <!-- Call Action Text -->
      <h2 class="primary col-md-10 col-sm-9 col-xs-12">L’achat groupé de vin devient facile ! Partagez vos bons plans vins. Centralisez les commandes de vos amis. Remboursez-vous de vos dépenses en un clic. <br />Faites des économies et faites-leur plaisir !</h2>
      <!-- Call Action Button -->
      <div class="button-side col-md-2 col-sm-3 col-xs-12" style="margin-top:4px;"><a href="{{ url('register') }}" class="btn btn-danger btn-large">Je m'inscris</a></div>
    </div>
  </div>
</div> <!-- End Call Action -->


    <!-- Start Services -->
    <div class="section service">
      <div class="container">
        <div class="row">

          <!-- Start Service 1 -->
          <div class="col-md-3 col-sm-6 service-box service-center">
            <img src="{{ URL::asset('/images/bouteille.png') }}">
            <div class="service-content"><br/>
                <p><strong>Quand vous avez un bon plan vin, partagez-le avec vos amis</strong> qui n’ont pas le temps ou ne savent pas quoi acheter.</p>
            </div>
          </div> <!-- End Service 1 -->


          <!-- Start Service 2 -->
          <div class="col-md-3 col-sm-6 service-box service-center" >
          <img src="{{ URL::asset('/images/money.png') }}">
            <div class="service-content"><br/>
                <p><strong>Cumulez les avantages</strong> en achetant plus : <strong>baisse des frais de port, bouteilles gratuites, cadeaux et réductions chez les marchands</strong>...</p>
            </div>
          </div> <!-- End Service 2 -->


          <!-- Start Service 3 -->
          <div class="col-md-3 col-sm-6 service-box service-center">
          <img src="{{ URL::asset('/images/fleches.png') }}">
            <div class="service-content"><br/>
                <p>Plus de prise de tête pour <strong>prendre les commandes</strong> ou <strong>récupérer l’argent</strong> ! Grâce à VinoTeam, vous êtes immédiatement remboursé par vos amis.</p>
            </div>
          </div>  <!-- End Service 3 -->


          <!-- Start Service Icon 4 -->
          <div class="col-md-3 col-sm-6 service-box service-center">
           <img src="{{ URL::asset('/images/cave.png') }}">
            <div class="service-content"><br/>
                <p><strong>Plus besoin de gérer le stock</strong> ! Chacun sait <strong>où sont ses bouteilles</strong> jusqu’à ce qu’il les récupère.</p>
            </div>
          </div><!-- End Service 4 -->
        </div> <!-- End .row -->
      </div> <!-- End .container -->
    </div>   <!-- End Services Section -->

     <!-- Start Video -->
    <div class="container">
        <div class="row">
          <hr/>
            <p class="exemple-red">VinoTeam, c'est facile ! Regardez :</p>
          <hr/>
          <iframe src="https://www.youtube.com/embed/dHbWs-v63UE" frameborder="0" allowfullscreen></iframe>
        </div><!-- End .row -->
    </div><!-- End .container -->

    <br/>
@endsection
