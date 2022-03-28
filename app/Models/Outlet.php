<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
   use HasFactory;
   protected $table = 'tb_outlet';
   protected $fillable = ['nama', 'tlp', 'alamat'];

   public function transaksi()
   {
      return $this->hasMany(Transaksi::class, 'id_outlet');
   }

   public function user()
   {
      return $this->hasMany(User::class, 'id_outlet');
   }
}
