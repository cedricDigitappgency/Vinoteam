<!-- resources/views/emails/postCreateRelationship.blade.php -->
@extends('layouts.email')

@section('content')
    <h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Votre VinoTeam s’agrandit.</h3>

    <p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour @if($invitedUser->firstname != ""){{ $invitedUser->firstname }} {{ $invitedUser->lastname }}@else{{ $invitedUser->email }}@endif.<br />
    {{ $user->firstname }} {{ $user->lastname }} vous a ajouté à sa VinoTeam !<br />Vous pouvez maintenant le rembourser ou lui demander des remboursements pour vos achats de vins groupés.
    </p>

    @if( $bodyMessage )<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>
      Message de {{ $user->firstname }} {{ $user->lastname }} : <br />
      <em>{{ $bodyMessage }}</em>
    </p>@endif
@endsection
