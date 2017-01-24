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
      <h2 class="primary col-md-10 col-sm-9 col-xs-12">Remboursez-vous en un clic. Gérez facilement vos bouteilles et celles de vos proches.<br/>Faites-vous plaisir et rendez service à vos amis !</h2>
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
                <p>Foires aux vins, salons vignerons, vente flash sur internet… Quand vous avez un bon plan, <b>achetez du vin pour vos proches</b> qui n’ont pas le temps ou ne savent pas quoi acheter.</p>

            </div>
          </div> <!-- End Service 1 -->
         

          <!-- Start Service 2 -->
          <div class="col-md-3 col-sm-6 service-box service-center" >
          <img src="{{ URL::asset('/images/money.png') }}">
            <div class="service-content"><br/>
                <p>En achetant en plus grande quantité, <b>vous avez des avantages</b> : frais de port réduits, bouteilles gratuites, cadeaux et réductions chez les marchands… et surtout, vous <b>rendez service à vos amis !</b>
                </p>
            </div>
          </div> <!-- End Service 2 -->
         

          <!-- Start Service 3 -->
          <div class="col-md-3 col-sm-6 service-box service-center">
          <img src="{{ URL::asset('/images/fleches.png') }}">
            <div class="service-content"><br/>
                <p>Avec VinoTeam, <b>les virements sont immédiats</b>. Demandez un remboursement. Votre ami le valide en un clic. Vous êtes prévenu du paiement. Plus de compta ni de <b>prise de tête pour récupérer l’argent !</b></p>
            </div>
          </div>  <!-- End Service 3 -->
          
          
          <!-- Start Service Icon 4 -->
          <div class="col-md-3 col-sm-6 service-box service-center">
           <img src="{{ URL::asset('/images/cave.png') }}">
            <div class="service-content"><br/>
                <p>Votre VinoCave partagée permet à chacun de <b>savoir où sont ses bouteilles</b> jusqu’à ce qu’il les récupère. Plus besoin de gérer le stock !</p>
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
