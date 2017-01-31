<!-- resources/views/emails/orderFailed.blade.php -->
@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Le paiement n'a pas abouti</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour {{ $order->owner->firstname }} {{ $order->owner->lastname }}<br />
				La paiement de la demande de remboursement initié par {{ $order->buyer->firstname }} {{ $order->buyer->lastname }} en date du {{ date('d-m-Y', strtotime($order->created_at)) }} n'a pas abouti.</p>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Merci de bien vouloir réitérer l'opération.</p>
@endsection
