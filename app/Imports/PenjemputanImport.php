<?php

namespace App\Imports;

use App\Models\PenjemputanLaundry;
use Maatwebsite\Excel\Concerns\ToModel;

class PenjemputanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PenjemputanLaundry([
            'id_transaksi' => $row[0],
            'id_kurir' => $row[1],
            'status' => $row[2],
        ]);
    }
}
