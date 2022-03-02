<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MemberExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Member::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Jenis Kelamin',
            'Nomor Telepon',
            'Alamat',
        ];
    }
}
