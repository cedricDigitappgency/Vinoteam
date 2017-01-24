@extends('layouts.app')

@section('log')
@endsection
@section('sign')
@endsection
@section('how')
@endsection

@section('content')

<div class="container">

    <hr/>
    <p class="exemple"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp; Remboursement</p>
    <hr/>

    <div class="row">
        <div class="col-md-12">
            <p align="center">
                Bravo {{ $user->firstname }} {{ $user->lastname }}, vous avez remboursé votre ami !<br />
            </p>
            <p align="center">
                <img src="{{ URL::asset('/images/vinoteam_animation.gif') }}" alt="VinoTeam" style="height:250px;margin-bottom:20px;">
            </p>
        </div>

        <div class="col-md-12">
    		<div class="col-lg-12 col-md-12 col-sm-12">
                <img src="http://dev.vinoteam.fr/images/powered-by-mangopay.png">
    		</div>
        </div>
        <div class="col-md-12">
            <div class="col-md-12" style="margin-top:10px;">
    			<div style="clear:both;"></div>
    		</div>
    	</div>
    </div>
</div>
@endsection
