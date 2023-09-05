@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Status Perbaikan</h2>
        <a href="{{ route('status_perbaikans.create') }}" class="btn btn-primary mb-2">Tambah Status Perbaikan</a>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No Tiket Perbaikan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statusPerbaikans as $statusPerbaikan)
                    <tr>
                        <td>{{ $statusPerbaikan->no_tiket_perbaikan }}</td>
                        <td>{{ $statusPerbaikan->perbaikan->jumlah_perbaikan }}</td>
                        <td>{{ $statusPerbaikan->tanggal_selesai }}</td>
                        <td>{{ $statusPerbaikan->status }}</td>
                        <td>{{ $statusPerbaikan->keterangan }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-gear-fill text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('status_perbaikans.show', $statusPerbaikan->no_tiket_perbaikan) }}"><i
                                            class="bi bi-eye text-white"title="Lihat Barang"></i></a>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('status_perbaikans.edit', $statusPerbaikan->no_tiket_perbaikan) }}"><i
                                            class="bi bi-pencil-square text-white" title="Edit Barang"></i></a>

                                    <form
                                        action="{{ route('status_perbaikans.destroy', $statusPerbaikan->no_tiket_perbaikan) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus status perbaikan ini?')"><i
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
