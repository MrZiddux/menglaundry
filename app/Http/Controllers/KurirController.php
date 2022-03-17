<?php

namespace App\Http\Controllers;

use App\Models\Kurir;
use Illuminate\Http\Request;

class KurirController extends Controller
{
    public function index()
    {
        $kurirs = Kurir::get();
        return view('pages.kurir.index', compact('kurirs'));
    }

    public function getData()
    {
        $kurirs = Kurir::get();
        return response()->json($kurirs);
    }

    public function store(Request $r)
    {
        Kurir::create($r->all());
        return response()->json(array('success' => true));
    }

    public function update(Request $r)
    {
        Kurir::find($r->id)->update($r->all());
        return response()->json(array('success' => true));
    }

    public function destroy(Request $r)
    {
        Kurir::findOrFail($r->id)->delete();
        return response()->json(array('success' => true));
    }
}
