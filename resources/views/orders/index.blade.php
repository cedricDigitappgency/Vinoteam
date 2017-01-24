<!-- resources/views/orders/create.blade.php -->

@extends('layouts.app')

@section('remboursements')
active
@endsection

@section('content')
<!--<script src="{{ URL::asset('js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>-->
<script src="{{ URL::asset('js/orders.js') }}" type="text/javascript"></script>
<div id="container">

    <hr/>
    <p class="exemple"><i class="fa fa-credit-card" aria-hidden="true"></i> Remboursements</p>
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
        <div class="col-md-12">
            <div class="col-md-6">
                <img src="" alt="">
            </div>
            <div class="col-md-6">
                <img src="" alt="">
            </div>
        </div>
        <hr/>
    </div>
</div>

@endsection