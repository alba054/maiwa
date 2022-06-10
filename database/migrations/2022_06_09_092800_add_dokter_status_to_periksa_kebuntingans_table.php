<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDokterStatusToPeriksaKebuntingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('periksa_kebuntingans', function (Blueprint $table) {
            $table->integer('isdokter')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('periksa_kebuntingans', function (Blueprint $table) {
            $table->dropColumn('isdokter');
        });
    }
}
