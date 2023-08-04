<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPengadaan extends Model
{
    use HasFactory;

    protected $table = 'jenis_pengadaans';

    protected $fillable = ['nama'];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'jenis_pengadaan_id');
    }
}
