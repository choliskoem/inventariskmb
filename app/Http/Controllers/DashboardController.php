<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Query barang
        $barangs = Barang::query();

        // Fitur search
        if ($request->has('search') && $request->search != '') {
            $barangs->where('nama_barang', 'like', '%' . $request->search . '%')
                    ->orWhere('kode_barang', 'like', '%' . $request->search . '%')
                    ->orWhere('merek_barang', 'like', '%' . $request->search . '%');
        }

        // Pagination barang
        $barangsPaginated = $barangs->paginate(10)->withQueryString();

        // ---- Statistik ---- //

        // Total stok tersedia di gudang (belum dipinjam)
        $stokTersedia = Barang::sum('jumlah_barang');

        // Total barang yang sedang dipinjam
        $totalDipinjam = Peminjaman::where('status', 'Dipinjam')
            ->sum('jumlah');

        // Total barang fisik sebenarnya = stok tersedia + barang yang sedang dipinjam
        $totalBarang = $stokTersedia + $totalDipinjam;

        // Kirim ke view
        return view('dashboard', [
            'barangs' => $barangsPaginated,
            'totalBarang' => $totalBarang,
            'totalTersedia' => $stokTersedia,
            'totalDipinjam' => $totalDipinjam,
        ]);
    }
}
