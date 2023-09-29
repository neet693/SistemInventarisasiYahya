@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Barang</h2>
        @include('components.barang-index-button')
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
                    <tr data-href="{{ route('barangs.show', $barang->id) }}">
                        {{-- <tr> --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->nama }}</td>
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
    </div>
@endsection
