<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerlakuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perlakuans', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('sapi_id')->nullable();
            $table->foreign('sapi_id')->references('id')->on('sapis');
            
            $table->string('tgl_perlakuan');
            
            $table->string('jenis_obat');
            $table->integer('dosis_obat');
            
            $table->string('vaksin');
            $table->integer('dosis_vaksin');
            
            $table->string('vitamin');
            $table->integer('dosis_vitamin');
            
            $table->string('hormon');
            $table->integer('dosis_hormon');

            $table->string('ket_perlakuan');
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
        Schema::dropIfExists('perlakuans');
    }
}
