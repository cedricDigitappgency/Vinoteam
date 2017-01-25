<?php

namespace App\Listeners;

use App\Events\PaymentInfoWereModified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Repositories\UserRepository;

class CreateMangoPayUserBankAccount
{
    private $mangopay;

    private $users;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(\MangoPay\MangoPayApi $mangopay, UserRepository $users)
    {
        $this->mangopay = $mangopay;
        $this->users = $users;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentInfoWereModified  $event
     * @return void
     */
    public function handle(PaymentInfoWereModified $event)
    {
        // get user info
        $user = User::find($event->userId);

        try {
            // create mangopay natural user
            $bankAccount = new \MangoPay\BankAccount();
            $bankAccount->Type = "IBAN";
            $bankAccount->OwnerName = $user->firstname.' '.$user->lastname;
            $bankAccount->OwnerAddress = new \MangoPay\Address();
            $bankAccount->OwnerAddress->AddressLine1 = $user->address;
            $bankAccount->OwnerAddress->AddressLine2 = $user->address2;
            $bankAccount->OwnerAddress->City = $user->city;
            $bankAccount->OwnerAddress->PostalCode = $user->zipcode;
            $bankAccount->OwnerAddress->Country = $user->country;
            $bankAccount->Details = new \MangoPay\BankAccountDetailsIBAN();
            $bankAccount->Details->IBAN = $user->payment_iban;
            $bankAccount->Details->BIC = $user->payment_bic;

            $result = $this->mangopay->Users->CreateBankAccount($user->mangopay_userid, $bankAccount);

            // update user info
            $this->users->updateMangoPayBankAccountId($event->userId, $result->Id);

        } catch (\MangoPay\Libraries\ResponseException $e) {
            // return redirect('users/paymentInfo')->with('errors', 'Merci de saisir un IBAN valide.');
            \MangoPay\Libraries\Logs::Debug('MangoPay\ResponseException Code', $e->GetCode());
            \MangoPay\Libraries\Logs::Debug('Message', $e->GetMessage());
            \MangoPay\Libraries\Logs::Debug('Details', $e->GetErrorDetails());
        } catch (\MangoPay\Libraries\Exception $e) {
            // return redirect('users/paymentInfo')->with('errors', 'Merci de saisir un IBAN valide.');
            \MangoPay\Libraries\Logs::Debug('MangoPay\Exception Message', $e->GetMessage());
        }
    }
}
