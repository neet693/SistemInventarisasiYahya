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
                <label for="barang_id">Barang:</label>
                <select class="form-control" id="barang_id" name="barang_id" required>
                    <option value="">Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }} - Jumlah:
                            {{ $barang->jumlah }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="ruangan_id">Ruangan</label>
                <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                    <option value="">Pilih Ruangan</option>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_kerusakan">Tanggal Kerusakan</label>
                <input type="date" class="form-control" id="tanggal_kerusakan" name="tanggal_kerusakan" required>
            </div>
            <div class="form-group">
                <label for="status">Status Urgensi</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Urgent" style="color: red">Urgent - Segera</option>
                    <option value="Quite Urgent" style="color: yellow">Quite Urgent - Seminggu</option>
                    <option value="Not Urgent" style="color: orange">Not Urgent</option>
                </select>
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
                <label for="jumlah_perbaikan">Jumlah Barang yang Diperbaiki</label>
                <input type="number" class="form-control" id="jumlah_perbaikan" name="jumlah_perbaikan" min="1"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
