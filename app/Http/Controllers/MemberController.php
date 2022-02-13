<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::get();
        return view('pages.members.index', compact('members'));
    }

    public function getData()
    {
        $members = Member::get();
        return response()->json($members);
    }

    public function store(Request $r)
    {
        Member::create($r->all());
        return response()->json(array('success' => true));
    }

    public function update(Request $r)
    {
        Member::find($r->id)->update($r->all());
        return response()->json(array('success' => true));
    }

    public function destroy(Request $r)
    {
        Member::findOrFail($r->id)->delete();
        return response()->json(array('success' => true));
    }
}
