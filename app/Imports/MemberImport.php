<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MemberImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Member([
            'nama' => $row[1],
            'jenis_kelamin' => $row[2],
            'tlp' => $row[3],
            'alamat' => $row[4],
        ]);
    }

    public function headingRow(): int
    {
        return 3;
    }
}
