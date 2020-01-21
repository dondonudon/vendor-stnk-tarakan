<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodeValidasiToPoStnkDealer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_stnk_dealer', function (Blueprint $table) {
            $table->string('kode_validasi',12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_stnk_dealer', function (Blueprint $table) {
            $table->dropColumn(['kode_validasi']);
        });
    }
}
