@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Level</h2>
        <form action="{{ route('levels.update', $level->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $level->nama }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('levels.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
