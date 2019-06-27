<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHalaqahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halaqah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_halaqah', 191);
            $table->string('murabbi', 191);
            $table->string('naqib', 191);
            $table->string('sekretaris', 191);
            $table->string('bendahara', 191);
            $table->string('id_marhala', 191);
            $table->SoftDeletes();
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
        Schema::dropIfExists('halaqah');
    }
}
