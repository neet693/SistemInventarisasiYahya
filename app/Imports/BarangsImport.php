<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;

// class BarangsImport implements WithMultipleSheets
// {
//     public function sheets(): array
//     {
//         return [
//             'LAB1' => new Sheet1Import(),
//             'LAB2' => new Sheet2Import(),
//             'ICT' => new Sheet3Import(),
//             'Multimedia' => new Sheet4Import(),
//             'Kepala IT' => new Sheet5Import(),
//             'Tata Usaha' => new Sheet6Import(),
//             'R. Makan' => new Sheet7Import(),
//             // Tambahkan sheet-sheet lain sesuai kebutuhan Anda
//         ];
//     }
// }

class BarangsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $barang = Barang::where('kode_barang', $row[0])->orWhere('nama', $row[1])->first();
        // Pastikan nilai 'kondisi' dalam file Excel cocok dengan enum
        $nilaiEnum = ['Baik', 'Rusak', 'Butuh Perbaikan'];
        $kondisi = $row[6];

        if (!in_array($kondisi, $nilaiEnum)) {
            // Tindakan yang sesuai jika data tidak cocok, misalnya lewati baris ini atau berikan pesan kesalahan
            return null;
        }
        if ($barang) {
            // Jika barang sudah ada, update jumlahnya
            $barang->jumlah += $row[7];
            $barang->save();
        } else {
            return new Barang([
                'kode_barang'   => $row[0],
                'nama'  => $row[1],
                'merk'  => $row[2],
                'tipe'  => $row[3],
                'catatan'  => $row[4],
                'tahun' => intval($row[5]),
                // 'tahun'  => $row[6],
                'kondisi'  => $kondisi,
                'jumlah'  => $row[7],
                'sumber_peroleh'  => $row[8],
                'kode_ruangan'  => $row[9],
                'kategorial_id'  => $row[10],
                'jenis_pengadaan_id'  => $row[11],
            ]);
            $barang->save();
        }
    }
}
