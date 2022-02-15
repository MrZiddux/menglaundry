<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
   public function check(Request $r)
   {
      if (Auth::attempt($r->only('username', 'password'))) {
         $r->session()->regenerate();
         return redirect('/');
      }

      throw ValidationException::withMessages([
         'username' => "Username can't be found",
         'password' => "Your password don't match in our records",
      ]);
   }

   public function logout()
   {
      Auth::logout();
      return response()->json(array('success' => true));
   }
}
