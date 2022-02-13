<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::get();
        return view('pages.outlets.index', compact('outlets'));
    }

    public function getData()
    {
        $outlets = Outlet::get();
        return response()->json($outlets);
    }

    public function store(Request $r)
    {
        Outlet::create($r->all());
        return response()->json(array('success' => true));
    }

    public function update(Request $r)
    {
        Outlet::find($r->id)->update($r->all());
        return response()->json(array('success' => true));
    }

    public function destroy(Request $r)
    {
        Outlet::findOrFail($r->id)->delete();
        return response()->json(array('success' => true));
    }
}
