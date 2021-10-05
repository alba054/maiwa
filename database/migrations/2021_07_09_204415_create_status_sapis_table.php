<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusSapisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_sapis', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('sapi_id')->nullable();
            $table->foreign('sapi_id')->references('id')->on('sapis');
            
            $table->string('status');
            $table->string('ket_status');

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
        Schema::dropIfExists('status_sapis');
    }
}
