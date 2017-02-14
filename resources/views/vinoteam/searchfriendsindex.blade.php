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

  	<div class="col-lg-12 col-md-12 col-sm-12">
      <p>
        <form class="form" role="form" method="POST" action="{{ url('/ma-vinoteam/rechercher-un-ami') }}">
          {{ csrf_field() }}
        <!--
          <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
            <input autocomplete="off" type="text" class="form-control" name="search" value="{{ old('search') }}" placeholder="Adresse email...">
            @if ($errors->has('search'))
            <span class="help-block">
                <strong>{{ $errors->first('search') }}</strong>
            </span>
            @endif
          </div>
        -->
          <div class="row">
            <div class="col-md-6 col-sm-12 form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                <input id="firstname" autocomplete="off" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="Prénom...">
                    @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="col-md-6 col-sm-12 form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <input id="lastname" autocomplete="off" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Nom...">
                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
            </div>
        </div>

          <div class="form-group">
            <div class="col-md-4 col-md-offset-5">
              <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-user"></i> Rechercher
              </button>
            </div>
          </div>
        </form>
      </p>
    </div>

		@if( $search == 1 )
		@if( count($results) == 0 )
		<div class="col-md-12" style="margin-top:20px;">
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
              <td class="text-center">{{ $friend->firstname }}</td>
              <td class="text-center">{{ $friend->lastname }}</td>
              <td class="text-center">{{ $friend->email }}</td>
              <td class="text-center">@if($friend->firstname == '' && $friend->lastname == '')
								<a href="{{ url('/ma-vinoteam/supprimer-un-ami/'.$friend->id) }}">Supprimer de ma VinoTeam</a>
								@else
								@if( !$friend->isFriendOf )<a href="{{ url('/ma-vinoteam/ajouter-un-ami/'.$friend->id) }}">Ajouter à ma VinoTeam</a>@endif
							@endif</td>
            </tr>@endforeach
          </tbody>
      </table>
		</div>
		@endif
		@endif
	</div>
</div>
@endsection
