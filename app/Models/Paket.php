<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
   use HasFactory;
   protected $table = 'tb_paket';
   protected $fillable = ['id_outlet', 'nama_paket', 'harga', 'jenis'];

   public function detail_transaksi()
   {
      return $this->hasMany(DetailTransaksi::class, 'id_paket');
   }
}
