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
        'total_harga',
        'diskon',
        'pajak',
        'biaya_tambahan',
        'kembalian',
    ];
}
