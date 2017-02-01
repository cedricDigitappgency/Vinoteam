<!-- resources/views/emails/postRegistration.blade.php -->
@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Validez votre compte VinoTeam</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour {{ $user->email }},<br />
				Vous avez complété vos coordonnées, mais vous n’avez pas validé l’ouverture de votre compte VinoTeam. Cliquez sur le lien ci-dessous pour confirmer votre adresse de mail : <a href="{{ url('/users/'.$user->id.'/activateAccount/') }}">{{ url('/users/'.$user->id.'/activateAccount/') }}</a></p>
        <p>Achetez groupé avec votre VinoTeam, et faites des économies !</p>
@endsection
