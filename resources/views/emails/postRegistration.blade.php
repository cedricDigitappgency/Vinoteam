<!-- resources/views/emails/postRegistration.blade.php -->
@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Confirmation d’inscription</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour {{ $user->firstname }} {{ $user->lastname }}<br />
				Bienvenue dans votre VinoTeam !<br /><br />
				Nous vous confirmons la création de <a href="{{ url('home') }}">votre espace VinoTeam</a><br />
				<br />
				Veuillez trouver ci-dessous les identifiants vous permettant de vous y connecter :<br />
				<br />
				Identifiant : {{ $user->email }}<br />
				Mot de passe : vous seul le connaissez<br />
				<br />
				Achetez du vin entre amis, et remboursez-vous en un clic !</p>
@endsection