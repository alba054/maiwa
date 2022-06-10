<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDokterStatusToInsiminasiBuatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insiminasi_buatans', function (Blueprint $table) {
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
        Schema::table('insiminasi_buatans', function (Blueprint $table) {
            $table->dropColumn('isdokter');
        });
    }
}
