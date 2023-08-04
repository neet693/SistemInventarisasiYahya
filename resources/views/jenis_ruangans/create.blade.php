@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Jenis Ruangan</h2>
        <form action="{{ route('jenis_ruangans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('jenis_ruangans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
