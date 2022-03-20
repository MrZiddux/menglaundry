<?php

namespace App\Http\Controllers;

use App\Models\DetailPembayaran;
use App\Models\DetailTransaksi;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
   public function showNewTransaction()
   {
      return view('pages.transaction.new.index');
   }

   private function generateKodeInvoice()
   {
      $formatInvoice = 'INV' . date('Ymd');
      $lastInvoice = Transaksi::orderBy('kode_invoice', 'desc')->first();
      $generateInvoice = (is_null($lastInvoice)) ? '001' : (int)substr($lastInvoice->kode_invoice, strlen($formatInvoice) + 1, strlen($lastInvoice->kode_invoice)) + 1;
      $generateInvoiceAfter = (strlen($generateInvoice) < 3) ? str_repeat('0', 3 - strlen($generateInvoice)) . $generateInvoice : $generateInvoice;
      $kodeInvoice = $formatInvoice . $generateInvoiceAfter;
      return $kodeInvoice;
   }

   public function store(Request $r)
   {
      // dd($r);
      $transaksi = Transaksi::create([
         'id_outlet' => auth()->user()->id_outlet,
         'kode_invoice' => $this->generateKodeInvoice(),
         'id_member' => $r->id_member,
         'tgl' => $r->tgl,
         'batas_waktu' => $r->batas_waktu,
         'tgl_bayar' => ($r->uang_dibayar != 0 ? date('Y-m-d H:i:s') : null),
         'status' => 'baru',
         'pelunasan' => $r->uang_dibayar >= $r->total_harga ? 'sudah_lunas' : 'belum_lunas',
         'id_user' => auth()->user()->id,
      ]);

      // create looping for detail transaksi
      for ($i = 0; $i < count($r['item']['id_paket']); $i++) {
         DetailTransaksi::create([
            'id_transaksi' => $transaksi->id,
            'id_paket' => $r['item']['id_paket'][$i],
            'qty' => $r['item']['qty'][$i],
            'harga' => $r['item']['harga'][$i],
            'subtotal' => $r['item']['qty'][$i] * $r['item']['harga'][$i],
            'keterangan' => '',
         ]);
      };

      $pembayaran = Pembayaran::create([
         'id_transaksi' => $transaksi->id,
         'jenis_pembayaran' => $r->jenis_pembayaran,
         'total_harga' => $r->total_harga,
         'diskon' => $r->diskon,
         'pajak' => $r->pajak,
         'biaya_tambahan' => $r->biaya_tambahan,
         'kembalian' => $r->uang_dibayar - $r->total_harga
      ]);

      DetailPembayaran::create([
         'id_pembayaran' => $pembayaran->id,
         'uang_dibayar' => $r->uang_dibayar,
      ]);

      return response()->json(array('success' => true));
   }

   public function showTransactions()
   {
      $data = Transaksi::with(['outlet', 'pembayaran', 'detail_transaksi' => function ($q) {
         $q->with('paket');
      }, 'member', 'user'])->get();

      return response()->json($data);
   }

   public function updateStatus(Request $r)
   {
      $transaksi = Transaksi::find($r->id);
      $transaksi->status = $r->status;
      $transaksi->save();

      return response()->json(array('success' => true));
   }
}
