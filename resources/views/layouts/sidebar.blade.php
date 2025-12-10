<div class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('assets/images/rrilogo.png') }}" alt="RRI">
        <span>Dashboard RRI</span>
    </div>

    <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="fa fa-home"></i>
        <span>Dashboard</span>
    </a>

    <div class="sidebar-divider"></div>

    @auth
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('barang.create') }}" class="{{ request()->is('barang/create') ? 'active' : '' }}">
                <i class="fa fa-plus"></i>
                <span>Tambah Barang</span>
            </a>
        @endif
    @endauth

    {{-- <a href="{{ route('barang.index') }}" class="{{ request()->is('barang') ? 'active' : '' }}">
        <i class="fa fa-boxes"></i>
        <span>Data Barang</span>
    </a> --}}

    <a href="{{ route('peminjaman.index') }}" class="{{ request()->is('peminjaman') ? 'active' : '' }}">
        <i class="fa fa-hand-holding"></i>
        <span>Data Peminjaman</span>
    </a>

    {{-- Menu Pengembalian --}}
    <a href="{{ route('peminjaman.pengembalian') }}"
        class="{{ request()->is('peminjaman/pengembalian*') ? 'active' : '' }}">
        <i class="fa fa-undo"></i>
        <span>Pengembalian</span>
    </a>

    <a href="{{ route('peminjaman.laporan') }}" class="{{ request()->is('laporan*') ? 'active' : '' }}">
        <i class="fa fa-file-alt"></i>
        <span>Laporan</span>
    </a>
</div>
