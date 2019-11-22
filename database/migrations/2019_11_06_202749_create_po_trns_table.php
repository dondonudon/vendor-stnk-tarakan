<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTrnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_trns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_po',25);
            $table->string('kode_kendaraan',25);
            $table->string('no_mesin',50);
            $table->string('nama_stnk',75);
            $table->string('no_pol',12)->nullable();
            $table->text('ukuran')->nullable();
            $table->text('warna_dasar')->nullable();
            $table->text('bulan_pajak')->nullable();
            $table->text('tahun')->nullable();
            $table->text('proses')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('no_notice_bbn',25)->nullable();
            $table->date('tgl_notice_bbn')->nullable();
            $table->decimal('harga_notice_bbn',9,2);
            $table->decimal('harga_jasa',9,2);
            $table->decimal('pph',9,2);
            $table->decimal('pnbp',9,2);
            $table->decimal('subtotal',10,2);
            $table->tinyInteger('info_kelengkapan')->default('-');
            $table->tinyInteger('status_bbn_proses')->comment('0: belum, 1: sudah')->default(0);
            $table->tinyInteger('status_bbn_kelengkapan')->comment('0: belum, 1: sudah')->default(0);
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
        Schema::dropIfExists('po_trns');
    }
}
