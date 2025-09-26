<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $connection = 'mysql'; // penting! pakai DB inventaris
    protected $table = 'activity_logs';
    protected $guarded = ['id']; // Atau, jika Anda ingin lebih aman, Anda bisa menggunakan 'fillable'

    // Anda bisa menambahkan relasi jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
