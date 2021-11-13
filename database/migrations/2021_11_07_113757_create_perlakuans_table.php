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
            
            $table->unsignedBigInteger('peternak_id')->nullable();
            $table->foreign('peternak_id')->references('id')->on('peternaks');

            $table->unsignedBigInteger('pendamping_id')->nullable();
            $table->foreign('pendamping_id')->references('id')->on('pendampings');
            
            $table->unsignedBigInteger('tsr_id')->nullable();
            $table->foreign('tsr_id')->references('id')->on('tsrs');

            $table->string('tgl_perlakuan');
            
            $table->unsignedBigInteger('obat_id')->nullable();
            $table->foreign('obat_id')->references('id')->on('obats');
            $table->integer('dosis_obat');
            
            $table->unsignedBigInteger('vaksin_id')->nullable();
            $table->foreign('vaksin_id')->references('id')->on('vaksins');
            $table->integer('dosis_vaksin');
            
            $table->unsignedBigInteger('vitamin_id')->nullable();
            $table->foreign('vitamin_id')->references('id')->on('vitamins');
            $table->integer('dosis_vitamin');
            
            $table->unsignedBigInteger('hormon_id')->nullable();
            $table->foreign('hormon_id')->references('id')->on('hormons');
            $table->integer('dosis_hormon');

            $table->string('ket_perlakuan');

            $table->string('foto');

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
