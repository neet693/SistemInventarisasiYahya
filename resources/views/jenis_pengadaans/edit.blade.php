@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Jenis Pengadaan</h2>
        <form action="{{ route('jenis_pengadaans.update', $jenisPengadaan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $jenisPengadaan->nama }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('jenis_pengadaans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
