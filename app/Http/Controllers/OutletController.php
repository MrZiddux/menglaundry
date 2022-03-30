<?php

namespace App\Http\Controllers;

use App\Exports\OutletExport;
use App\Imports\OutletImport;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OutletController extends Controller
{
   public function index()
   {
      $outlets = Outlet::get();
      return view('pages.outlets.index', compact('outlets'));
   }

   public function getData()
   {
      $outlets = Outlet::get();
      return response()->json($outlets);
   }

   public function store(Request $r)
   {
      Outlet::create($r->all());
      return response()->json(array('success' => true));
   }

   public function update(Request $r)
   {
      Outlet::find($r->id)->update($r->all());
      return response()->json(array('success' => true));
   }

   public function destroy(Request $r)
   {
      Outlet::findOrFail($r->id)->delete();
      return response()->json(array('success' => true));
   }

   public function export()
   {
      $date = date('Y-m-d-');
      return Excel::download(new OutletExport, $date . 'outlet.xlsx');
   }

   public function import(Request $r)
   {
      $r->validate([
         'importFile' => 'required|mimes:csv,xls,xlsx',
      ]);
      Excel::import(new OutletImport, $r->file('importFile'));
      return back();
   }
}
