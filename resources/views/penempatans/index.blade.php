@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Penempatan</h2>
        <a href="{{ route('penempatans.create') }}" class="btn btn-primary mb-2">Tambah Penempatan</a>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Kode Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Jenis Ruangan</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penempatans as $penempatan)
                    <tr>
                        <td>{{ $penempatan->kode_ruangan }}</td>
                        <td>{{ $penempatan->ruangan ? $penempatan->ruangan->nama : 'Belum diisi' }}</td>
                        <td>{{ $penempatan->jenisRuangan ? $penempatan->jenisRuangan->nama : 'Belum diisi' }}</td>
                        <td>{{ $penempatan->barang ? $penempatan->barang->nama : 'Belum diisi' }}</td>
                        <td>{{ $penempatan->jumlah_ditempatkan }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-gear-fill text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    {{-- <a class="btn btn-primary btn-sm"
                                        href="{{ route('penempatans.show', $penempatan->barang_id) }}"><i
                                            class="bi bi-eye text-white"title="Lihat Penempatan Ruangan"></i>
                                    </a> --}}
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('penempatans.edit', $penempatan->barang_id) }}"><i
                                            class="bi bi-pencil-square text-white" title="Edit Penempatan Ruangan"></i></a>
                                    <form action="{{ route('penempatans.destroy', $penempatan->barang_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus Penempatan Ruangan ini?')"><i
                                                class="bi bi-trash3 text-white"
                                                title="Hapus Penempatan Ruangan"></i></button>
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
