<?php

namespace App\Http\Controllers;

use App\Exports\PenjemputanExport;
use App\Models\Kurir;
use App\Models\PenjemputanLaundry;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PenjemputanLaundryController extends Controller
{
    public function store(Request $r)
    {
        PenjemputanLaundry::create($r->all());
        return response()->json(array('success' => true));
    }

    public function showPenjemputanLaundry()
    {
        $data = PenjemputanLaundry::with(['transaksi' => function($q) {
            $q->with('outlet');
            $q->with('member');
            $q->with('user');
            $q->with(['detail_transaksi' => function($q) {
                $q->with('paket');
            }]);
        }, 'kurir'])->get();
        return response()->json($data);
    }

    public function updateStatus(Request $r)
    {
        PenjemputanLaundry::findOrFail($r->id)->update([
            'status' => $r->status
        ]);
        return response()->json(array('success' => true));
    }

    public function update(Request $r)
    {
        PenjemputanLaundry::findOrFail($r->id)->update($r->all());
        return response()->json(array('success' => true));
    }

    public function destroy(Request $r)
    {
        PenjemputanLaundry::findOrFail($r->id)->delete($r->all());
        return response()->json(array('success' => true));
    }

    public function getDataTransactionSelesai()
    {
        // $data = Transaksi::where('status', 'selesai')->whereNull('id_penjemputan')->get();
        $data = Transaksi::where('status', 'selesai')->get();
        return response()->json($data);
    }

    public function getDataKurir()
    {
        $data = Kurir::get();
        return response()->json($data);
    }

    public function export()
    {
        $date = date('Y-m-d-');
        return Excel::download(new PenjemputanExport, $date . 'member.xlsx');
    }
}
