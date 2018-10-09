<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depart_serieses', function (Blueprint $table) {
            $table->increments('id');

            $table->string('url');
            $table->integer('departs_id')->unsigned();
            $table->foreign('departs_id')->references('id')->on('departs')->onDelete('cascade')->change();


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
        Schema::dropIfExists('depart_serieses');
    }
}
