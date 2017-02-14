@extends('layouts.app')

@section('log')
@endsection
@section('sign')
@endsection
@section('how')
@endsection

@section('content')
<script src="{{ URL::asset('js/orders.js') }}" type="text/javascript"></script>

<div id="container">

    <hr/>
    <p class="exemple"><i class="fa fa-credit-card" aria-hidden="true"></i> Paiement par carte bancaire</p>
    <hr/>

    @if (session('alerts'))<div class="col-md-12">
        <div class="alert alert-danger">
            {{ session('alerts') }}
        </div>
    </div>@endif
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ $createdCardRegister->CardRegistrationURL }}" method="post" id="paymentCBinfo">
                    <input type="hidden" name="data" value="{{ $createdCardRegister->PreregistrationData }}" />
                    <input type="hidden" name="accessKeyRef" value="{{ $createdCardRegister->AccessKey }}" />
                    <input type="hidden" name="returnURL" value="{{ url('/orders/'.$orderId.'/paymentCBValidate/'.$cardRegisterId) }}" />
                    <input type="hidden" name="cardExpirationDate" id="cardExpirationDate" value="" />

                    <div class="form-group{{ $errors->has('cardNumber') ? ' has-error' : '' }}">
                        <label for="cardNumber">Numéro de la carte</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="text" name="cardNumber" id="cardNumber" class="form-control" value="" />
                          </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="form-group{{ $errors->has('cardExpirationDate') ? ' has-error' : '' }}">
                        <label for="cardExpirationDateMonth">Date d'expiration</label>

                        <div class="row">
                          <div class="col-md-2">
                            <select name="cardExpirationDateMonth" id="cardExpirationDateMonth" class="form-control">
                              <option value="01">01 - Janvier</option>
                              <option value="02">02 - Février</option>
                              <option value="03">03 - Mars</option>
                              <option value="04">04 - Avril</option>
                              <option value="05">05 - Mai</option>
                              <option value="06">06 - Juin</option>
                              <option value="07">07 - Juillet</option>
                              <option value="08">08 - Aout</option>
                              <option value="09">09 - Septembre</option>
                              <option value="10">10 - Octobre</option>
                              <option value="11">11 - Novembre</option>
                              <option value="12">12 - Décembre</option>
                            </select>
                          </div>

                          <div class="col-md-2">
                            <select name="cardExpirationDateYear" id="cardExpirationDateYear" class="form-control">
                              <option value="17">2017</option>
                              <option value="18">2018</option>
                              <option value="19">2019</option>
                              <option value="20">2020</option>
                              <option value="21">2021</option>
                              <option value="22">2022</option>
                              <option value="23">2023</option>
                              <option value="24">2024</option>
                            </select>
                          </div>

                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="form-group{{ $errors->has('cardCvx') ? ' has-error' : '' }}">
                        <label for="cardCvx">CVV</label>
                        <div class="row">
                          <div class="col-md-3">
                            <input type="text" name="cardCvx" id="cardCvx" maxlength="3" class="form-control" value="" />
                          </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-5">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-credit-card"></i> Payer
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
