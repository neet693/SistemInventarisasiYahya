@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Jenis Ruangan</h2>
        <form action="{{ route('jenis_ruangans.update', $jenisRuangan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $jenisRuangan->nama }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('jenis_ruangans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
