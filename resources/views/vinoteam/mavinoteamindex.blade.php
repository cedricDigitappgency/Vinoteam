@extends('layouts.app')

@section('vinoteam')
active
@endsection

@section('content')
<div class="container">
	<hr/>
	<p class="exemple"><i class="fa fa-users" aria-hidden="true"></i> Ma VinoTeam</p>
	<hr/>

  <div class="row">
    @if (session('status'))<div class="col-md-12">
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
  </div>@endif
  @if (session('errors'))<div class="col-md-12">
      <div class="alert alert-danger">
          {{ session('errors') }}
      </div>
  </div>@endif

  	<div class="col-lg-12 col-md-12 col-sm-12">
      <p align="center">
        <a href="{{ url('/ma-vinoteam/rechercher-un-ami') }}" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i> Rechercher des amis</a>
	      <a href="{{ url('/ma-vinoteam/inviter-des-amis') }}" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> Inviter des amis</a>
      </p>
    </div>

		@if( count($friends) == 0 )
		<div class="col-md-12" style="margin-top:20px;">
				<div class="alert alert-info">
						Vous n'avez pas encore d'amis dans votre VinoTeam.
				</div>
		</div>
		@else
    <div class="col-lg-12 col-md-12 col-sm-12">
      <table class="table table-striped" style="margin-top:20px;">
          <thead>
              <tr class="redtable">
                <th class="text-center">Prénom</th>
                <th class="text-center">Nom</th>
                <th class="text-center">Courriel</th>
                <th class="text-center">Action(s)</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($friends as $friend)<tr>
							@if($friend)
              <td>@if($friend->emailValidate == 1) {{ $friend->firstname }} @endif</td>
              <td>@if($friend->lastname != '') {{ $friend->lastname }} @endif</td>
              <td>{{ $friend->email }}</td>
              <td>@if($friend->firstname == '' && $friend->lastname == '')<a href="{{ url('/ma-vinoteam/supprimer-un-ami/'.$friend->id) }}">Supprimer de ma VinoTeam</a>@endif</td>
							@endif
            </tr>@endforeach
          </tbody>
      </table>
		</div>
		@endif
	</div>
</div>
@endsection
