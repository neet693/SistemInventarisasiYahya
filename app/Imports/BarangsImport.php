<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\JenisPengadaan;
use App\Models\Kategorial;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BarangsImport implements ToCollection, WithStartRow
{
    protected $startRow = 2; // Mulai dari baris kedua (indeks 1)

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            try {
                $barang = Barang::where('kode_barang', $row[0])->orWhere('nama', $row[1])->first();

                if (!$barang) {
                    $barang = new Barang([
                        'kode_barang'   => $row[0],
                        'nama'          => $row[1],
                        'merk'          => $row[2],
                        'tipe'          => $row[3],
                        'catatan'       => $row[4],
                        'tahun'         => intval($row[5]),
                        'kondisi'       => $row[6],
                        'jumlah'        => $row[7],
                        'sumber_peroleh' => $row[8],
                        'kode_ruangan'  => $row[9],
                    ]);

                    $barang->save();
                } else {
                    $barang->jumlah += $row[7];
                    $barang->save();
                }

                $kategoriNama = $row[10];
                $jenisPengadaanNama = $row[11];

                $kategori = Kategorial::firstOrCreate(['nama' => $kategoriNama]);
                $jenisPengadaan = JenisPengadaan::firstOrCreate(['nama' => $jenisPengadaanNama]);

                $barang->kategorial_id = $kategori->id;
                $barang->jenis_pengadaan_id = $jenisPengadaan->id;
                $barang->save();
            } catch (\Exception $e) {
                // Tangani kesalahan di sini, seperti log pesan kesalahan atau lakukan tindakan lain sesuai kebutuhan Anda.
                Log::error($e->getMessage());
            }
        }
    }

    public function startRow(): int
    {
        return $this->startRow;
    }
}
