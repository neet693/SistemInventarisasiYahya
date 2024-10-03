<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\JenisPengadaan;
use App\Models\Kategorial;
use App\Models\Ruangan;
use App\Models\Unit;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BarangsImport implements ToCollection, WithStartRow, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new BarangsImport(),
            1 => new BarangsImport(),
            2 => new BarangsImport(),
            3 => new BarangsImport(),
            4 => new BarangsImport(),
            5 => new BarangsImport(),
        ];
    }
    protected $startRow = 2; // Mulai dari baris kedua (indeks 1)

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            try {
                if (count($row) != 14) {
                    Log::error('Data tidak valid: ' . $row->implode(', '));
                    continue;
                }

                // Cari barang berdasarkan kode dan unit
                $unit = Unit::firstOrCreate(['nama' => $row[12]]);
                $barang = Barang::where('kode_barang', $row[0])
                    ->where('unit_id', $unit->id)
                    ->first();

                if (!$barang) {
                    Log::info('Barang baru ditambahkan: ' . $row[0]);
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
                        'gambar_barang' => $row[13],
                    ]);

                    // Proses untuk mencari atau membuat relasi lain
                    $ruangan = Ruangan::firstOrCreate(['nama' => $row[9]]);
                    $kategori = Kategorial::firstOrCreate(['nama' => $row[10]]);
                    $jenisPengadaan = JenisPengadaan::firstOrCreate(['nama' => $row[11]]);

                    // Set ID untuk relasi
                    $barang->ruangan_id = $ruangan->id;
                    $barang->kategorial_id = $kategori->id;
                    $barang->jenis_pengadaan_id = $jenisPengadaan->id;
                    $barang->unit_id = $unit->id;

                    $barang->save();
                } else {
                    Log::info('Barang sudah ada, jumlah ditambahkan untuk: ' . $barang->nama);
                    $barang->jumlah += $row[7];
                    $barang->save();
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }


    public function startRow(): int
    {
        return $this->startRow;
    }
}
