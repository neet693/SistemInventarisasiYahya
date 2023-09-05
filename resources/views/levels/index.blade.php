@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Level</h2>
        <a href="{{ route('levels.create') }}" class="btn btn-primary mb-2">Tambah Level</a>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($levels as $level)
                    <tr>
                        <td>{{ $level->nama }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-gear-fill text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <a class="btn btn-primary btn-sm" href="{{ route('levels.show', $level->id) }}"><i
                                            class="bi bi-eye text-white"title="Lihat Barang"></i></a>
                                    <a class="btn btn-warning btn-sm" href="{{ route('levels.edit', $level->id) }}"><i
                                            class="bi bi-pencil-square text-white" title="Edit Barang"></i></a>

                                    <form action="{{ route('levels.destroy', $level->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus level ini?')"><i
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
