<!-- resources/views/emails/MissingUserMandate.blade.php -->
@extends('layouts.email')

@section('content')
    <h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Votre remboursement VinoTeam est en attente</h3>

    <p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour {{ $user->firstname }} {{ $user->lastname }} !<br />
     Il semblerait qu'un membre de votre VinoTeam vous ait remboursé.</p>

    <p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Pour que nous puissions transférer cette somme sur votre compte, vous devez <a href="{{ url('/users/paymentInfo') }}">saisir votre IBAN dans votre espace VinoTeam</a>.<br /> Faites-le sans attendre ! </p>
@endsection
