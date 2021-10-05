<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('strows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sapi_id')->nullable();
            $table->foreign('sapi_id')->references('id')->on('sapis');
            
            $table->string('kode_batch');
            $table->string('batch');
            
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
        Schema::dropIfExists('strows');
    }
}
