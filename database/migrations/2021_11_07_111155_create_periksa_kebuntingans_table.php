<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaKebuntingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_kebuntingans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sapi_id')->nullable();
            $table->foreign('sapi_id')->references('id')->on('sapis');
            
            $table->unsignedBigInteger('peternak_id')->nullable();
            $table->foreign('peternak_id')->references('id')->on('peternaks');

            $table->unsignedBigInteger('pendamping_id')->nullable();
            $table->foreign('pendamping_id')->references('id')->on('pendampings');
            
            $table->unsignedBigInteger('tsr_id')->nullable();
            $table->foreign('tsr_id')->references('id')->on('tsrs');
            
            $table->string('waktu_pk');
            $table->boolean('status');
            
            $table->unsignedBigInteger('metode_id')->nullable();
            $table->foreign('metode_id')->references('id')->on('metodes');
            
            $table->unsignedBigInteger('hasil_id')->nullable();
            $table->foreign('hasil_id')->references('id')->on('hasils');

            $table->string('foto');

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
        Schema::dropIfExists('periksa_kebuntingans');
    }
}
