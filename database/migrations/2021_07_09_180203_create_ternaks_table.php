<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTernaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ternaks', function (Blueprint $table) {
            $table->id();
            
            $table->string('tgl_mulai');

            $table->unsignedBigInteger('peternak_id')->nullable();
            $table->foreign('peternak_id')->references('id')->on('peternaks');
            
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
        Schema::dropIfExists('ternaks');
    }
}
