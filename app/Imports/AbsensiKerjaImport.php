<?php

namespace App\Imports;

use App\Models\AbsensiKerja;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsensiKerjaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new AbsensiKerja([
            'nama_karyawan' => $row['nama_karyawan'],
            'tanggal_masuk' => $row['tanggal_masuk'],
            'waktu_masuk' => $row['waktu_masuk'],
            'waktu_selesai' => $row['waktu_selesai'],
            'status' => $row['status']
        ]);
    }

    public function headingRow(): int
    {
        return 3;
    }
}
