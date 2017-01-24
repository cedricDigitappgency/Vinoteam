<!-- resources/views/houses/index.blade.php -->

@extends('layouts.app')

@section('vinocave')
active
@endsection
@section('vino-mesamis')
active
@endsection

@section('content')
<!--<script src="{{ URL::asset('js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>-->
<script src="{{ URL::asset('js/orders.js') }}" type="text/javascript"></script>
<div id="container">

    <hr/>
    <p class="exemple"><i class="fa fa-glass" aria-hidden="true"></i> VinoCave de mes amis</p>
    <p class="text-center">
        (Les vins de vos amis que vous gardez chez vous)
    </p>
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

            @if( $houses_count == 0)
            <div class="col-md-6 col-sm-6">
              <div class="call-action call-action-boxed clearfix">
                <!-- Call Action Text -->
                <h2 class="primary">Pour l'instant, vous ne gardez pas de vin pour vos amis.</h2>
                <!-- Call Action Button -->
                <br/>
                <div style="margin-top:4px;"><a href="{{ url('/houses/buyer/create') }}" class="btn-system btn-large">Garder du vin pour mes amis</a></div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <a href="#"><img src="{{ URL::asset('/images/fred.gif') }}"></a>
            </div>
            @else
            <div class="col-md-12">
                <p class="text-center">
                    <a href="{{ url('/houses/buyer/create') }}" class="btn btn-primary">Ajout manuel d'un vin à la VinoCave de mes amis</a>
                </p>
            </div>
            <div class="col-md-12">
                <table class="table table-striped" style="margin-top:20px;">
                    <thead>
                        <tr class="redtable">
                            <th class="text-center">Vin</th>
                            <th class="text-center">Date</th>
                            
                            <th class="text-center">A qui ?</th>
                            
                            <th class="text-center">Quantité</th>
                            <th class="text-center">Taille</th>
                            <th class="text-center">Action(s)</th>
                        </tr>
                    </thead>
                    <tbody id="dataBuyerHouses">            
                                                
                    </tbody>
                </table>
            </div>
            <input type="hidden" id="user_id" value="{{ $user_id }}">
            @endif
        </div>
        <hr />
    </div>
</div>
<div id="zoneModal">
    
</div>
<div id="modalHistoryZone">
    
</div>      
@endsection
