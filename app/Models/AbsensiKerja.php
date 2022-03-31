<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiKerja extends Model
{
    use HasFactory;
    protected $table = 'tb_absensi_kerja';
    protected $fillable = ['nama_karyawan', 'tanggal_masuk', 'waktu_masuk', 'waktu_selesai', 'status'];
}
