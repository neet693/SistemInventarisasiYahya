<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $guarded = ['id'];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function kategorial()
    {
        return $this->belongsTo(Kategorial::class, 'kategorial_id');
    }

    public function jenisPengadaan()
    {
        return $this->belongsTo(JenisPengadaan::class, 'jenis_pengadaan_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
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
