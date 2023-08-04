@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Jenis Pengadaan</h2>
        <a href="{{ route('jenis_pengadaans.create') }}" class="btn btn-primary mb-2">Tambah Jenis Pengadaan</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisPengadaans as $jenisPengadaan)
                    <tr>
                        <td>{{ $jenisPengadaan->nama }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-gear-fill text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('jenis_pengadaans.show', $jenisPengadaan->id) }}"><i
                                            class="bi bi-eye text-white"title="Lihat Jenis Pengadaan"></i></a>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('jenis_pengadaans.edit', $jenisPengadaan->id) }}"><i
                                            class="bi bi-pencil-square text-white" title="Edit Jenis Pengadaan"></i></a>
                                    <form action="{{ route('jenis_pengadaans.destroy', $jenisPengadaan->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus Jenis Pengadaan ini?')"><i
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
