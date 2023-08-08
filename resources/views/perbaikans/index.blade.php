@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Perbaikan</h2>
        <a href="{{ route('perbaikans.create') }}" class="btn btn-primary mb-2">Tambah Perbaikan</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No Tiket Perbaikan</th>
                    <th>Kode Ruangan</th>
                    <th>Kode Barang</th>
                    <th>Tanggal Kerusakan</th>
                    <th>Keterangan</th>
                    <th>Penanggung Jawab</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perbaikans as $perbaikan)
                    <tr>
                        <td>{{ $perbaikan->no_tiket_perbaikan }}</td>
                        <td>{{ $perbaikan->ruangan->kode_ruangan }}</td>
                        <td>{{ $perbaikan->barang->kode_barang }}</td>
                        <td>{{ $perbaikan->tanggal_kerusakan }}</td>
                        <td>{{ $perbaikan->keterangan }}</td>
                        <td>{{ $perbaikan->penanggung_jawab }}</td>
                        <td>{{ $perbaikan->jumlah }}</td>
                        <td>{{ $perbaikan->is_selesai ? 'Selesai' : 'Belum Selesai' }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-gear-fill text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('perbaikans.show', $perbaikan->id) }}"><i
                                            class="bi bi-eye text-white"title="Lihat Barang"></i></a>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('perbaikans.edit', $perbaikan->id) }}"><i
                                            class="bi bi-pencil-square text-white" title="Edit Barang"></i></a>

                                    <form action="{{ route('perbaikans.destroy', $perbaikan->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data pernaikan ini?')"><i
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
