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
    protected $startRow = 2; // Mulai dari baris kedua (abaikan header)

    public function startRow(): int
    {
        return $this->startRow;
    }

    public function sheets(): array
    {
        return [
            0 => $this, // hanya proses sheet pertama
            1 => $this, // hanya proses sheet pertama
            2 => $this, // hanya proses sheet pertama
            3 => $this, // hanya proses sheet pertama
            4 => $this, // hanya proses sheet pertama
            5 => $this, // hanya proses sheet pertama
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            try {
                // Skip jika tidak ada kode_barang atau nama
                if (!$row[0] || !$row[1]) {
                    Log::warning('Baris dilewati karena tidak lengkap: ' . $row->implode(', '));
                    continue;
                }

                // Cek atau buat unit
                $unit = Unit::firstOrCreate(['nama' => $row[11]]);

                // Cari barang berdasarkan kode dan unit
                $barang = Barang::where('kode_barang', $row[0])
                    ->where('unit_id', $unit->id)
                    ->first();

                if (!$barang) {
                    Log::info('Barang baru ditambahkan: ' . $row[0]);

                    $barang = new Barang([
                        'kode_barang'     => $row[0],
                        'nama'            => $row[1],
                        'merk'            => $row[2],
                        'tipe'            => $row[3],
                        'catatan'         => $row[4],
                        'tahun'           => intval($row[5]),
                        'kondisi'         => $row[6],
                        'sumber_peroleh'  => $row[7],
                        'gambar_barang'   => $row[12] ?? null,
                    ]);

                    // Proses relasi
                    $ruangan = Ruangan::firstOrCreate(['nama' => $row[8]]);
                    $kategori = Kategorial::firstOrCreate(['nama' => $row[9]]);
                    $jenisPengadaan = JenisPengadaan::firstOrCreate(['nama' => $row[10]]);

                    $barang->ruangan_id = $ruangan->id;
                    $barang->kategorial_id = $kategori->id;
                    $barang->jenis_pengadaan_id = $jenisPengadaan->id;
                    $barang->unit_id = $unit->id;

                    $barang->save();
                } else {
                    Log::info('Barang sudah ada: ' . $barang->kode_barang);
                    // Jika ingin update field lain, bisa ditambahkan di sini
                    // $barang->update([...]);
                }
            } catch (\Exception $e) {
                Log::error("Gagal import barang: " . $e->getMessage());
            }
        }
    }
}
