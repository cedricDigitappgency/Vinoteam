@extends('layouts.app')

@section('userAccount')
active
@endsection


@section('content')
<hr/>
<p class="exemple"><i class="fa fa-user" aria-hidden="true"></i> Mon compte</p>
<hr/>

<!-- Start Slider -->
<section id="home">
	<div class="container">
  	<div class="row">
      @if (session('status'))<div class="col-md-12">
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      </div>@endif
      @if (session('errors'))<div class="col-md-12">
          <div class="alert alert-danger">
              {{ session('errors') }}
          </div>
      </div>@endif
      
  		<p>Vous pouvez effectuez les actions suviantes :</p>
	    <ul class="icons-list">
            <li><i class="icon-check-2"></i> <a href="{{ url('users/'.$user->id.'/edit') }}">Profil</a></li>
            <li><i class="icon-check-2"></i> <a href="{{ url('users/paymentInfo') }}">Coordonnées bancaires</a></li>
            <li><i class="icon-check-2"></i> <a href="{{ url('logout') }}">Déconnexion</a></li>
          </ul>
  	</div>
  </div>
</section>
@endsection
