<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kode_barang', 'nama_barang', 'merek_barang',
        'jumlah_barang', 'kondisi_barang'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
