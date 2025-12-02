@extends('layouts.app')

@section('title', 'Dashboard RRI')
@section('page-title', 'Dashboard')

@section('content')
    <h4 class="fw-bold mb-4">Selamat Datang di Dashboard 👋</h4>

    <!-- Stat Cards -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-modern d-flex align-items-center gap-3">
                <div class="card-icon"><i class="fa fa-box"></i></div>
                <div>
                    <h6 class="text-secondary mb-1">Total Barang</h6>
                    <h3 class="fw-bold">{{ $totalBarang }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-modern d-flex align-items-center gap-3">
                <div class="card-icon"><i class="fa fa-check-circle"></i></div>
                <div>
                    <h6 class="text-secondary mb-1">Barang Tersedia</h6>
                    <h3 class="fw-bold">{{ $totalTersedia }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-modern d-flex align-items-center gap-3">
                <div class="card-icon"><i class="fa fa-arrow-up-right-dots"></i></div>
                <div>
                    <h6 class="text-secondary mb-1">Barang Terpinjam</h6>
                    <h3 class="fw-bold">{{ $totalDipinjam }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card-modern mt-4">
        <h5 class="fw-bold mb-3">📦 Data Barang</h5>

        <form method="GET" action="{{ route('dashboard') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari barang..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                @if (request('search'))
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Reset</a>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Merek</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $b)
                        <tr>
                            <td>{{ $b->kode_barang }}</td>
                            <td>{{ $b->nama_barang }}</td>
                            <td>{{ $b->merek_barang }}</td>
                            <td>{{ $b->jumlah_barang }}</td>
                            <td>{{ $b->kondisi_barang }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">{{ $barangs->links('pagination::bootstrap-5') }}</div>
        </div>
    </div>
@endsection
