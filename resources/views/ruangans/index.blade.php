@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Ruangan</h2>
        <a href="{{ route('ruangans.create') }}" class="btn btn-primary mb-2">Tambah Ruangan</a>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ruangans as $ruangan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ruangan->nama }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-gear-fill text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <a class="btn btn-primary btn-sm" href="{{ route('ruangans.show', $ruangan->id) }}"><i
                                            class="bi bi-eye text-white"title="Lihat Ruangan"></i></a>
                                    <a class="btn btn-warning btn-sm" href="{{ route('ruangans.edit', $ruangan->id) }}"><i
                                            class="bi bi-pencil-square text-white" title="Edit Ruangan"></i></a>
                                    <form action="{{ route('ruangans.destroy', $ruangan->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus Ruangan ini?')"><i
                                                class="bi bi-trash3 text-white" title="Hapus Ruangan"></i></button>
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
