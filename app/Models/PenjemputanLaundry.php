<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjemputanLaundry extends Model
{
    use HasFactory;
    protected $table = 'tb_penjemputan_laundry';
    protected $fillable = [
        'id_transaksi',
        'id_kurir',
        'status',
    ];

    public function transaksi()
    {
        return $this->belongsTo('App\Models\Transaksi', 'id_transaksi');
    }

    public function kurir()
    {
        return $this->belongsTo('App\Models\Kurir', 'id_kurir');
    }
}
