@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Level</h2>
        <a href="{{ route('levels.create') }}" class="btn btn-primary mb-2">Tambah Level</a>
        <table class="table table-striped">
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
                            <a href="{{ route('levels.show', $level->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('levels.edit', $level->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('levels.destroy', $level->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus level ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
