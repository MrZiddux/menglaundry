<?php

namespace App\Http\Controllers;

use App\Exports\PaketExport;
use App\Imports\PaketImport;
use App\Models\Paket;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaketController extends Controller
{
   public function index()
   {
      return view('pages.packages.index');
   }

   public function getData()
   {
      $packages = Paket::where('id_outlet', auth()->user()->id_outlet)->get();
      // $packages = Paket::get();
      return response()->json($packages);
   }

   public function store(Request $r)
   {
      Paket::create([
         'id_outlet' => auth()->user()->id_outlet,
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

   public function export()
   {
      $date = date('Y-m-d-');
      return Excel::download(new PaketExport, $date . 'paket.xlsx');
   }

   public function import(Request $r)
   {
      $r->validate([
         'importFile' => 'required|mimes:csv,xls,xlsx',
      ]);
      Excel::import(new PaketImport, $r->file('importFile'));
      return back();
   }
}
