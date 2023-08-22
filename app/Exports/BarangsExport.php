<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        return [
            '#',
            'Kode Barang',
            'Nama Barang',
            'Merk',
            'Spesifikasi',
            'Catatan',
            'Tahun',
            'Kondisi',
            'Jumlah',
            'Sumber Peroleh',
            'Created At',
            'Updated At',
            'Kode Ruangan',
            'ID Kategori',
            'Jenis Pengadaan ID',
        ];
    }
    public function collection()
    {
        return Barang::all();
    }
}
