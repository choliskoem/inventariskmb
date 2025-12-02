@extends('layouts.app')

@section('title', 'Tambah Peminjaman')
@section('page-title', 'Tambah Peminjaman')

@section('content')
    <div class="card-modern">
        <h3 class="fw-bold mb-3">Tambah Peminjaman</h3>
        <p class="text-secondary mb-4">Isi data peminjaman dengan lengkap.</p>

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

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Peminjam</label>
                <input type="text" name="nama_peminjam" class="form-control bg-light" value="{{ auth()->user()->name }}"
                    readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Barang</label>
                <select class="form-select" name="barang_id[]" id="barang-select" multiple="multiple" required>
                    @foreach ($barangs as $b)
                        @if ($b->jumlah_barang > 0)
                            <option value="{{ $b->id }}" data-stok="{{ $b->jumlah_barang }}">
                                {{ $b->nama_barang }} (Stok: {{ $b->jumlah_barang }}) (Merek: {{ $b->merek_barang }})
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div id="jumlah-container" class="mb-3 row g-2"></div>

            <div class="mb-3">
                <label class="form-label">Waktu Peminjaman</label>
                <input type="datetime-local" name="waktu_peminjaman" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3" placeholder="Tuliskan keterangan peminjaman (opsional)"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Simpan Peminjaman</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary w-100 mt-2">Kembali</a>
        </form>
    </div>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container--default .select2-selection--multiple {
            min-height: 42px;
            padding: 4px 8px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #0d6efd;
            border: none;
            color: white;
            padding: 2px 6px;
            font-size: 0.9rem;
            margin-top: 4px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: white;
            margin-right: 2px;
        }

        /* Input nama peminjam abu-abu */
        input[readonly] {
            background-color: #e9ecef !important;
            color: #495057;
        }
    </style>

    <!-- jQuery & Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 dengan search
            $('#barang-select').select2({
                placeholder: "-- Pilih Barang --",
                width: '100%',
                allowClear: true,
                closeOnSelect: false,
                minimumResultsForSearch: 0
            });

            // Update input jumlah per barang
            function updateJumlahInputs() {
                const selectedOptions = $('#barang-select').select2('data');
                const container = $('#jumlah-container');
                container.empty();

                selectedOptions.forEach(option => {
                    const stok = $('#barang-select option[value="' + option.id + '"]').data('stok');
                    const div = $(`
                <div class="col-6 col-md-4">
                    <label class="form-label small mb-1">${option.text}</label>
                    <input type="number" name="jumlah[${option.id}]" class="form-control form-control-sm" min="1" max="${stok}" value="1" required>
                </div>
            `);
                    container.append(div);
                });
            }

            $('#barang-select').on('change', updateJumlahInputs);
        });
    </script>
@endsection
