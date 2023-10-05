<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perbaikan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'perbaikans';

    protected $fillable = ['no_tiket_perbaikan', 'tanggal_kerusakan', 'keterangan', 'penanggung_jawab', 'kondisi', 'barang_id', 'ruangan_id', 'jumlah_perbaikan', 'status'];

    protected $casts = ['tanggal_kerusakan' => 'date'];
    protected $dates = ['deleted_at'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function penempatan()
    {
        return $this->belongsTo(Penempatan::class);
    }

    public function statusPerbaikan()
    {
        return $this->hasOne(StatusPerbaikan::class, 'no_tiket_perbaikan', 'no_tiket_perbaikan');
    }
}
