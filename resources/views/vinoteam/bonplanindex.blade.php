@extends('layouts.app')

@section('bon-plan')
active
@endsection

@section('content')
<script src="{{ URL::asset('js/orders.js') }}" type="text/javascript"></script>

<div id="container">
  <hr/>
  <p class="exemple">Proposer un bon plan</p>
  <hr/>

  <div class="container">
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

    <div class="row">
      <div class="col-md-12">
        <form class="form" role="form" method="POST" action="{{ url('/proposer-un-bon-plan') }}">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('destinataires') ? ' has-error' : '' }}">
            <label for="destinataires">Destinataire(s) membre(s) de ma VinoTeam :</label>
            <select id="destinataires" autocomplete="off" type="text" class="form-control chosen-select" name="destinataires[]" multiple="multiple" data-placeholder="Destinataire(s) membre(s) de ma VinoTeam">
              @foreach($friends as $user)
              @if($user->firstname == '' or $user->lastname == '')
              <option value="{{ $user->id }}">{{ $user->email }}</option>
              @else
              <option value="{{ $user->id }}">{{ $user->firstname . ' ' . $user->lastname }} ({{ $user->email }})</option>
              @endif
              @endforeach
            </select>

            @if ($errors->has('destinataires'))
            <span class="help-block">
                <strong>{{ $errors->first('destinataires') }}</strong>
            </span>
            @endif
          </div>

          <div class="form-group">
            <label for="newUsers">Destinataire(s) non membre(s) de ma VinoTeam (séparer les emails avec une virgule) :</label>
            <input id="newUsers" type="text" autocomplete="off" class="form-control" name="newUsers" value="" placeholder="Destinataire(s) non membre(s) de ma VinoTeam (séparer les emails avec une virgule)">

            @if ($errors->has('newUsers'))
            <span class="help-block">
                <strong>{{ $errors->first('newUsers') }}</strong>
            </span>
            @endif
          </div>

          <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
            <label for="message">Message :</label>
            <textarea id="message" class="form-control" name="message" rows="10" placeholder="Message..."></textarea>

            @if ($errors->has('message'))
            <span class="help-block">
                <strong>{{ $errors->first('message') }}</strong>
            </span>
            @endif
          </div>

          <div class="form-group">
              <div style="text-align:center;">
                  <button type="submit" class="btn btn-primary">
                      <i class="fa fa-btn fa-user"></i> Envoyer le bon plan
                  </button>
              </div>
          </div>
        </form>
      </div>
    </div>

    <hr/>

  </div>
</div>
@endsection
