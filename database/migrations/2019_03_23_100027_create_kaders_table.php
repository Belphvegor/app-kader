<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik', 191);
            $table->string('nama', 191);
            $table->string('tempat_lahir', 191);
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 191);
            $table->string('alamat', 191);
            $table->string('profesi', 191);
            $table->string('asal', 191);
            $table->string('provinsi', 191);
            $table->string('kota', 191);
            $table->string('kode_pos', 191);
            $table->string('kecamatan', 191);
            $table->string('nomor_telepon', 191);
            $table->string('email', 191)->unique();
            $table->string('password', 191);
            $table->char('gol_darah', 3);
            $table->string('status', 191);
            $table->string('id_marhala', 191)->nullable();
            $table->string('api_token');
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
        Schema::dropIfExists('kaders');
    }
}
