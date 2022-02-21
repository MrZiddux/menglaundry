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
        Schema::create('tb_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi');
            $table->double('total_harga');
            $table->double('diskon');
            $table->integer('pajak')->default(10);
            $table->integer('biaya_tambahan');
            $table->integer('kembalian');
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id')->on('tb_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pembayaran');
    }
};
