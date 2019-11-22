<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoMstsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_mst', function (Blueprint $table) {
            $table->string('no_po',25)->primary();
            $table->date('tgl_po');
            $table->string('id_dealer',10);
            $table->integer('id_samsat');
            $table->string('provinsi',75);
            $table->string('kota',75);
            $table->decimal('total',12,2);
            $table->integer('id_user');
            $table->text('keterangan');
            $table->tinyInteger('status_notice')->default(0)->comment('0: belum notice atau belum selesai, 1: notice selesai semua');
            $table->tinyInteger('status_notice_kelengkapan')->default(0)->comment('0: belum lengkap, 1: lengkap semua');
            $table->tinyInteger('status_stnk_samsat')->comment('0: belum terima dari samsat, 1: sudah terima dari samsat')->default(0);
            $table->tinyInteger('status_stnk_dealer')->comment('0: belum dikirim ke dealer, 1: sudah diterima dealer')->default(0);
            $table->tinyInteger('status_bpkb_samsat')->comment('0: belum terima dari samsat, 1: sudah terima dari samsat')->default(0);
            $table->tinyInteger('status_bpkb_dealer')->comment('0: belum dikirim ke dealer, 1: sudah diterima dealer')->default(0);
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
        Schema::dropIfExists('po_msts');
    }
}
