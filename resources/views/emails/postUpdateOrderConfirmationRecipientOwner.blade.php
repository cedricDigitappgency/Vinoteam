<!-- resources/views/emails/postRegistration.blade.php -->
@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Demande de remboursement</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour {{ $order->owner->firstname }} {{ $order->owner->lastname }}<br /><br />{{ $order->buyer->firstname }} {{ $order->buyer->lastname }} s’est apparemment trompé dans ses calculs, et a modifié la demande de remboursement qu’il vous a envoyé le {{ date('d-m-Y', strtotime($order->created_at)) }}.<br />Merci de ne pas tenir compte de la demande de remboursement que vous avez reçu à cette date et de rembourser cette demande modifiée.<br />Si vous avez un doute, vous pouvez rembourser directement depuis <a href="{{ url('/orders') }}">votre espace VinoTeam</a>.
				</p>

				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6' align="center">
					<a href="{{ $link = url('orders/').'/'.$order->id.'/payment/validate' }}" target="_blank" class="btn" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;color:#d54541;background-color:#F89406;font-size:14px;padding:9px 22px;color:#fff;font-weight:300;border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;v-o-border-radius:3px;transition:all 0.3s ease-in-out;-moz-transition:all 0.3s ease-in-out;-webkit-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;font-weight:400;text-decoration:none;cursor:pointer;display:inline-block'>REMBOURSER</a>
				</p>
@endsection
