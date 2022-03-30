<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index()
   {
      $outlets = Outlet::all();
      return view('pages.users.index', compact('outlets'));
   }

   public function getData()
   {
      // get users expect user login
      $users = User::with('outlet')->where('id', '!=', auth()->user()->id)->get();
      return response()->json($users);
   }

   public function store(Request $r)
   {
      User::create([
         'nama' => $r->nama,
         'tlp' => $r->tlp,
         'password' => Hash::make($r->password),
         'id_outlet' => $r->id_outlet,
         'role' => $r->role,
         'username' => $r->username,
         'alamat' => $r->alamat,
      ]);
      return response()->json(['success' => true]);
   }

   public function update(Request $r)
   {
      $user = User::find($r->id);
      $user->update($r->all());
      return response()->json(['success' => true]);
   }

   public function destroy(Request $r)
   {
      $user = User::find($r->id);
      $user->delete();
      return response()->json(['success' => true]);
   }

   public function changePassword(Request $r)
   {
      $user = User::find($r->id);
      if (Hash::check($r->password_lama, $user->password)) {
         $user->update([
            'password' => Hash::make($r->password_baru)
         ]);
         return response()->json(['success' => true]);
      } else {
         return response()->json(['success' => false]);
      }
   }
}
