<!-- resources/views/orders/index_amoi.blade.php -->

@extends('layouts.app')

@section('remboursements')
active
@endsection
@section('rmb-amoi')
active
@endsection

@section('content')
<script src="{{ URL::asset('js/orders.js') }}" type="text/javascript"></script>


<hr/>
<p class="exemple"><i class="fa fa-credit-card" aria-hidden="true"></i> Mes demandes de remboursement</p>
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
                  <h2 class="primary">Vous n'avez pour le moment fait aucune demande de remboursement ! Vous pouvez en créer une dès maintenant :</h2>
                   <!-- Call Action Button -->
                   <br/>
                  <div style="margin-top:4px;">
                    <a href="{{ url('/orders/create') }}" class="btn-system btn-large">Faire une demande de remboursement</a>
                  </div>
            </div>
        </div>
        @else
        <p class="text-center">
            <a href="{{ url('/orders/create') }}" class="btn btn-primary"><i class="fa fa-arrow-right" aria-hidden="true"></i> Demander un remboursement</a>
        </p>
        <table class="table table-striped" style="margin-top:20px;">
            <thead>
                <tr class="redtable">
                    <th class="text-center">Date</th>
                    <th class="text-center">Montant</th>
                    
                    <th class="text-center">A qui?</th>
                    
                    <th class="text-center">Statut</th>
                    <th class="text-center">Action(s)</th>

                </tr>
            </thead>
            <tbody id="dataBuyer">            
                                             
            </tbody>
        </table>
        <input type="hidden" id="user_id" value="{{ $user_id }}">
        @endif
    </div>
</div>
@endsection