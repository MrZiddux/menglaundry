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
        Schema::create('tb_detail_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pembayaran');
            $table->integer('uang_dibayar');
            $table->timestamps();

            $table->foreign('id_pembayaran')->references('id')->on('tb_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_detail_pembayaran');
    }
};
