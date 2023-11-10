@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Ruangan</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>Kode Ruangan</th>
                    <td>{{ $ruangan->id }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $ruangan->nama }}</td>
                </tr>
                <tr>
                    <th>Gambar Ruangan</th>
                    <td>{{ $ruangan->gambar_ruangan }}</td>
                </tr>
                {{-- <tr>
                    <th>Jenis Ruangan</th>
                    <td>{{ $ruangan->jenisRuangan->nama }}</td>
                </tr> --}}
            </tbody>
        </table>

        <h2>Barang pada {{ $ruangan->nama }}</h2>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Kondisi</th>
                    <th>Ruangan</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    {{-- <tr data-href="{{ route('barangs.show', $barang->id) }}"> --}}
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('barangs.show', $barang->id) }}">{{ $barang->nama }}</a></td>
                        <td>{{ $barang->merk }}</td>
                        <td>{{ $barang->tipe }}</td>
                        <td>{{ $barang->kondisi }}</td>
                        {{-- <td>{{ $barang->kategorial ? $barang->kategorial->nama : 'Belum diisi' }}</td> --}}
                        <td>{{ $barang->ruangan ? $barang->ruangan->nama : 'Belum diisi' }}</td>
                        {{-- <td>{{ $barang->jenisPengadaan ? $barang->jenisPengadaan->nama : 'Belum diisi' }}</td> --}}
                        <td>{{ $barang->jumlah }}</td>
                        <td>{{ $barang->catatan ?? 'Tidak ada catatan khusus' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('ruangans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
