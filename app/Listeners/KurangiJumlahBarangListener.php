<?php

namespace App\Listeners;

use App\Events\PenempatanCreated;
use App\Models\Barang;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class KurangiJumlahBarangListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PenempatanCreated $event): void
    {
        $penempatan = $event->penempatan;
        $barang = Barang::findOrFail($penempatan->barang_id);

        // Kurangi jumlah barang yang tersedia dengan jumlah barang yang ditempatkan
        $barang->jumlah_barang -= $penempatan->jumlah_barang;
        $barang->save();
    }
}
