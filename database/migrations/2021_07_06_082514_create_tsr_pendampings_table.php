<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTsrPendampingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tsr_pendampings', function (Blueprint $table) {
            $table->id();

            $table->string('date');

            $table->unsignedBigInteger('tsr_id')->nullable();
            $table->foreign('tsr_id')->references('id')->on('tsrs');

            $table->unsignedBigInteger('pendamping_id')->nullable();
            $table->foreign('pendamping_id')->references('id')->on('pendampings');
            
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
        Schema::dropIfExists('tsr_pendampings');
    }
}
