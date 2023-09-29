<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BarangsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            // '#',
            'Kode Barang',
            'Nama Barang',
            'Merk',
            'Tipe',
            'Catatan',
            'Tahun',
            'Kondisi',
            'Jumlah',
            'Sumber Peroleh',
            'Kode Ruangan',
            'Kategori',
            'Jenis Pengadaan',
        ];
    }
    public function collection()
    {
        return Barang::all();
    }

    public function map($barang): array
    {
        return [
            $barang->kode_barang,
            $barang->nama,
            $barang->merk,
            $barang->tipe,
            $barang->catatan,
            $barang->tahun,
            $barang->kondisi,
            $barang->jumlah,
            $barang->sumber_peroleh,
            $barang->kode_ruangan,
            $barang->kategorial->nama,
            $barang->jenisPengadaan->nama,
        ];
    }
}
