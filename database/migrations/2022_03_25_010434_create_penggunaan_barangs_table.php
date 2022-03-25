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
      Schema::create('tb_penggunaan_barang', function (Blueprint $table) {
         $table->id();
         $table->string('nama_barang', 100);
         $table->integer('qty');
         $table->integer('harga');
         $table->dateTime('waktu_beli');
         $table->string('supplier', 30);
         $table->enum('status', ['diajukan_beli', 'habis', 'tersedia']);
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
      Schema::dropIfExists('tb_penggunaan_barang');
   }
};
