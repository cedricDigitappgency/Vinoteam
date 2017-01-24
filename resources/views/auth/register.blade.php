@extends('layouts.app')

@section('log')
@endsection
@section('sign')
active
@endsection
@section('how')
@endsection

@section('content')
<script src="{{ URL::asset('js/cities.js') }}" type="text/javascript"></script>

<div id="container">

    <hr/>
    <p class="exemple">Créez votre compte VinoTeam</p>
    <hr/>

    <div class="container">
          <div class="row">
            <div class="col-md-12">
                <form role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        @if ($datas['user'])
                        <input id="email" autocomplete="off" type="email" class="form-control" name="email" value="{{ $datas['user']->email }}">
                        @else
                        <input id="email" autocomplete="off" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="exemple@exemple.com">
                        @endif
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" autocomplete="off" type="password" class="form-control" name="password" placeholder="Mot de Passe">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input id="password-confirm" autocomplete="off" type="password" class="form-control" name="password_confirmation" placeholder="Confirmation Mot de Passe">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                    </div>


                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-5">
                            <input type="hidden" name="parent_id" value="{{ isset($datas['parentId']) ? $datas['parentId'] : '' }}">
                            <input type="hidden" name="user_id" value="{{ isset($datas['user']->id) ? $datas['user']->id : '' }}">

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Valider
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
