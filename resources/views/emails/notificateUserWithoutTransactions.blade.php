<!-- resources/views/emails/postRegistration.blade.php -->
@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Vous manquez à VinoTeam</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour {{ $user->firstname }} {{ $user->lastname }},<br />
				@if($diffJours == 15)
				Déjà 15 jours que vous avez ouvert votre compte VinoTeam et vous ne vous en servez pas ? Vous pouvez inviter autant d’amis que vous le voulez à rejoindre votre VinoTeam et partager les bons plans.
				@else
				Déjà {{ $diffMois }} mois que vous avez ouvert votre compte VinoTeam et vous ne vous en servez pas ? Vous pouvez inviter autant d’amis que vous le voulez à rejoindre votre VinoTeam et partager les bons plans.
				@endif
				</p>
				<p>Achetez groupé avec votre VinoTeam, et faites des économies !</p>
@endsection
