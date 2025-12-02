<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('peminjamans', function (Blueprint $table) {
        $table->id();

        $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');

        $table->string('nama_peminjam');
        
        $table->dateTime('waktu_peminjaman');
        $table->dateTime('waktu_pengembalian')->nullable();

        $table->string('lama_peminjaman')->nullable();

        $table->enum('status', ['Dipinjam', 'Dikembalikan'])->default('Dipinjam');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
