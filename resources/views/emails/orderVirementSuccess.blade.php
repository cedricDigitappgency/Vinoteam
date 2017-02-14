<!-- resources/views/emails/orderFailed.blade.php -->
@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Demande de remboursement réglée!</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour {{ $order->buyer->firstname }} {{ $order->buyer->lastname }}<br />
				{{ $order->owner->firstname }} {{ $order->owner->lastname }} vient de régler votre demande de remboursement en date du {{ date('d-m-Y', strtotime($order->created_at)) }}.<br />Vous allez recevoir l'argent sur votre compte dans quelques jours.</p>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Merci d'utiliser les services de VinoTeam.</p>
@endsection
