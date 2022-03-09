<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'tb_member';
    protected $fillable = ['nama', 'jenis_kelamin', 'alamat', 'tlp'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_member');
    }
}
