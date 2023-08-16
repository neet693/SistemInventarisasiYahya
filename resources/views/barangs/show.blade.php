@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Barang</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>Kode Barang</th>
                    <td>{{ $barang->kode_barang }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $barang->nama }}</td>
                </tr>
                <tr>
                    <th>Merk</th>
                    <td>{{ $barang->merk }}</td>
                </tr>
                <tr>
                    <th>Spesifikasi</th>
                    <td>{{ $barang->spesifikasi }}</td>
                </tr>
                <tr>
                    <th>Tahun Pengadaan</th>
                    <td>{{ $barang->tahun }}</td>
                </tr>
                <tr>
                    <th>Kondisi</th>
                    <td>{{ $barang->kondisi }}</td>
                </tr>
                <tr>
                    <th>Kategorial</th>
                    <td>{{ $barang->kategorial ? $barang->kategorial->nama : 'Belum diisi' }}</td>
                </tr>
                <tr>
                    <th>Ruangan</th>
                    <td>{{ $barang->ruangan ? $barang->ruangan->nama : 'Belum diisi' }}</td>
                </tr>
                <tr>
                    <th>Jenis Pengadaan</th>
                    <td>{{ $barang->jenisPengadaan ? $barang->jenisPengadaan->nama : 'Belum diisi' }}</td>
                </tr>
                <tr>
                    <th>Sumber Perolehan</th>
                    <td>{{ $barang->sumber_peroleh }}</td>
                </tr>
                <tr>
                    <th>Jumlah Barang</th>
                    <td>{{ $barang->jumlah }}</td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td>{{ $barang->catatan ?? 'Tidak ada Catatan Khusus' }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
