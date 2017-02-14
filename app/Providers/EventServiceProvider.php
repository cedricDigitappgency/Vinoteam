<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
      'App\Events\PreRegistration' => [
          'App\Listeners\VerifyAccount',
      ],
      'App\Events\PostRegistration' => [
          'App\Listeners\CreateMangoPayUserAccount',
          'App\Listeners\CreateMangoPayUserWallet',
      ],
      'App\Events\PostRegistrationVerifiyIBAN' => [
          'App\Listeners\EmailPostRegistration',
      ],
      'App\Events\PaymentInfoWereModified' => [
          'App\Listeners\CreateMangoPayUserBankAccount',
          'App\Listeners\CreateMangoPayUserMandate',
      ],
      'App\Events\PostCreateOrder' => [
          'App\Listeners\PostCreateOrderConfirmation',
      ],
      'App\Events\PostUpdateOrder' => [
          'App\Listeners\PostUpdateOrderConfirmation',
      ],
      'App\Events\PostPaymentOrder' => [
          'App\Listeners\PostPaymentOrderEmail',
      ],
      'App\Events\InviteFriends' => [
          'App\Listeners\InviteFriendsEmail',
      ],
      'App\Events\VerifyIBAN' => [
          'App\Listeners\VerifyIBANStatus',
      ],
      'App\Events\PostSuccessPayIn' => [
          'App\Listeners\EmailPostSuccessPayIn',
      ],
      'App\Events\PostFailedPayIn' => [
          'App\Listeners\EmailPostFailedPayIn',
      ],
      'App\Events\PostCreateRelationship' => [
          'App\Listeners\PostCreateRelationshipEmail',
      ],
      'App\Events\NotificateFriendsOfNewRegistration' => [
          'App\Listeners\NotificateFriendsOfNewRegistrationEmail',
      ],
      // Gestion des événements CRONs
      'App\Events\CheckPayin' => [
          'App\Listeners\CronCheckPayin',
      ],
      'App\Events\CronUserUnregistered' => [
          'App\Listeners\CronUserUnregisteredAction',
      ],
      'App\Events\CronUserWithoutTransactions' => [
          'App\Listeners\CronUserWithoutTransactionsAction',
      ],
      'App\Events\CronOwnerWithSingleTransaction' => [
          'App\Listeners\CronOwnerWithSingleTransactionAction',
      ],
      'App\Events\CronBuyerWithSingleTransaction' => [
          'App\Listeners\CronBuyerWithSingleTransactionAction',
      ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
