<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $connection = 'mysql'; // default DB inventaris
    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'unit_id',
        'level_id',
        'simpeg_user_id',
    ];


    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    // 🔽 Tambahkan helper role check ini
    public function isAdmin()
    {
        return $this->level_id == 1;
    }

    public function isKepala()
    {
        return $this->level_id == 2;
    }

    public function isSarpras()
    {
        return $this->level_id == 3;
    }

    public function isTeknisi()
    {
        return $this->level_id == 4;
    }

    public function isLaboran()
    {
        return $this->level_id == 5;
    }
}
