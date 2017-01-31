<?php

namespace App\Listeners;

use App\Events\CheckPayin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Order;
use App\User;

use Event;
use App\Events\PostPaymentOrder;

class CronCheckPayin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(\MangoPay\MangoPayApi $mangopay)
    {
        $this->mangopay = $mangopay;
    }

    /**
     * Handle the event.
     *
     * @param  CheckPayin  $event
     * @return void
     */
    public function handle(CheckPayin $event)
    {
        $order = Order::find($event->orderId);
        $owner = User::find($order->owner_id);
        $buyer = User::find($order->buyer_id);

        try
        {
            $PayIn = $this->mangopay->PayIns->Get($order->mangopay_payin);
        } catch (\MangoPay\Libraries\ResponseException $e) {
          \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
          \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
          \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());
        } catch (\MangoPay\Libraries\Exception $e) {
          \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }

        if( isset($PayIn) && $PayIn->Status == 'CREATED' ) {
            $order->status = "inprogress";
            $order->save();
            return;
        } elseif( isset($PayIn) && $PayIn->Status == 'FAILED' ) {
            // Lancer un événement pour avertir les deux personnes
            Mail::send('emails.orderFailed', ['buyer' => $buyer, 'order' => $order, 'owner' => $owner], function($message) use ($buyer, $order, $owner) {
                // From
                $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

                // To
                $message->to($owner->email);

                // Subject
                $message->subject('Le paiement n\'a pas abouti');
            });

            $order->status = "unpaid";
            $order->save();
            return;
        }
        else
        {
            //
            //// STEP 4 :  On fait un transfert entre le wallet owner et le wallet buyer
            //
            try
            {
                $TransferOwnerToBuyer = new \MangoPay\Transfer();
                $TransferOwnerToBuyer->AuthorId = $owner->mangopay_userid;

                $TransferOwnerToBuyer->DebitedFunds = new \MangoPay\Money();
                $TransferOwnerToBuyer->DebitedFunds->Currency = "EUR";
                $TransferOwnerToBuyer->DebitedFunds->Amount = str_replace('.', '', number_format($order->price, 2, '.', ''));

                $TransferOwnerToBuyer->Fees = new \MangoPay\Money();
                $TransferOwnerToBuyer->Fees->Currency = "EUR";
                $TransferOwnerToBuyer->Fees->Amount = 0;

                $TransferOwnerToBuyer->DebitedWalletId = $owner->mangopay_walletid;
                $TransferOwnerToBuyer->CreditedWalletId = $buyer->mangopay_walletid;
                $ResultTransfer = $this->mangopay->Transfers->Create($TransferOwnerToBuyer);

                $order->mangopay_transfert=$ResultTransfer->Id;
                $order->save();

            } catch (\MangoPay\Libraries\ResponseException $e) {

              return redirect('orders')->with('errors', 'Erreur #3 '.$e->GetCode().' lors de paiment : '.$e->GetMessage());
              \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
              \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
              \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

            } catch (\MangoPay\Libraries\Exception $e) {

              return redirect('orders')->with('errors', 'Erreur #4 '.$e->GetCode().' lors de paiment : '.$e->GetMessage());
              \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());

            }

            // Si la transaction n'a pas abouti
            if( $ResultTransfer == 'FAILED' ) {
              return;
            }

            //
            //// STEP 5 :  On fait un virement entre le wallet buyer et son compte bancaire
            //
            try {
                $PayOutBuyerToBank = new \MangoPay\PayOut();
                $PayOutBuyerToBank->AuthorId = $buyer->mangopay_userid;
                $PayOutBuyerToBank->DebitedWalletID = $buyer->mangopay_walletid;

                $PayOutBuyerToBank->DebitedFunds = new \MangoPay\Money();
                $PayOutBuyerToBank->DebitedFunds->Currency = "EUR";
                $PayOutBuyerToBank->DebitedFunds->Amount = str_replace('.', '', number_format($order->price, 2, '.', ''));

                $PayOutBuyerToBank->Fees = new \MangoPay\Money();
                $PayOutBuyerToBank->Fees->Currency = "EUR";
                $PayOutBuyerToBank->Fees->Amount = 0;

                $PayOutBuyerToBank->PaymentType = "BANK_WIRE";
                $PayOutBuyerToBank->MeanOfPaymentDetails = new \MangoPay\PayOutPaymentDetailsBankWire();
                $PayOutBuyerToBank->MeanOfPaymentDetails->BankAccountId = $buyer->mangopay_bankaccountid;
                $result = $this->mangopay->PayOuts->Create($PayOutBuyerToBank);

                $order->mangopay_payout=$result->Id;
                $order->status = "paid";
                $order->save();

                Mail::send('emails.orderVirementSuccess', ['buyer' => $buyer, 'order' => $order, 'owner' => $owner], function($message) use ($buyer, $order, $owner) {
                    // From
                    $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

                    // To
                    $message->to($buyer->email);

                    // Subject
                    $message->subject('Remboursement de votre ami');
                });

            } catch (\MangoPay\Libraries\ResponseException $e) {

              return redirect('orders')->with('errors', 'Erreur #5 '.$e->GetCode().' lors de paiment : '.$e->GetMessage());
              \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
              \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
              \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());

            } catch (\MangoPay\Libraries\Exception $e) {

              return redirect('orders')->with('errors', 'Erreur #6 '.$e->GetCode().' lors de paiment : '.$e->GetMessage());
              \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());

            }

            return;
        }
    }
}
