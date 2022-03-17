<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;
    protected $table = 'tb_kurir';
    protected $fillable = ['nama', 'jenis_kelamin', 'alamat', 'tlp'];
    
    public function penjemputan_laundry()
    {
        return $this->hasMany(PenjemputanLaundry::class, 'id_kurir');
    }
}
