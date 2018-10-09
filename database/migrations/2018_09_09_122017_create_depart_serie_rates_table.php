<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartSerieRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depart_serie_rates', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('rate');

            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->change();

            $table->integer('depart_serieses_id')->unsigned();
            $table->foreign('depart_serieses_id')->references('id')->on('depart_serieses')->onDelete('cascade')->change();


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
        Schema::dropIfExists('depart_serie_rates');
    }
}
