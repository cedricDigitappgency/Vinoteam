@extends('layouts.app')

@section('vinoteam')
active
@endsection

@section('content')
<div class="container">
	<hr/>
	<p class="exemple"><i class="fa fa-users" aria-hidden="true"></i> Rechercher un membre</p>
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

    @if( count($results) == 0 )
		<div class="col-md-12">
				<div class="alert alert-info">
						Aucun résultat pour cette recherche.
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
            @foreach ($results as $friend)<tr>
              <td>{{ $friend->firstname }}</td>
              <td>{{ $friend->lastname }}</td>
              <td>{{ $friend->email }}</td>
              <td>@if($friend->firstname == '' && $friend->lastname == '')<a href="{{ url('/ma-vinoteam/supprimer-un-ami/'.$friend->id) }}'">Supprimer de ma VinoTeam</a>@endif</td>
            </tr>@endforeach
          </tbody>
      </table>
		</div>
		@endif

	</div>
</div>
@endsection
