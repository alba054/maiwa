<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSapiTable extends Migration
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

            $table->string('eartag')->unique();
            $table->string('eartag_induk');
            $table->string('nama_sapi');
            $table->string('tanggal_lahir');
            $table->string('kelamin');
            $table->string('kondisi_lahir');
            $table->string('anak_ke');
            $table->string('generasi');
            
            $table->string('foto_depan');
            $table->string('foto_samping');
            $table->string('foto_peternak');
            $table->string('foto_rumah');

            $table->unsignedBigInteger('status_sapi_id')->nullable();
            $table->foreign('status_sapi_id')->references('id')->on('status_sapis');

            $table->unsignedBigInteger('peternak_id')->nullable();
            $table->foreign('peternak_id')->references('id')->on('peternaks');

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
