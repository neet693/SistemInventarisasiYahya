<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;

    protected $table = 'perbaikans';

    protected $fillable = ['no_tiket_perbaikan', 'tanggal_kerusakan', 'keterangan', 'penanggung_jawab', 'kondisi', 'barang_id', 'kode_ruangan', 'jumlah_perbaikan'];

    protected $casts = ['tanggal_kerusakan' => 'date'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'kode_ruangan', 'kode_ruangan');
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
