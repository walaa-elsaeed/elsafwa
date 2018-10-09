<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartArticleRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depart_articel_rates', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('rate');

            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->change();

            $table->integer('depart_articles_id')->unsigned();
            $table->foreign('depart_articles_id')->references('id')->on('depart_articlesController')->onDelete('cascade')->change();



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
        Schema::dropIfExists('depart_articel_rates');
    }
}
