<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPenyesuaianToKadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kaders', function (Blueprint $table) {
            $table->foreign('id_marhala')->references('id')->on('marhala')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kaders', function (Blueprint $table) {
            $table->dropForeign(['id_marhala']);
        });
    }
}
