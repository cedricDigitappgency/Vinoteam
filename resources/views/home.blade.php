@extends('layouts.app')

@section('log')
@endsection
@section('sign')
@endsection
@section('how')
@endsection

@section('content')

<div class="container">

    <hr/>
    <p class="exemple"><i class="fa fa-home" aria-hidden="true"></i>Accueil</p>
    <hr/>

    <div class="row">
        <div class="col-md-12">
            <p align="center">
                Bienvenue {{ $user->firstname }} {{ $user->lastname }},<br />
            </p>
            <p align="center">
                <img src="{{ URL::asset('/images/vinoteam_animation.gif') }}" alt="VinoTeam" style="height:250px;margin-bottom:20px;">
            </p>
        </div>
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
        <div class="col-lg-6 col-md-6 col-sm-12">
            <form class="form" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/ma-vinoteam/inviter-des-amis/') }}">
                {{ csrf_field() }}

                <div class="form-group">
	              	<div class="col-md-12">
	                  	<input id="email" type="text" autocomplete="off" class="form-control" name="email" value="" placeholder="Email du destinataire">
	                  </div>
	              </div>

	              <div class="form-group">
	              	<div class="col-md-12" style="margin-top:10px;">
	                  	<textarea id="message" type="text" autocomplete="off" class="form-control" name="message" placeholder="Laissez leur un message"></textarea>
	                  </div>
	              </div>

                <div class="form-group">
                    <div class="col-md-12" style="margin-top:10px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i> Inviter mes amis
                        </button>
                    </div>
                </div>
            </form>
            <p>
                <em>Séparez les adresses e-mail par des virgules.</em>
            </p>
            <div style="clear:both;"></div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12" style="margin-top:10px;">
			<a class="btn btn-large share-btn btn-facebook btn-block" title="Facebook" href="http://www.facebook.com/sharer.php?u={{ url('/register?parentId='.$user->id) }}" data-facebook-share-link="{{ url('/register?parentId='.$user->id) }}" target="_blank">
				<i class="icon icon-facebook"></i>
				<span>Facebook</span>
			</a>
		</div>
<!-- 		<div class="col-lg-6 col-md-6 col-sm-12" style="margin-top:10px;">
			<div class="input-addon">
				<span class="input-prefix input-large text-center">
					<span>Lien de parrainage</span>
				</span>
				<input class="input-stem input-large" type="text" value="{{ url('/register?parentId='.$user->id) }}" readonly="">
			</div>
		</div> -->
        <div class="col-md-12" style="margin-top:10px;">
			<div style="clear:both;"></div>
		</div>
	</div>
        <!--
        <div class="col-md-12">
            <div class="col-md-6">
                <p align="center">
                    <a href="{{ url('/orders/') }}"><img src="{{ url('/images/fleches.png') }}" alt="Accès au demandes de remboursement"></a>
                </p>
                <p align="center">
                    Vous pouvez demander ou effectuer un remboursement en cliquant sur la page <a href="{{ url('/orders/') }}">remboursement</a>
                </p>
            </div>
            <div class="col-md-6">
                <p align="center">
                    <a href="{{ url('/houses/') }}"><img src="{{ url('/images/cave.png') }}" alt="Accès à VinoCave"></a>
                </p>
                <p align="center">
                    Vous pouvez jeter un oeil sur vos bouteilles ou celles de vos amis en cliquant sur la page <a href="{{ url('/houses/') }}">VinoCave</a>
                </p>
            </div>
        </div>
        -->
    </div>
</div>
@endsection
