<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanHarianController extends Controller
{
   public function showLaporanHarian()
   {
      $data = Transaksi::with(['outlet', 'pembayaran' => function ($q) {
         $q->with('detail_pembayaran');
      }, 'member', 'detail_transaksi' => function ($q) {
         $q->with('paket');
      }, 'user'])->where('tgl', date('Y-m-d'))->get();

      $data2 = DetailTransaksi::with(['transaksi' => function ($q) {
         $q->with('outlet');
         $q->with(['pembayaran' => function ($q) {
            $q->with('detail_pembayaran');
         }]);
         $q->with('member');
         $q->with('user');
         $q->where('tgl', now());
      }, 'paket'])->get();

      // return response()->json([
      //     'data' => $data,
      //     'data2' => $data2,
      // ]);
      return view('pages.laporan.harian.index', compact('data'));
   }
}
