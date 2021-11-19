<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndukAnaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('induk_anaks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('induk_id')->nullable();
            $table->foreign('induk_id')->references('id')->on('sapis');

            $table->unsignedBigInteger('anak_id')->nullable();
            $table->foreign('anak_id')->references('id')->on('sapis');

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
        Schema::dropIfExists('induk_anaks');
    }
}
