<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoBpkbDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_bpkb_dealer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_po',25);
            $table->integer('id_trn');
            $table->integer('status')->default(0);
            $table->date('tgl_validasi');
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('po_bpkb_dealers');
    }
}
