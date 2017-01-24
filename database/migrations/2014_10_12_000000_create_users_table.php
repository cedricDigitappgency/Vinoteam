<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->integer('zipcode')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->enum('gender', array('M', 'F', 'O'))->default('O');
            $table->string('phone')->nullable();
            $table->string('salt')->nullable();
            $table->string('payment_iban')->nullable();
            $table->string('payment_bic')->nullable();
            $table->string('mangopay_userid')->nullable();
            $table->string('mangopay_walletid')->nullable();
            $table->string('mangopay_bankaccountid')->nullable();
            $table->string('mangopay_mandateid')->nullable();
            $table->enum('received_welcome_mail', array('0', '1'))->default('0');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->enum('status', array('notverified', 'needactivation', 'verified'))->default('notverified');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
