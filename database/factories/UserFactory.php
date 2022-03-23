<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      return [
         'nama' => 'Admin',
         'username' => "zilaundry.id",
         'tlp' => "085788889999",
         'alamat' => "Jln. KH Abdullah bin Nuh",
         // 'email_verified_at' => now(),
         'password' => bcrypt('123123'),
         'id_outlet' => 1,
         'role' => 'admin',
         // 'remember_token' => Str::random(10),
      ];
   }

   /**
    * Indicate that the model's email address should be unverified.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
   public function unverified()
   {
      return $this->state(function (array $attributes) {
         return [
            'email_verified_at' => null,
         ];
      });
   }
}
