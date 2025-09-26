<?php

// app/Models/SimpegUser.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class SimpegUser extends Authenticatable
{
    protected $connection = 'simpeg';
    protected $table = 'users';

    protected $fillable = ['nama', 'telp', 'email', 'password', 'role', 'foto'];

    protected $hidden = ['password', 'remember_token'];
}
