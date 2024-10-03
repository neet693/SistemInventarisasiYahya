<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    public $table = 'peminjamans';
    protected $guarded = ['id'];

    public $casts = [
        'tanggal_pinjam' => 'datetime',
        'tanggal_kembali' => 'datetime'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class); // Menambahkan relasi ke model Unit jika ada
    }
}
