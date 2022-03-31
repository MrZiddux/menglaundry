<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiKerjaExport;
use App\Imports\AbsensiKerjaImport;
use App\Models\AbsensiKerja;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiKerjaController extends Controller
{
    public function getData()
    {
        $data = AbsensiKerja::all();
        return response()->json($data);
    }

    public function store(Request $r)
    {
        $data = new AbsensiKerja;
        $data->nama_karyawan = $r->nama_karyawan;
        $data->tanggal_masuk = $r->tanggal_masuk;
        if ($r->status == 'masuk') {
            $data->waktu_masuk = $r->waktu_masuk;
            $data->waktu_selesai = '00:00:00';
        } else if ($r->status == 'sakit' || $r->status == 'cuti') {
            $data->waktu_masuk = '00:00:00';
            $data->waktu_selesai = '00:00:00';
        }
        $data->status = $r->status;
        $data->save();
        return response()->json($data);
    }

    public function update(Request $r)
    {
        AbsensiKerja::findOrFail($r->id)->update($r->all());
        return response()->json(['status' => 'success']);
    }

    public function updateStatus(Request $r)
    {
        if ($r->status == 'masuk') {
            $data = AbsensiKerja::findOrFail($r->id);
            $data->waktu_masuk = now();
            $data->waktu_selesai = '00:00:00';
            $data->status = $r->status;
            $data->save();
        } else if ($r->status == 'sakit' || $r->status == 'cuti') {
            $data = AbsensiKerja::findOrFail($r->id);
            $data->waktu_selesai = '00:00:00';
            $data->status = $r->status;
            $data->save();
        }
        return response()->json(['status' => 'success']);
    }

    public function destroy(Request $r)
    {
        AbsensiKerja::findOrFail($r->id)->delete();
        return response()->json(['status' => 'success']);
    }

    public function selesai(Request $r)
    {
        $data = AbsensiKerja::findOrFail($r->id);
        $data->waktu_selesai = now();
        $data->save();
        return response()->json(['status' => 'success']);
    }

    public function export()
    {
        $date = date('Y-m-d-');
        return Excel::download(new AbsensiKerjaExport, $date . 'simulasi-kerja.xlsx');
    }

    public function import(Request $r)
    {
        $r->validate([
            'importFile' => 'required|mimes:csv,xls,xlsx',
        ]);
        Excel::import(new AbsensiKerjaImport, $r->file('importFile'));
        return back();
    }
}
