<!-- resources/views/emails/postRegistration.blade.php -->
@extends('layouts.email')

@section('content')
				<h3 style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;font-family:"HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;line-height:1.1;margin-bottom:15px;color:#000;font-weight:500;font-size:27px'>Notification</h3>
				<p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'>Bonjour Vincent Chevrier.<br />
				{{ $user->email }} vient de s'inscrire à VinoTeam.</p>
        <p style='margin:0;padding:0;font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;margin-bottom:10px;font-weight:normal;font-size:14px;line-height:1.6'><ul>
          <li>Nombre d'inscrits : {{ $nb_users }}</li>
          <li>Nombre d'utilisateurs ayant validés leur compte : {{ $nb_users_actives }}</li>
        </ul></p>
@endsection
