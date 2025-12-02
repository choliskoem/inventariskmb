@extends('layouts.app')

@section('title', 'Laporan Peminjaman')
@section('page-title', 'Laporan Peminjaman')

@section('content')
    <div class="card-modern">
        <h3 class="fw-bold mb-3">📄 Laporan Riwayat Peminjaman</h3>

        <form method="GET" action="{{ route('peminjaman.laporan') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label">Pilih Bulan</label>
                <select name="bulan" class="form-select">
                    @foreach ($daftarBulan as $key => $b)
                        <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>
                            {{ $b }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Pilih Tahun</label>
                <select name="tahun" class="form-select">
                    @foreach ($daftarTahun as $t)
                        <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>{{ $t }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                    <i class="fa fa-search"></i> Tampilkan
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Peminjam</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Waktu Peminjaman</th>
                        <th>Waktu Pengembalian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->nama_peminjam }}</td>
                            <td>{{ $p->barang->nama_barang ?? '-' }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ $p->waktu_peminjaman }}</td>
                            <td>{{ $p->waktu_pengembalian ?? '-' }}</td>
                            <td>
                                @if ($p->status == 'Dipinjam')
                                    <span class="badge bg-warning">Dipinjam</span>
                                @elseif ($p->status == 'Dikembalikan')
                                    <span class="badge bg-success">Dikembalikan</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data riwayat bulan ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">{{ $peminjamans->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
@endsection
