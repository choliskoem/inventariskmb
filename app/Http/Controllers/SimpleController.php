<?php

namespace App\Http\Controllers;

use App\Models\UserSimple;
use Illuminate\Http\Request;

class SimpleController extends Controller
{
    public function index()
{
    $data = UserSimple::all();
    return view('form', compact('data'));
}


    public function store(Request $request)
    {
        UserSimple::create([
            'nama' => $request->nama,
            'email' => $request->email
        ]);

        return back()->with('success', 'Data berhasil disimpan!');
    }
}
