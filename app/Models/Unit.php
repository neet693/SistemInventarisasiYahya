<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';
    protected $fillable = ['nama'];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'unit_id');
    }
}
