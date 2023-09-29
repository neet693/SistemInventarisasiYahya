@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Barang</h2>
        @include('components.barang-index-button')
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    {{-- <th>Kode Barang</th> --}}
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Tahun Pengadaan</th>
                    <th>Kondisi</th>
                    {{-- <th>Kategorial</th> --}}
                    <th>Ruangan</th>
                    {{-- <th>Jenis Pengadaan</th> --}}
                    <th>Jumlah</th>
                    {{-- <th>Sumber Peroleh</th> --}}
                    <th>Catatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    <tr data-href="{{ route('barangs.show', $barang->id) }}">
                        {{-- <tr> --}}
                        <td>{{ $loop->iteration }}</td>
                        {{-- <td>{{ $barang->kode_barang }}</td> --}}
                        <td>{{ $barang->nama }}</td>
                        <td>{{ $barang->merk }}</td>
                        <td>{{ $barang->tipe }}</td>
                        <td>{{ $barang->tahun }}</td>
                        <td>{{ $barang->kondisi }}</td>
                        {{-- <td>{{ $barang->kategorial ? $barang->kategorial->nama : 'Belum diisi' }}</td> --}}
                        <td>{{ $barang->ruangan ? $barang->ruangan->nama : 'Belum diisi' }}</td>
                        {{-- <td>{{ $barang->jenisPengadaan ? $barang->jenisPengadaan->nama : 'Belum diisi' }}</td> --}}
                        <td>{{ $barang->jumlah }}</td>
                        {{-- <td>{{ $barang->sumber_peroleh }}</td> --}}
                        <td>{{ $barang->catatan ?? 'Tidak ada catatan khusus' }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-gear-fill text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <a class="btn btn-primary btn-sm" href="{{ route('barangs.show', $barang->id) }}"><i
                                            class="bi bi-eye text-white"title="Lihat Barang"></i></a>
                                    <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"><i
                                                class="bi bi-trash3 text-white" title="Hapus Barang"></i></button>
                                    </form>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
