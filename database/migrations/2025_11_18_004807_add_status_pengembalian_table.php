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
       Schema::table('peminjamans', function (Blueprint $table) {
    $table->enum('status_pengembalian', ['Menunggu', 'Dikembalikan'])->default('Menunggu');
    $table->enum('admin_approval_pengembalian', ['approved', 'rejected', null])->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            //
        });
    }
};
