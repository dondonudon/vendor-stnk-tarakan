<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_dealer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama',100);
            $table->string('provinsi',75);
            $table->string('kota',75);
            $table->text('alamat');
            $table->string('telp',15);
            $table->string('pic',75);
            $table->integer('jatuh_tempo');
            $table->decimal('harga_jasa',9,2);
            $table->text('keterangan')->default('-');
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
        Schema::dropIfExists('ms_dealers');
    }
}
