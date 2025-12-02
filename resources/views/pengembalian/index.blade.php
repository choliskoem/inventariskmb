@extends('layouts.app')

@section('title', 'Data Pengembalian')
@section('page-title', 'Data Pengembalian')

@section('content')
    <div class="card-modern">
        <h3 class="fw-bold mb-3">Daftar Pengembalian</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Peminjam</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Status Peminjaman</th>
                        <th>Status Pengembalian</th>
                        @if (auth()->user()->role === 'admin')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->nama_peminjam }}</td>
                            <td>{{ $p->barang->nama_barang ?? '-' }}</td>
                            <td>{{ $p->jumlah }}</td>
                            <td>
                                <span class="badge bg-warning">{{ $p->status }}</span>
                            </td>
                            <td>
                                @if ($p->status_pengembalian === 'Menunggu')
                                    <span class="badge bg-secondary">Menunggu ACC</span>
                                @elseif($p->status_pengembalian === 'Dikembalikan')
                                    <span class="badge bg-success">Dikembalikan</span>
                                @else
                                    <span class="badge bg-secondary">Belum Dikembalikan</span>
                                @endif
                            </td>
                            @if (auth()->user()->role === 'admin')
                                <td>
                                    @if ($p->status_pengembalian === 'Menunggu')
                                        <form action="{{ route('peminjaman.approvePengembalian', $p->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">ACC Pengembalian</button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>-</button>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'admin' ? 7 : 6 }}" class="text-center">Tidak ada data
                                pengembalian.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">{{ $peminjamans->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
@endsection
