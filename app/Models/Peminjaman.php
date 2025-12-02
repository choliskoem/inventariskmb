<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $fillable = [
        'barang_id', 'nama_peminjam',
        'waktu_peminjaman', 'waktu_pengembalian',
        'jumlah',
        'lama_peminjaman', 'status', 'admin_id', 'admin_approval' , 'keterangan',
        'status_pengembalian',
                            

    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function admin()
{
    return $this->belongsTo(User::class, 'admin_id');
}
public function user()
{
    return $this->belongsTo(User::class);
}

}
