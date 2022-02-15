<?php

namespace Database\Factories;

use App\Models\Outlet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paket>
 */
class PaketFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array
    */
   public function definition()
   {
      return [
         'id_outlet' => $this->faker->randomElement(Outlet::select('id')->get()),
         'jenis' => $this->faker->randomELement(['kiloan', 'selimut', 'bed_cover', 'kaos', 'lain']),
         'nama_paket' => $this->faker->words($nb = 3, $asText = true),
         'harga' => round($this->faker->numberBetween($min = 7500, $max = 50000), -3),
      ];
   }
}
