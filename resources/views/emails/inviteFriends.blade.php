<!-- resources/views/emails/inviteFriend.blade.php -->
@extends('layouts.email')

@section('content')
    <h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Vos amis vous attendent sur VinoTeam.</h3>

    <p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour !<br />
    {{ $user->firstname }} {{ $user->lastname }} vous invite à rejoindre sa VinoTeam ! Inscrivez-vous dès maintenant sur VinoTeam en cliquant sur le bouton ci-dessous : </p>
    <p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6' align="center">
	<a href="{{ $link = url('register/').'?parentId='.$user->id.'&userId='.$newUser->id }}" target="_blank" class="btn" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;color:#d54541;background-color:#F89406;font-size:14px;padding:9px 22px;color:#fff;font-weight:300;border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;v-o-border-radius:3px;transition:all 0.3s ease-in-out;-moz-transition:all 0.3s ease-in-out;-webkit-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;font-weight:400;text-decoration:none;cursor:pointer;display:inline-block'>S'inscrire</a>
    </p>

    @if( $bodyMessage )<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>
      Message de {{ $user->firstname }} {{ $user->lastname }} : <br />
      <em>{{ $bodyMessage }}</em>
    </p>@endif

    <p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Vous allez pouvoir acheter du vin pour vos amis ou leur demander de vous en acheter sans prise de tête pour les remboursements !<br />
    Pour savoir comment ça marche, vous pouvez consulter <a href="https://www.youtube.com/watch?v=dHbWs-v63UE">notre video de présentation</a>.</p>
@endsection
