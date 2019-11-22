<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsHargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_harga', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_kendaraan',25);
            $table->decimal('harga',9,2);
            $table->decimal('pnbp',9,2);
            $table->decimal('pph',9,2);
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
        Schema::dropIfExists('ms_hargas');
    }
}
