<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeternaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peternaks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peternak');
            $table->string('nama_peternak');
            $table->string('no_hp');
            $table->string('tgl_lahir');
            $table->string('jumlah_anggota');
            $table->string('luas_lahan');
            $table->string('kelompok');
            
            $table->unsignedBigInteger('desa_id')->nullable();
            $table->foreign('desa_id')->references('id')->on('desas');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');


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
        Schema::dropIfExists('peternaks');
    }
}
