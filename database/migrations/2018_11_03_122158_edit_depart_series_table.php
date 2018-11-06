<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditDepartSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('depart_serieses', function (Blueprint $table) {
            $table->tinyInteger('type')->default(0);
            $table->string('upload_url')->nullable();
            $table->string('url')->nullable()->change();
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
            $table->tinyInteger('type')->default(0);
            $table->string('upload_url')->nullable();
            $table->string('url');
        });
    }
}
