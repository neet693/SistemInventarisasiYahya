@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Jenis Ruangan</h2>
        <a href="{{ route('jenis_ruangans.create') }}" class="btn btn-primary mb-2">Tambah Jenis Ruangan</a>


        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisRuangans as $jenisRuangan)
                    <tr>
                        <td>{{ $jenisRuangan->nama }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-gear-fill text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('jenis_ruangans.show', $jenisRuangan->id) }}"><i
                                            class="bi bi-eye text-white"title="Lihat Jenis Pengadaan"></i></a>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('jenis_ruangans.edit', $jenisRuangan->id) }}"><i
                                            class="bi bi-pencil-square text-white" title="Edit Jenis Pengadaan"></i></a>
                                    <form action="{{ route('jenis_ruangans.destroy', $jenisRuangan->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus Jenis Ruangan ini?')"><i
                                                class="bi bi-trash3 text-white" title="Hapus Jenis Pengadaan"></i></button>
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
