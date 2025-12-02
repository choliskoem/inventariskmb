@extends('layouts.app')

@section('title', 'Data Peminjaman')
@section('page-title', 'Data Peminjaman')

@section('content')
    <div class="card-modern">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold mb-0">Daftar Peminjaman</h3>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah Peminjaman
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Peminjam</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Waktu Peminjaman</th>
                        <th>Waktu Pengembalian</th>
                        <th>Lama Peminjaman</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Admin</th>
                        <th>Admin Approval</th>
                        @if (auth()->user()->role == 'admin')
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
                            <td>{{ \Carbon\Carbon::parse($p->waktu_peminjaman)->format('d-m-Y H:i') }}</td>
                            <td>{{ $p->waktu_pengembalian ? \Carbon\Carbon::parse($p->waktu_pengembalian)->format('d-m-Y H:i') : '-' }}
                            </td>
                            <td>{{ $p->lama_peminjaman }} hari</td>
                            <td>
                                @if ($p->status == 'Menunggu')
                                    <span class="badge bg-secondary">Menunggu ACC</span>
                                @elseif($p->status == 'Dipinjam')
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @elseif($p->status == 'Dikembalikan')
                                    <span class="badge bg-success">Kembali</span>
                                @elseif($p->status == 'Ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $p->keterangan ?? '-' }}</td>
                            <td>{{ $p->admin->name ?? '-' }}</td>
                            <td>
                                @if ($p->admin_approval == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($p->admin_approval == 'rejected')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">Belum ACC</span>
                                @endif
                            </td>
                            @if (auth()->user()->role == 'admin')
                                <td>
                                    @if ($p->admin_approval === null)
                                        <form action="{{ route('peminjaman.approve', $p->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button class="btn btn-success btn-sm" type="submit">Setujui</button>
                                        </form>
                                        <form action="{{ route('peminjaman.reject', $p->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit">Tolak</button>
                                        </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role == 'admin' ? 12 : 11 }}" class="text-center">
                                Belum ada data peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $peminjamans->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <style>
        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table td {
            white-space: nowrap;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection
