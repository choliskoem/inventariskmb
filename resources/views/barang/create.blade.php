@extends('layouts.app')

@section('title', 'Tambah Barang')
@section('page-title', 'Tambah Barang')

@section('content')
<div class="card-modern p-4">
    <h3 class="fw-bold mb-3">Tambah Barang</h3>
    <p class="text-secondary mb-4">Silahkan isi data barang dengan lengkap.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali inputan:</strong>
            <ul class="mt-2 mb-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" placeholder="Masukkan kode barang" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" placeholder="Masukkan nama barang" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Merek Barang</label>
                <input type="text" name="merek_barang" class="form-control" placeholder="Masukkan merek barang">
            </div>

            <div class="col-md-6">
                <label class="form-label">Jumlah Barang</label>
                <input type="number" name="jumlah_barang" class="form-control" placeholder="Masukkan jumlah" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Kondisi Barang</label>
                <select class="form-select" name="kondisi_barang" required>
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="Baik">Baik</option>
                    <option value="Cukup Baik">Cukup Baik</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
        </div>

        <div class="mt-4 d-flex flex-column gap-2">
            <button type="submit" class="btn btn-primary w-100">Simpan Barang</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary w-100">Kembali</a>
        </div>
    </form>
</div>
@endsection
