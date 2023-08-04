<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisRuangan extends Model
{
    use HasFactory;

    protected $table = 'jenis_ruangans';

    protected $fillable = ['kode_ruangan', 'nama'];

    public function ruangans()
    {
        return $this->hasMany(Ruangan::class, 'jenis_ruangan_id');
    }
}
