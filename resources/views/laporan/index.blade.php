@extends('layouts.app')

@section('title', 'Laporan Riwayat')
@section('page-title', 'Laporan Peminjaman')

@section('content')

<div class="card-modern">

    <h4 class="fw-bold mb-3">Laporan Riwayat Peminjaman</h4>

    {{-- Filter Bulan --}}
    <form method="GET" class="mb-4">
        <label class="fw-bold mb-2">Pilih Bulan</label>
        <input type="month" name="bulan" value="{{ $bulan }}" class="form-control w-25 d-inline-block">
        <button class="btn btn-primary ms-2">Tampilkan</button>
    </form>

    {{-- Tabel Riwayat --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Peminjam</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($riwayat as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->barang->nama_barang }}</td>
                        <td>{{ $item->nama_peminjam }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>
                            @if($item->waktu_pengembalian)
                                {{ $item->waktu_pengembalian }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($item->status == 'Dikembalikan')
                                <span class="badge bg-success">Dikembalikan</span>
                            @elseif($item->status == 'Menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @else
                                <span class="badge bg-info">Dipinjam</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Tidak ada riwayat pada bulan ini
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
