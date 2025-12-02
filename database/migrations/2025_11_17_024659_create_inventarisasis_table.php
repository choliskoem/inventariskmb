<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('inventarisasis', function (Blueprint $table) {
        $table->id();
        $table->string('kode_barang');
        $table->string('nama_barang');
        $table->string('merek_barang')->nullable();
        $table->integer('jumlah_barang');
        $table->string('kondisi_barang');
        $table->string('nama_peminjam')->nullable();
        $table->dateTime('waktu_peminjaman')->nullable();
        $table->dateTime('waktu_pengembalian')->nullable();
        $table->string('lama_peminjaman')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarisasis');
    }
};
