@extends('layouts.app')

@section('invite-friends')
active
@endsection

@section('content')
<div class="container">
	<hr/>
	<p class="exemple"><i class="fa fa-users" aria-hidden="true"></i> Inviter des amis</p>
	<hr/>

    <div class="row">
        <div class="col-md-12">
            <p align="center">
                <img src="{{ URL::asset('/images/vinoteam_animation.gif') }}" alt="VinoTeam" style="height:250px;margin-bottom:20px;">
            </p>
        </div>
        @if ($user->status == 'notverified')<!--<div class="col-md-12">
            <div class="alert alert-danger">
                Votre moyen de paiement n'est pas reconnu. Merci de vérifier votre saisie et d'enregistrer un IBAN valide dans la rubrique "<a href="{{ url('/users/paymentInfo') }}">Coordonnées bancaires</a>".
            </div>
        </div>-->@endif
        @if ($user->status == 'needactivation')
        <div class="col-md-12">
            <p align="center">
                Bienvenue {{ $user->firstname }} {{ $user->lastname }},<br />
            </p>
        </div>
        <div class="col-md-12">
            <div class="alert alert-warning">
                Pour vérifier vos coordonnés bancaires et en valider l’utilisation pour recevoir ou émettre des remboursements, vous devez cliquer sur le lien de validation qui vient de vous êtes envoyé par email.
            </div>
        </div>@endif
        @if (session('status'))<div class="col-md-12">
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        </div>@endif
        @if (session('alerts'))<div class="col-md-12">
            <div class="alert alert-danger">
                {{ session('alerts') }}
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
</div>
@endsection
