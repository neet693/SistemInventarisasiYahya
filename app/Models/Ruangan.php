<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangans';

    // protected $primaryKey = 'kode_ruangan';

    // protected $fillable = ['kode_ruangan', 'nama', 'jenis_ruangan_id'];
    // protected $fillable = ['nama', 'gambar_ruangan'];
    protected $guarded = ['id'];

    public $incrementing = false;

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kode_ruangan', 'kode_ruangan');
    }

    // public function jenisRuangan()
    // {
    //     return $this->belongsTo(JenisRuangan::class, 'jenis_ruangan_id');
    // }
}
