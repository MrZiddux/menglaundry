<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class FakturController extends Controller
{
    public function __invoke($inv)
    {
        $transaksi =  Transaksi::with(['outlet', 'pembayaran' => function ($q) {
            $q->with('detail_pembayaran');
        }, 'member', 'detail_transaksi' => function ($q) {
            $q->with('paket');
        }, 'user'])->where('kode_invoice', $inv)->get();

        $detailTransaksi = DetailTransaksi::with(['transaksi' => function ($q) use ($inv) {
            $q->with('outlet');
            $q->with(['pembayaran' => function ($q) {
                $q->with('detail_pembayaran');
            }]);
            $q->with('member');
            $q->with('user');
        }, 'paket'])->where('id_transaksi', $transaksi[0]->id)->get();

        if ($transaksi->count() > 0 && $detailTransaksi->count() > 0) {
            return view('pages.faktur.index', compact('transaksi', 'detailTransaksi'));
        } else {
            return abort(404);
        }
    }
}
