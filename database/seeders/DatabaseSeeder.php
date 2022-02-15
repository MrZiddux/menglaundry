<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run()
   {
      // \App\Models\User::factory(10)->create();
      Outlet::factory(100)->create();
      Member::factory(100)->create();
      Paket::factory(100)->create();
      User::factory(1)->create();
   }
}
