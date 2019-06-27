<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelasiToTarbiyahDetailsOnHalaqahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarbiyah_details', function (Blueprint $table) {
            $table->foreign('id_halaqah')->references('id')->on('halaqah')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('kaders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarbiyah_details', function (Blueprint $table) {
            $table->dropForeign(['id_halaqah']);
            $table->dropForeign(['id_user']);
        });
    }
}
