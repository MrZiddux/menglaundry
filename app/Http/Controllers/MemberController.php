<?php

namespace App\Http\Controllers;

use App\Exports\MemberExport;
use App\Imports\MemberImport;
use App\Models\Member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
   public function index()
   {
      $members = Member::get();
      return view('pages.members.index', compact('members'));
   }

   public function getData()
   {
      $members = Member::get();
      return response()->json($members);
   }

   public function store(Request $r)
   {
      Member::create($r->all());
      return response()->json(array('success' => true));
   }

   public function update(Request $r)
   {
      Member::find($r->id)->update($r->all());
      return response()->json(array('success' => true));
   }

   public function destroy(Request $r)
   {
      Member::findOrFail($r->id)->delete();
      return response()->json(array('success' => true));
   }

   public function export()
   {
      $date = date('Y-m-d-');
      return Excel::download(new MemberExport, $date . 'member.xlsx');
   }

   public function import(Request $r)
   {
      $r->validate([
         'importFile' => 'required|mimes:csv,xls,xlsx',
      ]);
      Excel::import(new MemberImport, $r->file('importFile'));
      return back();
   }
}
