<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
   public function index()
   {
      return view('pages.packages.index');
   }

   public function getData()
   {
      $packages = Paket::get();
      return response()->json($packages);
   }

   public function store(Request $r)
   {
      Paket::create([
         'id_outlet' => 1,
         'jenis' => $r->jenis,
         'nama_paket' => $r->nama_paket,
         'harga' => $r->harga,
      ]);
      return response()->json(array('success' => true));
   }

   public function update(Request $r)
   {
      Paket::find($r->id)->update($r->all());
      return response()->json(array('success' => true));
   }

   public function destroy(Request $r)
   {
      Paket::findOrFail($r->id)->delete();
      return response()->json(array('success' => true));
   }
}
