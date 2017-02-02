<!-- resources/views/emails/postRegistration.blade.php -->
@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Demandez à votre VinoTeam de vous acheter du vin !</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour {{ $user->firstname }} {{ $user->lastname }},<br />
				Grâce à vos amis membres de votre VinoTeam, constituez votre cave sans vous prendre la tête. Demandez-leur de partager leurs bons plans et de vous acheter du bon vin quand ils en ont l’occasion. Avec VinoTeam, rien de plus simple pour les commandes, les remboursements et savoir où sont les bouteilles qu’ils vous ont achetées.</p>
				<p>Achetez groupé avec votre VinoTeam, et faites des économies ! </p>
@endsection
