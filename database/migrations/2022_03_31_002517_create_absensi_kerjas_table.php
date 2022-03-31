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
        Schema::create('tb_absensi_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan');
            $table->date('tanggal_masuk');
            $table->time('waktu_masuk');
            $table->time('waktu_selesai');
            $table->enum('status', ['masuk', 'cuti', 'sakit']);
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
        Schema::dropIfExists('tb_absensi_kerja');
    }
};
