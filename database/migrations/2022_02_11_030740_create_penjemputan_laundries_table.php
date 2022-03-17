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
        Schema::create('tb_penjemputan_laundry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_kurir');
            $table->enum('status', ['tercatat', 'penjemputan', 'selesai']);
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id')->on('tb_transaksi');
            $table->foreign('id_kurir')->references('id')->on('tb_kurir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_penjemputan_laundry');
    }
};
