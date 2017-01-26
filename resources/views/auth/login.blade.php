@extends('layouts.app')

@section('log')
active
@endsection
@section('sign')
@endsection
@section('how')
@endsection

@section('content')
<div id="container">

    <hr/>
    <p class="exemple">SE CONNECTER</p>
    <hr/>

    <div class="container">
        <div class="row">
            @if (session('error_message'))<div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('error_message') }}
                </div>
            </div>@endif
            <div class="col-md-12">
                <form role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" id="email" name="email" value"{{ old('email') }}" placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Mot de passe">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="form-group">
                        <div>
                        <!-- <div class="checkbox"> -->
                            <input type="checkbox" name="remember"> Se souvenir de moi
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i> S'identifier
                            </button>
                        </div>
                        <div class="col-md-12 text-center">
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Mot de passe oublié ?</a>
                            <a class="btn btn-link" href="{{ url('/register') }}">Pas de compte ?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr/>
    </div>
</div>

@endsection
