{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Status Perbaikan</h2>
        <form action="{{ route('status_perbaikans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="no_tiket_perbaikan">No Tiket Perbaikan</label>
                <input type="text" class="form-control" id="no_tiket_perbaikan" name="no_tiket_perbaikan" required>
            </div>
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
            </div>
            <div class="form-group">
                <label for="kondisi">Kondisi</label>
                <select class="form-control" id="kondisi" name="kondisi" required>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Butuh Perbaikan">Butuh Perbaikan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('status_perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Status Perbaikan</h2>
        <form action="{{ route('status_perbaikans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="no_tiket_perbaikan">No Tiket Perbaikan</label>
                <select class="form-control" id="no_tiket_perbaikan" name="no_tiket_perbaikan" required>
                    <option value="">Pilih No Tiket Perbaikan</option>
                    @foreach ($perbaikans as $perbaikan)
                        <option value="{{ $perbaikan->no_tiket_perbaikan }}">{{ $perbaikan->no_tiket_perbaikan }} -
                            {{ $perbaikan->barang->kode_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
            </div>
            <div class="form-group">
                <label for="status">Status Perbaikan</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Dalam Proses">Dalam Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('status_perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
