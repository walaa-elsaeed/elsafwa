<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncreaseDepartSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('depart_serieses', function (Blueprint $table) {
            $table->decimal('rate',10,2)->dafault(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('depart_serieses', function (Blueprint $table) {
            $table->decimal('rate',10,2)->dafault(0);
        });
    }
}
