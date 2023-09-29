<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'kode_barang', 'nama', 'merk', 'tipe', 'catatan', 'tahun', 'kondisi', 'kode_ruangan', 'kategorial_id', 'jenis_pengadaan_id', 'jumlah', 'sumber_peroleh'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'kode_ruangan', 'kode_ruangan');
    }

    public function kategorial()
    {
        return $this->belongsTo(Kategorial::class, 'kategorial_id');
    }

    public function jenisPengadaan()
    {
        return $this->belongsTo(JenisPengadaan::class, 'jenis_pengadaan_id');
    }

    public function penempatans()
    {
        return $this->hasMany(Penempatan::class, 'barang_id');
    }

    public function perbaikans()
    {
        return $this->hasMany(Perbaikan::class, 'barang_id');
    }

    public function statusPerbaikans()
    {
        return $this->hasMany(StatusPerbaikan::class, 'barang_id');
    }
}
