<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Menampilkan daftar peminjaman
public function index(Request $request)
{
    $query = Peminjaman::with(['user', 'barang'])  // eager load relasi
        ->where('status', '!=', 'Dikembalikan');   // Sembunyikan data yang sudah kembali

    // Filter pencarian
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('nama_peminjam', 'like', "%{$search}%")
              ->orWhere('jumlah', 'like', "%{$search}%");
        });
    }

    $peminjamans = $query->orderBy('waktu_peminjaman', 'desc')
                         ->paginate(10)
                         ->withQueryString();

    return view('peminjaman.index', compact('peminjamans'));
}

    // Form tambah peminjaman
    public function create()
{
    $barangs = Barang::all(); // Ambil semua barang untuk dropdown
    return view('peminjaman.create', compact('barangs'));
}


public function store(Request $request)
{
    $request->validate([
        'nama_peminjam' => 'required|string|max:255',
        'barang_id' => 'required|array',
        'barang_id.*' => 'exists:barangs,id',
        'jumlah' => 'required|array',
        // diabaikan: 'waktu_peminjaman' => 'required|date',
        'keterangan' => 'nullable|string',
    ]);

    $namaPeminjam = $request->nama_peminjam;
    $keterangan = $request->keterangan;

    // Gunakan waktu WITA (Asia/Makassar)
    $waktuPeminjaman = now('Asia/Makassar');

    foreach ($request->barang_id as $barangId) {
        $barang = Barang::find($barangId);
        $jumlahDipinjam = $request->jumlah[$barangId] ?? 1;

        if ($barang->jumlah_barang < $jumlahDipinjam) {
            return back()->withErrors("Jumlah peminjaman $barang->nama_barang melebihi stok tersedia ($barang->jumlah_barang).")
                         ->withInput();
        }

        Peminjaman::create([
            'nama_peminjam' => $namaPeminjam,
            'barang_id' => $barang->id,
            'jumlah' => $jumlahDipinjam,
            'waktu_peminjaman' => $waktuPeminjaman,
            'waktu_pengembalian' => null,
            'lama_peminjaman' => null,
            'keterangan' => $keterangan,
            'status' => 'Menunggu',
            'admin_id' => auth()->user()->role == 'admin' ? auth()->id() : null,
        ]);
    }

    return redirect()->route('peminjaman.index')
                     ->with('success', 'Peminjaman berhasil disimpan dan menunggu approval.');
}

// Approve peminjaman
public function approve($id)
{
    $p = Peminjaman::findOrFail($id);

    // update status & admin approval
    $p->update([
        'status' => 'Dipinjam',
        'admin_approval' => 'approved',
    ]);

    // kurangi stok
    $p->barang->decrement('jumlah_barang', $p->jumlah);

    return back()->with('success', 'Peminjaman disetujui.');
}

// Reject peminjaman
public function reject($id)
{
    $p = Peminjaman::findOrFail($id);
    $p->update([
        'status' => 'Ditolak',
        'admin_approval' => 'rejected',
    ]);

    return back()->with('success', 'Peminjaman ditolak.');
}
public function returnItem($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    $barang = $peminjaman->barang;

    // Tambahkan kembali stok
    $barang->increment('jumlah_barang', $peminjaman->jumlah);

    $peminjaman->update([
        'status' => 'Dikembalikan',
        'admin_approval' => 'approved',
    ]);

    return back()->with('success', 'Barang telah dikembalikan.');
}

// PeminjamanController.php

// Halaman data pengembalian
// PeminjamanController.php

// Halaman data pengembalian
// Halaman pengembalian
public function pengembalian()
{
    $peminjamans = Peminjaman::with(['barang', 'admin'])
        ->where('status', 'Dipinjam')  // Sudah dipinjam
        ->where('admin_approval', 'approved') // Peminjaman sudah ACC admin
        ->orderBy('waktu_peminjaman', 'desc')
        ->paginate(10);

    return view('pengembalian.index', compact('peminjamans'));
}

// User klik Kembalikan
// User mengembalikan barang
public function kembalikan($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    if ($peminjaman->status == 'Dipinjam' && $peminjaman->status_pengembalian === null) {
        $peminjaman->update([
            'status_pengembalian' => 'Menunggu', // menunggu ACC admin
        ]);
    }

    return redirect()->route('peminjaman.pengembalian')->with('success', 'Pengembalian berhasil diajukan. Menunggu ACC admin.');
}

// Admin ACC pengembalian
public function approvePengembalian($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    if ($peminjaman->status_pengembalian === 'Menunggu') {

        // Gunakan timezone WITA
        $waktuSekarang = now('Asia/Makassar');
        $waktuPinjam = \Carbon\Carbon::parse($peminjaman->waktu_peminjaman)
                        ->setTimezone('Asia/Makassar');

        $diff = $waktuPinjam->diff($waktuSekarang);

        // Buat text lama peminjaman
        $parts = [];
        if ($diff->d > 0) $parts[] = "{$diff->d} hari";
        if ($diff->h > 0) $parts[] = "{$diff->h} jam";
        if ($diff->i > 0) $parts[] = "{$diff->i} menit";

        $lamaPeminjaman = implode(' ', $parts);
        if ($lamaPeminjaman === '') $lamaPeminjaman = '0 menit';

        // Update data
        $peminjaman->update([
            'status_pengembalian' => 'Dikembalikan',
            'status' => 'Dikembalikan',
            'waktu_pengembalian' => $waktuSekarang,
            'lama_peminjaman' => $lamaPeminjaman,
            'admin_id' => auth()->id(),
        ]);

        // Tambah stok barang
        $barang = $peminjaman->barang;
        if ($barang) {
            $barang->increment('jumlah_barang', $peminjaman->jumlah);
        }

        return redirect()->route('peminjaman.pengembalian')
            ->with('success', 'Pengembalian telah disetujui.');
    }

    return back()->with('error', 'Status pengembalian tidak valid.');
}


public function laporan(Request $request)
{
    // Default bulan ini
    $bulan = $request->bulan ?? date('m');
    $tahun = $request->tahun ?? date('Y');

    // Ambil data riwayat peminjaman per bulan
    $peminjamans = Peminjaman::whereMonth('waktu_peminjaman', $bulan)
        ->whereYear('waktu_peminjaman', $tahun)
        ->orderBy('waktu_peminjaman', 'desc')
        ->paginate(10)
        ->withQueryString();

    // Untuk dropdown bulan & tahun
    $daftarBulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $daftarTahun = range(date('Y') , date('Y') + 5);

    return view('peminjaman.laporan', compact(
        'peminjamans', 
        'bulan', 
        'tahun',
        'daftarBulan',
        'daftarTahun'
    ));
}




}
