<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;

class TestImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Member([
            'nama' => $row[0],
            'jenis_kelamin' => $row[1],
            'tlp' => $row[2],
            'alamat' => $row[3],
        ]);
    }
}
