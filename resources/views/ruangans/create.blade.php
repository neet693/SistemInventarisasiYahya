@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Ruangan</h2>
        <form action="{{ route('ruangans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Ruangan</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('ruangans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
