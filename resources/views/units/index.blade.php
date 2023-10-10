@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Unit</h2>
        <a href="{{ route('units.create') }}" class="btn btn-primary mb-2">Tambah Unit</a>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $unit)
                    <tr>
                        <td>{{ $unit->nama }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-gear-fill text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <a class="btn btn-primary btn-sm" href="{{ route('units.show', $unit->id) }}"><i
                                            class="bi bi-eye text-white"title="Lihat Unit"></i></a>
                                    <a class="btn btn-warning btn-sm" href="{{ route('units.edit', $unit->id) }}"><i
                                            class="bi bi-pencil-square text-white" title="Edit Unit"></i></a>

                                    <form action="{{ route('units.destroy', $unit->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus unit ini?')"><i
                                                class="bi bi-trash3 text-white" title="Hapus Unit"></i></button>
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
