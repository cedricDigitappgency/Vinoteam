<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_cru')->nullable();
            $table->string('year')->nullable();
            $table->string('productor')->nullable();
            $table->integer('file_id')->unsigned()->nullable()->index();
            $table->string('region')->nullable();
            $table->string('message')->nullable();
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
        Schema::drop('wines');
    }
}
