<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPerbaikan extends Model
{
    use HasFactory;

    protected $table = 'status_perbaikans';

    protected $primaryKey = 'no_tiket_perbaikan';

    public $incrementing = false;

    protected $fillable = ['no_tiket_perbaikan', 'tanggal_selesai', 'status', 'keterangan'];

    protected $cast = ['tanggal_selesai' => 'date'];

    public function perbaikan()
    {
        return $this->belongsTo(Perbaikan::class, 'no_tiket_perbaikan', 'no_tiket_perbaikan');
    }
}
