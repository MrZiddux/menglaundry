<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
   public function showNewTransaction()
   {
      return view('pages.transaction.new.index');
   }

   // make function looping store data from new transaction

   public function store(Request $r)
   {
      dd($r);
      for ($i = 0; $i < count($r->id_barang); $i++) {
         $data = new Transaksi;
         $data->id_outlet = $r->id_outlet;
         $data->kode_invoice = $r->kode_invoice;
         $data->id_member = $r->id_member;
         $data->tgl = $r->tgl;
         $data->batas_waktu = $r->batas_waktu;
         $data->tgl_bayar = $r->tgl_bayar;
         $data->biaya_tambahan = $r->biaya_tambahan;
         $data->diskon = $r->diskon;
         $data->pajak = $r->pajak;
         $data->status = $r->status;
         $data->pelunasan = $r->pelunasan;
         $data->id_user = $r->id_user;
         $data->save();
      }
   }

   //make function for make transaction id like TRYYYYMMDD0001
   public function kode_transaksi()
   {
      $data = Transaksi::orderBy('id', 'desc')->first();
      if ($data == null) {
         $kode = 'TR' . date('ymd') . '0001';
      } else {
         $kode = 'TR' . date('ymd') . str_pad(((int)substr($data->kode_invoice, -4)) + 1, 4, '0', STR_PAD_LEFT);
      }
      return $kode;
   }
}
