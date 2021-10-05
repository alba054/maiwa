<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsiminasiBuatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insiminasi_buatans', function (Blueprint $table) {
            $table->id();

            $table->string('waktu_ib');
            $table->integer('dosis_ib');

            $table->unsignedBigInteger('strow_id')->nullable();
            $table->foreign('strow_id')->references('id')->on('strows');
            
            $table->unsignedBigInteger('sapi_id')->nullable();
            $table->foreign('sapi_id')->references('id')->on('sapis');

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
        Schema::dropIfExists('insiminasi_buatans');
    }
}
