<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeternakSapisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peternak_sapis', function (Blueprint $table) {
            $table->id();

            $table->string('date');

            $table->unsignedBigInteger('tsr_id')->nullable();
            $table->foreign('tsr_id')->references('id')->on('tsrs');
            
            $table->unsignedBigInteger('pendamping_id')->nullable();
            $table->foreign('pendamping_id')->references('id')->on('pendampings');
            
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
        Schema::dropIfExists('peternak_sapis');
    }
}
