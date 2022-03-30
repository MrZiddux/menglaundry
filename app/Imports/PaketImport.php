<?php

namespace App\Imports;

use App\Models\Paket;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PaketImport implements ToModel, WithHeadingRow
{
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   public function model(array $row)
   {
      return new Paket([
         'id_outlet' => auth()->user()->id_outlet,
         'nama_paket' => $row['nama_paket'],
         'jenis' => $row['jenis'],
         'harga' => $row['harga']
      ]);
   }

   public function headingRow(): int
   {
      return 3;
   }
}
