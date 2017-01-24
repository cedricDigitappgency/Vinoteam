<!-- resources/views/orders/index_amesamis.blade.php -->

@extends('layouts.app')

@section('remboursements')
active
@endsection

@section('rmb-amesamis')
active
@endsection

@section('content')
<script src="{{ URL::asset('js/orders.js') }}" type="text/javascript"></script>

<hr/>
<p class="exemple"><i class="fa fa-credit-card" aria-hidden="true"></i> Remboursements à ma VinoTeam</p>
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

        @if( $order_count == 0)
        <div class="col-md-6 col-sm-6">
            <a href="#"><img src="{{ URL::asset('/images/julie.gif') }}"></a>
        </div>

        <div class="col-md-6 col-sm-6">
            <div class="call-action call-action-boxed clearfix">
                  <!-- Call Action Text -->
                  <h2 class="primary">Personne ne vous a adressé de demande de remboursement.</h2>
                   <!-- Call Action Button -->
            </div>
        </div>
        @else
        <table class="table table-striped">
            <thead>
                <tr class="redtable">
                    <th class="text-center">Date</th>
                    <th class="text-center">Montant</th>
                    
                    <th class="text-center">A qui?</th>
                    
                    <th class="text-center">Statut</th>
                    <th class="text-center">Action(s)</th>
                </tr>
            </thead>
            <tbody id="dataOwner">            

            </tbody>
        </table>

        <input type="hidden" id="user_id" value="{{ $user_id }}">
        @endif
    </div>
</div>
@endsection