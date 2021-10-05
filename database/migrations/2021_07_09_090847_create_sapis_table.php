<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSapisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sapis', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('jenis_sapi_id')->nullable();
            $table->foreign('jenis_sapi_id')->references('id')->on('jenis_sapis');

            $table->unsignedBigInteger('peternak_id')->nullable();
            $table->foreign('peternak_id')->references('id')->on('peternaks');

            $table->string('ertag')->unique();
            $table->string('ertag_induk')->unique();
            $table->string('nama_sapi');
            $table->string('tanggal_lahir');
            $table->string('kelamin');
            $table->string('kondisi_lahir');
            $table->string('anak_ke');
            $table->string('foto_depan');
            $table->string('foto_belakang');
            $table->string('foto_kanan');
            $table->string('foto_kiri');

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
        Schema::dropIfExists('sapis');
    }
}
