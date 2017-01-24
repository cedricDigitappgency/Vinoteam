<!-- resources/views/emails/postRegistration.blade.php -->
@extends('layouts.contact')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Contact Vinoteam</h3>
				<h4> {{ $request->firstname }} {{ $request->lastname }} a envoyé le message suivant : <br />
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'><br />
				{{ $request->message }}
@endsection