<?php

namespace App\Exports;

use App\Models\PenjemputanLaundry;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenjemputanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PenjemputanLaundry::get();
    }
}
