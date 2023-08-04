<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorial extends Model
{
    use HasFactory;
    protected $table = 'kategorials';

    protected $fillable = ['nama'];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategorial_id');
    }
}
