<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaKebuntingansTable extends Migration
{
    public function up()
    {
        Schema::create('periksa_kebuntingans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sapi_id')->nullable();
            $table->foreign('sapi_id')->references('id')->on('sapis');
            
            $table->string('waktu_pk');
            $table->string('metode');
            $table->string('hasil');

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
