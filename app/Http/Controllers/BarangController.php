<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
  public function index()
{
    $barangs = Barang::orderBy('id', 'desc')->paginate(10);

    return view('dashboard', compact('barangs'));
}
    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang'    => 'required',
            'nama_barang'    => 'required',
            'merek_barang'   => 'nullable',
            'jumlah_barang'  => 'required|integer',
            'kondisi_barang' => 'required',
        ]);

        Barang::create([
            'kode_barang'    => $request->kode_barang,
            'nama_barang'    => $request->nama_barang,
            'merek_barang'   => $request->merek_barang,
            'jumlah_barang'  => $request->jumlah_barang,
            'kondisi_barang' => $request->kondisi_barang,
        ]);

        return redirect()->route('dashboard')->with('success', 'Barang berhasil ditambahkan!');
    }
}
