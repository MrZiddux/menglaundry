<?php

namespace App\Http\Controllers;

use App\Exports\PenggunaBarangExport;
use App\Models\PenggunaanBarang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PenggunaanBarangController extends Controller
{
   public function getData()
   {
      $data = PenggunaanBarang::get();
      return response()->json($data);
   }

   public function store(Request $r)
   {
      PenggunaanBarang::create([
         'nama_barang' => $r->nama_barang,
         'qty' => $r->qty,
         'harga' => $r->harga,
         'waktu_beli' => $r->waktu_beli,
         'supplier' => $r->supplier,
         'status' => $r->status,
      ]);
      return response()->json(['success' => true]);
   }

   public function update(Request $r)
   {
      PenggunaanBarang::findOrFail($r->id)->update([
         'nama_barang' => $r->nama_barang,
         'qty' => $r->qty,
         'harga' => $r->harga,
         'supplier' => $r->supplier,
         'status' => $r->status,
      ]);

      return response()->json(['success' => true]);
   }

   public function updateStatus(Request $r)
   {
      PenggunaanBarang::findOrFail($r->id)->update([
         'status' => $r->status,
      ]);
   }

   public function destroy(Request $r)
   {
      PenggunaanBarang::findOrFail($r->id)->delete();
      return response()->json(['success' => true]);
   }

   public function export()
   {
      $date = date('Y-m-d-');
      return Excel::download(new PenggunaBarangExport, $date . 'pengguna-barang.xlsx');
   }
}
