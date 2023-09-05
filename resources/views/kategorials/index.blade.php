@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Kategorial</h2>
        <a href="{{ route('kategorials.create') }}" class="btn btn-primary mb-2">Tambah Kategorial</a>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategorials as $kategorial)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- <td>{{ $kategorial->id }}</td> --}}
                        <td>{{ $kategorial->nama }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-gear-fill text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('kategorials.show', $kategorial->id) }}"><i
                                            class="bi bi-eye text-white"title="Lihat Barang"></i></a>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('kategorials.edit', $kategorial->id) }}"><i
                                            class="bi bi-pencil-square text-white" title="Edit Barang"></i></a>

                                    <form action="{{ route('kategorials.destroy', $kategorial->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategorial ini?')"><i
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
