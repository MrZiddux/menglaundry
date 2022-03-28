<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function getData()
   {
      $users = User::with('outlet')->get();
      return response()->json($users);
   }
}
