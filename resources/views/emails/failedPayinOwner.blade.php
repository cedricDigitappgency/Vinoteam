@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Paiement refusé !</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour {{ $owner->firstname }} {{ $owner->lastname }},<br />
					Le remboursement numéro {{ $order->id }} effectué le {{ date('d-m-Y', strtotime($order->created_at)) }} par {{ $buyer->firstname }} {{ $buyer->lastname }} n'a pas été accepté par sa banque.<br />
					{{ $buyer->firstname }} {{ $buyer->lastname }} doit effectué un nouveau remboursement afin de valider ce dernier. <br />
					A bientôt sur VinoTeam !</p>
@endsection