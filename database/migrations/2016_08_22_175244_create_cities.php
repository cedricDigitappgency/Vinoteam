<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function(Blueprint $table) {
            $table->integer('city_id')->unsigned();
            $table->string('city_slug', 255)->nullable()->default(NULL);
            $table->string('city_name', 45)->nullable()->default(NULL);
            $table->string('city_name_simple', 45)->nullable()->default(NULL);
            $table->string('city_name_reel', 45)->nullable()->default(NULL);
            $table->string('city_zipcode', 255)->nullable()->default(NULL);
            $table->string('city_country', 5)->nullable()->default(NULL);
            $table->string('city_longitude_grd', 9)->nullable()->default(NULL);
            $table->string('city_latitude_grd', 8)->nullable()->default(NULL);
            $table->string('city_longitude_dms', 9)->nullable()->default(NULL);
            $table->string('city_latitude_dms', 8)->nullable()->default(NULL);
            $table->integer('city_zmin')->nullable()->default(NULL);
            $table->integer('city_zmax')->nullable()->default(NULL);

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
        Schema::drop('cities');
    }
}
