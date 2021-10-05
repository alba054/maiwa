<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sapi_id')->nullable();
            $table->foreign('sapi_id')->references('id')->on('sapis');
            
            $table->string('tanggal_performa');

            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->integer('panjang_badan');

            $table->integer('lingkar_dada');
            $table->integer('bsc');
            
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
        Schema::dropIfExists('performas');
    }
}
