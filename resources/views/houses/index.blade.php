<!-- resources/views/houses/index.blade.php -->

@extends('layouts.app')

@section('vinocave')
active
@endsection

@section('content')
<!--<script src="{{ URL::asset('js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>-->
<script src="{{ URL::asset('js/orders.js') }}" type="text/javascript"></script>
<div id="container">

    <hr/>
    <p class="exemple"><i class="fa fa-glass" aria-hidden="true"></i> VinoCave</p>
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
            <div class="col-md-12">
                <div class="alert alert-info">
                    <p>Texte pour informer </p>
                </div>
            </div>
            <div class="col-md-12">
                <p class="text-center">
                    <a href="{{ url('/houses/buyer/create') }}" class="btn btn-primary">Garder du vin pour mes amis</a>
                    <a href="{{ url('/houses/owner/create') }}" class="btn btn-primary">Faire garder du vin par mes amis</a>
                </p>
            </div>
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a aria-expanded="true" href="#tab1" data-toggle="tab"><i class="icon-award-1"></i>Mes vins</a></li>
                    <li class=""><a aria-expanded="false" href="#tab2" data-toggle="tab"><i class="icon-beaker"></i>Les vins mes amis</a></li>
                </ul>
                <div class="tab-content">
                    <!-- Tab 1 -->
                    <div class="tab-pane fade active in" id="tab1">
                        <table class="table table-striped">
                            <thead>
                                <tr class="redtable">
                                    <th>Date</th>
                                    <th>Vin</th>
                                    
                                    <th>Chez qui ?</th>
                                    
                                    <th>Quantitée</th>
                                    <th>Taille</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody id="dataOwnerHouses">            
                                                        
                            </tbody>
                        </table>
                    </div>
                    <!-- Tab 2 -->
                    <div class="tab-pane fade" id="tab2">
                      <table class="table table-striped">
                            <thead>
                                <tr class="redtable">
                                    <th>Date</th>
                                    <th>Vin</th>
                                    
                                    <th>à qui ?</th>
                                    
                                    <th>Quantitée</th>
                                    <th>Taille</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody id="dataBuyerHouses">            
                                                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <input type="hidden" id="user_id" value="{{ $user_id }}">
    </div>
</div>

        
@endsection
