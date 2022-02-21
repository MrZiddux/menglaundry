<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaran extends Model
{
    use HasFactory;
    protected $table = "tb_detail_pembayaran";
    protected $fillable = [
        'id_transaksi',
        'total_harga',
        'uang_dibayar',
        'diskon',
        'pajak',
        'biaya_tambahan',
        'total_bayar',
        'kembalian',
    ];
}
