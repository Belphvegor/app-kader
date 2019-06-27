<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPenyesuaianToHalaqahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('halaqah', function (Blueprint $table) {
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
        Schema::table('halaqah', function (Blueprint $table) {
            $table->dropForeign(['id_marhala']);
        });
    }
}
