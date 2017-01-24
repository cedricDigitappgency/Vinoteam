@extends('layouts.app')

@section('userAccount')
active
@endsection

@section('content')

<div id="container">

    <hr/>
    <p class="exemple">Vous avez créé votre compte VinoTeam !</p>
    <hr/>

    <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6">
              <a href="#"><img src="{{ URL::asset('/images/julie.gif') }}"></a>
          </div>

          <div class="col-md-6 col-sm-6">
              <div class="call-action call-action-boxed clearfix">
                    <!-- Call Action Text -->
                    <h2 class="primary">Vous avez créé votre compte VinoTeam ! Avant de continuer, merci valider votre inscription en cliquant sur le lien de confirmation qui vient de vous être envoyé par mail. </h2>
                     <!-- Call Action Button -->
              </div>
          </div>
        </div>
        <hr/>
    </div>
</div>
@endsection
