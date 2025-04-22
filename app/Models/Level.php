<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'levels';

    protected $fillable = ['nama'];

    public function users()
    {
        return $this->hasMany(User::class, 'level_id');
    }

    public const IS_ADMIN = 1;
    public const IS_KEPALA = 2;
    public const IS_SARPRAS = 3;
    public const IS_TEKNISI = 4;
    public const IS_LABORAN = 5;
}
