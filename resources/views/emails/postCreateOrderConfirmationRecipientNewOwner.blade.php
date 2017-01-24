<!-- resources/views/emails/postRegistration.blade.php -->
@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Rejoignez la Vinoteam de {{ $order->buyer->firstname }} {{ $order->buyer->lastname }}</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>
					{{ $order->buyer->firstname }} {{ $order->buyer->lastname }} vous a acheté du bon vin ! </p>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Pour {{ $order->buyer->gender == 'M' ? 'le' : 'la'}} rembourser, il suffit de rejoindre sa VinoTeam. Cliquez sur le bouton « S’inscrire » ci-dessous pour rejoindre la VinoTeam de {{ $order->buyer->firstname }} {{ $order->buyer->lastname }}</p>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6' align="center">

					<a href="{{ $link = url('register/').'?parentId='.$order->buyer->id.'&userId='.$order->owner->id }}" target="_blank" class="btn" style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;color:#d54541;background-color:#F89406;font-size:14px;padding:9px 22px;color:#fff;font-weight:300;border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;v-o-border-radius:3px;transition:all 0.3s ease-in-out;-moz-transition:all 0.3s ease-in-out;-webkit-transition:all 0.3s ease-in-out;-o-transition:all 0.3s ease-in-out;font-weight:400;text-decoration:none;cursor:pointer;display:inline-block'>S'inscrire</a>
                                        <br />Montant total de {{ $priceWtax = number_format($order->price*1, 2, '.', '') }}€
                                </p>
                                @if( $order->message )<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>
					Message de {{ $order->buyer->firstname }} {{ $order->buyer->lastname }} : <br />
					<em>{{ $order->message }}</em>
				</p>@endif
				@if($order->order_items)<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>
					@foreach ($order->order_items as $item)
					@if( isset($item->wine_id) && $item->wine_id != null)
                  	<div style="text-align:left; width:auto;">
	                    <button style="text-align:left; border:#d4d4d4 2px solid; background-color:#FFFFFF; width:100%;" type="button" data-toggle="modal" data-target="#addNewWine">
	                    <div style="display: inline-block; vertical-align: middle;float: none;">
	                    	<img id="img_mini" src="{{ ($item->wine->file_id == 0 || $item->wine->file->path == null) ? url('/images/bouteille-vinoteam.png') : 'https://storage.googleapis.com/vino-team.appspot.com/storage'.$item->wine->file->path }}" style="max-width:200px; max-height:100px;">
	                    </div>

	                    <div style=" font-size:12px; display: inline-block; vertical-align: middle;float: none; text-align:left; color:#d54541;">
	                        <div id="name_cru_mini">{{ $item->wine->name_cru }}</div>
	                        <br/>
	                        <div id="year_mini">{{ $item->wine->year }}</div>
	                        <br/>
	                        <div id="productor_mini">{{ $item->wine->productor }}</div> <br/>
	                        <div id="region_mini">{{ $item->wine->region }}</div><br/>
	                        <div id="region_mini">{{ $item->quantity }} bouteille(s)</div>
	                    </div>
	                    </button>
					</div>
					<br/>
					@endif
					@endforeach
					<br />
				</p>@endif
				<!--<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Détail du paiement
					<table style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;width:100%;text-align:center;text-align:center;'>
					   <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;background-color:#d54541; color:#FFF; font-weight:bold;'>
					      <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;padding:10px;'>Détail</td>
					      <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>Montant</td>
					   </tr>
					   <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
					      <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>Remboursement de votre ami</td>
					      <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>{{ $order->price }}€</td>
					   </tr>
					   <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif' style="background-color:#f1f2f2">
					      <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>Frais de gestion</td>
					      <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>{{ number_format($order->price*0.035, 2, '.', '') }}€</td>
					   </tr>
					  <tr style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>
					      <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'><strong>Total</strong></td>
					      <td style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif'>{{ $priceWtax }}€</td>
					   </tr>
					</table>
				</p>-->

@endsection
