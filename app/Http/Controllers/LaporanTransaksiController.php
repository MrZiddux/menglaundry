<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanTransaksiController extends Controller
{
    public function getLaporanTransaksi(Request $r)
    {
        $data = Transaksi::with(['outlet', 'pembayaran' => function ($q) {
            $q->with('detail_pembayaran');
        }, 'member', 'detail_transaksi' => function ($q) {
            $q->with('paket');
        }, 'user'])->whereBetween('tgl', [$r->tgl_awal, $r->tgl_akhir])->get();
        return response()->json(array('data' => $data), 200);
    }
}
