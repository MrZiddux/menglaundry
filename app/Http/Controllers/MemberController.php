<?php

namespace App\Http\Controllers;

use App\Exports\MemberExport;
use App\Imports\MemberImport;
use App\Models\Member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
   /**
    * Menampilkan halaman member dan mengirimkan data member ke view
    */
   public function index()
   {
      $members = Member::get();
      return view('pages.members.index', compact('members'));
   }

   /**
    * Mengirimkan data member dari database dengan di return dalam bentuk json
    */
   public function getData()
   {
      $members = Member::get();
      return response()->json($members);
   }

   /**
    * Menambah data member dari view ke database
    */
   public function store(Request $r)
   {
      Member::create($r->all());
      return response()->json(array('success' => true));
   }

   /**
    * Mengupdate data member dari view ke database
    */
   public function update(Request $r)
   {
      Member::find($r->id)->update($r->all());
      return response()->json(array('success' => true));
   }

   /**
    * Menghapus data member dari database
    */
   public function destroy(Request $r)
   {
      Member::findOrFail($r->id)->delete();
      return response()->json(array('success' => true));
   }

   /**
    * Export data member ke excel
    */
   public function export()
   {
      $date = date('Y-m-d-');
      return Excel::download(new MemberExport, $date . 'member.xlsx');
   }

   /**
    * Import data member dari excel ke database
    */
   public function import(Request $r)
   {
      $r->validate([
         'importFile' => 'required|mimes:csv,xls,xlsx',
      ]);
      Excel::import(new MemberImport, $r->file('importFile'));
      return back();
   }
}
