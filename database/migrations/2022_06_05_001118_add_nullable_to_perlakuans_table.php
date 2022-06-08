<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToPerlakuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perlakuans', function (Blueprint $table) {
            $table->integer('dosis_obat')->nullable()->change();
            $table->integer('dosis_vaksin')->nullable()->change();
            $table->integer('dosis_vitamin')->nullable()->change();
            $table->integer('dosis_hormon')->nullable()->change();
            $table->string('ket_perlakuan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perlakuans', function (Blueprint $table) {
            //
        });
    }
}
