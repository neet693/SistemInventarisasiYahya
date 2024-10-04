<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemindahanBarang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public $casts = [
        'tanggal_pemindahan' => 'datetime',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function unitAsal()
    {
        return $this->belongsTo(Unit::class, 'unit_asal_id');
    }

    public function unitTujuan()
    {
        return $this->belongsTo(Unit::class, 'unit_tujuan_id');
    }

    public function ruanganAsal()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_asal_id');
    }

    public function ruanganTujuan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_tujuan_id');
    }
}
