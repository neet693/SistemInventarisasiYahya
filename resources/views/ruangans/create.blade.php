@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Ruangan</h2>
        <form action="{{ route('ruangans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode_ruangan">Kode Ruangan</label>
                <input type="text" class="form-control" id="kode_ruangan" name="kode_ruangan" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama Ruangan</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="jenis_ruangan_id">Jenis Ruangan</label>
                <select class="form-control" id="jenis_ruangan_id" name="jenis_ruangan_id" required>
                    <option value="">Pilih Jenis Ruangan</option>
                    @foreach ($jenisRuangans as $jenisRuangan)
                        <option value="{{ $jenisRuangan->id }}">{{ $jenisRuangan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('ruangans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
