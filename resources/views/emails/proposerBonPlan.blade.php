<!-- resources/views/emails/proposerBonPlan.blade.php -->
@extends('layouts.email')

@section('content')
    <h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>{{ $user->firstname }} {{ $user->lastname }} vous propose un bon plan.</h3>

    @if( $bodyMessage )<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>
      Message de {{ $user->firstname }} {{ $user->lastname }} : <br />
      <em>{{ $bodyMessage }}</em>
    </p>@endif
@endsection
