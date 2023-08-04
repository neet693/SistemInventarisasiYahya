<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;

    protected $table = 'penempatans';
    public $incrementing = false;
    protected $primaryKey = 'kode_ruangan';
    protected $fillable = ['kode_ruangan', 'jenis_ruangan_id', 'barang_id', 'jumlah'];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'kode_ruangan', 'kode_ruangan');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function jenisRuangan()
    {
        return $this->belongsTo(JenisRuangan::class, 'jenis_ruangan_id');
    }
}
