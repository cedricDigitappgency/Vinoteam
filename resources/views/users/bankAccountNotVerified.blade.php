@extends('layouts.app')

@section('userAccount')
active
@endsection

@section('content')

<div id="container">

    <hr/>
    <p class="exemple">Valider vos coordonnées bancaires</p>
    <hr/>

    <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6">
              <a href="#"><img src="{{ URL::asset('/images/julie.gif') }}"></a>
          </div>

          <div class="col-md-6 col-sm-6">
              <div class="call-action call-action-boxed clearfix">
                    <!-- Call Action Text -->
                    <!-- <h2 class="primary">Pour vérifier vos coordonnés bancaires et en valider l’utilisation pour recevoir ou émettre des remboursements, vous devez cliquer sur le lien de validation qui vient de vous être envoyé par email.</h2> -->
                    <h2 class="primary">Pour valider vos coordonnés bancaires, vous devez impérativement <strong>cliquez</strong> sur le bouton "valider" dans les <strong>59 prochaines minutes</strong>.</h2>
                    @if(session('url'))<p align="center"><a href="{{ session('url') }}" target="_blank" class="btn btn-lg btn-primary"><i class="fa fa-btn fa-check"></i> Valider</a></p>@endif
                     <!-- Call Action Button -->
              </div>
          </div>
        </div>
        <hr/>
    </div>
</div>
@endsection
