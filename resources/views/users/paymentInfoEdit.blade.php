@extends('layouts.app')

@section('userAccount')
active
@endsection
@section('editPaymentInfo')
active
@endsection

@section('content')

<script language="JavaScript" type="text/JavaScript">
function Autotab(box, longueur, texte)
{
  if(texte.length > longueur-1)
  {
    document.getElementById('payment_iban'+box).focus();
  }
}
</script>

<div id="container">
  <hr/>
  <p class="exemple">Mes coordonnées bancaires</p>
  <hr/>

  <div class="container">
    @if ($user->status == 'notverified')<div class="col-md-12">
        <div class="alert alert-info">
            Saisissez votre IBAN pour pouvoir recevoir les remboursements de vos amis.
        </div>
    </div>@endif
    @if ($user->status == 'needactivation')<div class="col-md-12">
        <div class="alert alert-warning">
            Pour vérifier vos coordonnés bancaires et en valider l’utilisation pour recevoir ou émettre des remboursements, vous devez cliquer sur le bouton "suivant".
        </div>
    </div>@endif
    @if (session('alerts'))<div class="col-md-12">
        <div class="alert alert-danger">
            {{ session('alerts') }}
        </div>
    </div>@endif

    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-tabs">
          <li @if(!$tab || $tab == 'iban')class="active iban"@else class="iban"@endif><a class="iban" href="?tab=iban" ><i class="icon-award-1"></i>IBAN</a></li>
          @if($card)<li @if($tab && $tab == 'cb') class="active cb"@else class="cb"@endif ><a class="cb" href="?tab=cb" ><i class="icon-beaker"></i>Carte bancaire</a></li>@endif
        </ul>

        <div class="tab-content">
          <!-- Tab 1 - Comment ça marche -->
          <div @if(!old('email') && (!$tab || $tab == 'iban'))class="tab-pane fade in active" @else class="tab-pane fade" @endif id="iban">
            <p>Vos coordonnées bancaires servent uniquement à recevoir des remboursements ou rembourser à vos amis des sommes que vous leur devez.</p>
            <p>Personne d’autre que vous n’y a accès. Vous seul pouvez autoriser un paiement. Vos données sont stockées dans un entrepôt numérique sécurisé externe à VinoTeam.</p>
            <p>Vous pouvez enregistrer vos coordonnées bancaires dès maintenant ou plus tard (lorsque vous devrez récupérer ou effectuer un remboursement).</p>
            <p>Vous pourrez aussi choisir de rembourser vos amis par carte bancaire.</p>

            <form class="form" role="form" method="POST" action="{{ url('/users/' . $user->id . '/paymentInfo') }}">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

              <div class="row" style="margin-top:10px;">
                @if( $errors->has('payment_iban1') || $errors->has('payment_iban2') || $errors->has('payment_iban3') || $errors->has('payment_iban4') || $errors->has('payment_iban5') || $errors->has('payment_iban6') || $errors->has('payment_iban7') )<div class="form-group has-error">@else<div class="form-group">@endif

                  <div class="col-md-1">
                    <input id="payment_iban1" type="text" class="form-control" maxlength="4" name="payment_iban1" value="{{ substr($user->payment_iban, 0, 4) }}" placeholder="IBAN" onkeyup="Autotab(2, 4, this.value)">
                  </div>
                  <div class="col-md-1">
                    <input id="payment_iban2" type="text" class="form-control" maxlength="4" name="payment_iban2" value="{{ substr($user->payment_iban, 4, 4) }}" placeholder="IBAN" onkeyup="Autotab(3, 4, this.value)">
                  </div>
                  <div class="col-md-1">
                    <input id="payment_iban3" type="text" class="form-control" maxlength="4" name="payment_iban3" value="{{ substr($user->payment_iban, 8, 4) }}" placeholder="IBAN" onkeyup="Autotab(4, 4, this.value)">
                  </div>
                  <div class="col-md-1">
                    <input id="payment_iban4" type="text" class="form-control" maxlength="4" name="payment_iban4" value="{{ substr($user->payment_iban, 12, 4) }}" placeholder="IBAN" onkeyup="Autotab(5, 4, this.value)">
                  </div>
                  <div class="col-md-1">
                    <input id="payment_iban5" type="text" class="form-control" maxlength="4" name="payment_iban5" value="{{ substr($user->payment_iban, 16, 4) }}" placeholder="IBAN" onkeyup="Autotab(6, 4, this.value)">
                  </div>
                  <div class="col-md-1">
                    <input id="payment_iban6" type="text" class="form-control" maxlength="4" name="payment_iban6" value="{{ substr($user->payment_iban, 20, 4) }}" placeholder="IBAN" onkeyup="Autotab(7, 4, this.value)">
                  </div>
                  <div class="col-md-1">
                    <input id="payment_iban7" type="text" class="form-control" maxlength="3" name="payment_iban7" value="{{ (substr($user->payment_iban, 24, 3)) ? substr($user->payment_iban, 24, 3) : '' }}" placeholder="IBAN">
                  </div>

                  @if( $errors->has('payment_iban1') || $errors->has('payment_iban2') || $errors->has('payment_iban3') || $errors->has('payment_iban4') || $errors->has('payment_iban5') || $errors->has('payment_iban6') || $errors->has('payment_iban7') )
                  <span class="help-block">
                    <strong>{{ $errors->first('payment_iban1') }}</strong>
                  </span>
                  @endif

                  <div style="clear:both;"></div>
                </div>
              </div><!-- Fin du div .row -->

              <div class="row">
                <div class="form-group{{ $errors->has('payment_bic') ? ' has-error' : '' }}">
                  <div class="col-md-12">
                    <input id="payment_bic" type="text" class="form-control" name="payment_bic" value="{{ $user->payment_bic }}" placeholder="BIC">
                    @if( !session('errors'))
                    @if ($errors->has('payment_bic'))
                    <span class="help-block">
                      <strong>{{ $errors->first('payment_bic') }}</strong>
                    </span>
                    @endif
                    @endif
                  </div>
                </div>
              </div>

              <div class="row" style="margin-top:15px;">
                <div class="form-group">
                  <div class="col-md-12 text-center">
                    <input type="hidden" name="parent_id" value="">
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-btn fa-arrow-right"></i> Suivant
                    </button>
                  </div>
                </div>
              </div>

            </form>

          </div>

          @if($card)<!-- Tab 2 - Tarifs -->
          <div @if($tab == 'cb')class="tab-pane fade in active" @else class="tab-pane fade" @endif id="cb">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <label for="alias">Numéro de carte</label>
                  <input type="text" class="form-control col-md-4" maxlength="4" value="{{ $card->Alias}}" name="alias" disabled>
                </div>
                <div class="col-md-12">
                  <label for="expire_date">Date d'expiration</label>
                  <input type="text" class="form-control col-md-4" maxlength="4" value="{{ $card->ExpirationDate}}" name="expire_date" disabled>
                </div>
                <div class="col-md-12">
                  <a href="{{ url('/users/deletePaymentCard') }}" class="btn btn-primary">Supprimer</a>
                </div>
              </div>
            </div>
          </div>@endif

        </div><!-- Fermeture de .tab-content -->

      </div>
    </div>
  </div>
</div>
@endsection
