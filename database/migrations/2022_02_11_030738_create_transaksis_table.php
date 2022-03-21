<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_outlet');
            $table->string('kode_invoice', 100);
            $table->unsignedBigInteger('id_member');
            $table->date('tgl');
            $table->date('batas_waktu');
            $table->date('tgl_bayar')->nullable();
            $table->enum('status', ['baru', 'proses', 'selesai', 'diambil']);
            $table->enum('pelunasan', ['sudah_lunas', 'belum_lunas']);
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_member')->references('id')->on('tb_member');
            $table->foreign('id_outlet')->references('id')->on('tb_outlet');
            $table->foreign('id_user')->references('id')->on('tb_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_transaksi');
    }
};
