<!-- resources/views/emails/postRegistration.blade.php -->
@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Validation de votre adresse mail</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour {{ $user->firstname }} {{ $user->lastname }}<br />
				Vous avez créé votre compte VinoTeam ! <br /><br />
				Avant de continuer, merci valider votre adresse en cliquant sur le lien de confirmation suivant :</a><br />
				<br />
				<a href="{{ url('/users/'.$user->id.'/activateAccount/') }}">{{ url('/users/'.$user->id.'/activateAccount/') }}</a></p>
@endsection
