<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('price');
            $table->integer('buyer_id')->unsigned()->index();
            $table->integer('owner_id')->unsigned()->index();
            $table->enum('status', array('unpaid', 'paid', 'draft', 'canceled','inprogress'))->default('unpaid');
            $table->integer('file_id')->unsigned()->nullable()->index();
            $table->longText('message')->nullable();
            $table->timestamps();
            $table->string('mangopay_payin')->nullable();
            $table->string('mangopay_transfert')->nullable();
            $table->string('mangopay_payout')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
