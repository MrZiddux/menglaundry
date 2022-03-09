<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'tb_pembayaran';
    protected $fillable = [
        'id_transaksi',
        'jenis_pembayaran',
        'total_harga',
        'diskon',
        'pajak',
        'biaya_tambahan',
        'kembalian',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function detail_pembayan()
    {
        return $this->hasMany(DetailPembayaran::class, 'id_pembayaran');
    }
}
