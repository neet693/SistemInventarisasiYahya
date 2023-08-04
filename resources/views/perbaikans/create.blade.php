@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Perbaikan</h2>
        <form action="{{ route('perbaikans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="no_tiket_perbaikan">No Tiket Perbaikan</label>
                <input type="text" class="form-control" id="no_tiket_perbaikan" name="no_tiket_perbaikan" required>
            </div>
            <div class="form-group">
                <label for="kode_ruangan">Ruangan:</label>
                <select class="form-control" id="kode_ruangan" name="kode_ruangan" required>
                    <option value="">Pilih Ruangan</option>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->kode_ruangan }}">{{ $ruangan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="barang_id">Barang:</label>
                <select class="form-control" id="barang_id" name="barang_id" required>
                    <option value="">Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }} - Jumlah: {{ $barang->jumlah }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_kerusakan">Tanggal Kerusakan</label>
                <input type="date" class="form-control" id="tanggal_kerusakan" name="tanggal_kerusakan" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
            </div>
            <div class="form-group">
                <label for="penanggung_jawab">Penanggung Jawab</label>
                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" required>
            </div>
            <div class="form-group">
                <label for="is_selesai">Status</label>
                <input type="checkbox" class="form-control" id="is_selesai" name="is_selesai">
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah Barang yang Diperbaiki</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
