@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Barang</h2>
        <a class="btn btn-warning text-white" href="{{ route('barangs.edit', $barang->id) }}"><i
                class="bi bi-pencil-square text-white" title="Edit Barang"></i> Edit barang</a>
        <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger text-white"
                onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"><i class="bi bi-trash3 text-white"
                    title="Hapus Barang"></i> Hapus Barang</button>
        </form>
        <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>
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
                    <td>{{ $barang->tipe }}</td>
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
    </div>
@endsection
