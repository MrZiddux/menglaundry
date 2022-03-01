<?php

namespace App\Http\Controllers;

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
         'pelunasan' => ($r->uang_dibayar != $r->total_harga ? 'belum_lunas' : 'lunas'),
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
         'total_harga' => $r->total_harga,
         'diskon' => $r->diskon,
         'pajak' => $r->pajak,
         'biaya_tambahan' => $r->biaya_tambahan,
         // 'kembalian' => $r->total_harga,
      ]);
   }
}
