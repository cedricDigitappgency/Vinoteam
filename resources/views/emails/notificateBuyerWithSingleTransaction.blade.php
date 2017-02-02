<!-- resources/views/emails/postRegistration.blade.php -->
@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Achetez groupé et faites des économies !</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour {{ $user->firstname }} {{ $user->lastname }},<br />
					Vos amis veulent profiter de vos bons plans ! Pensez à proposer à vos amis de leur acheter du vin quand vous en avez l’occasion. En achetant groupé, vous pourrez négocier des remises auprès des vignerons, vous cumulerez des avantages chez les marchands, et vous réduirez dans tous les cas vos frais de port si vous vous faites livrer.</p>
				<p>Alors n’hésitez plus ! <a href="{{ url('/ma-vinoteam/inviter-des-amis') }}">Invitez des amis</a> à rejoindre votre VinoTeam, faites-leur plaisir en leur achetant du bon vin, et faites des économies !</p>
@endsection
