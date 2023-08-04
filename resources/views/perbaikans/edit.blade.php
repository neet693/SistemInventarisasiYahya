@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Perbaikan</h2>
        <form action="{{ route('perbaikans.update', $perbaikan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="no_tiket_perbaikan">No Tiket Perbaikan</label>
                <input type="text" class="form-control" id="no_tiket_perbaikan" name="no_tiket_perbaikan"
                    value="{{ $perbaikan->no_tiket_perbaikan }}" required>
            </div>
            <div class="form-group">
                <label for="kode_ruangan">Ruangan:</label>
                <select class="form-control" id="kode_ruangan" name="kode_ruangan" required>
                    <option value="">Pilih Ruangan</option>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->kode_ruangan }}" @if ($perbaikan->kode_ruangan === $ruangan->kode_ruangan) selected @endif>
                            {{ $ruangan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="barang_id">Barang:</label>
                <select class="form-control" id="barang_id" name="barang_id" required>
                    <option value="">Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}" @if ($perbaikan->barang_id === $barang->id) selected @endif>
                            {{ $barang->nama }} - Jumlah: {{ $barang->jumlah }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_kerusakan">Tanggal Kerusakan</label>
                <input type="date" class="form-control" id="tanggal_kerusakan" name="tanggal_kerusakan"
                    value="{{ $perbaikan->tanggal_kerusakan }}" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" required>{{ $perbaikan->Keterangan }}</textarea>
            </div>
            <div class="form-group">
                <label for="penanggung_jawab">Penanggung Jawab</label>
                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                    value="{{ $perbaikan->penanggung_jawab }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Belum Dikerjakan" @if ($perbaikan->status === 'Belum Dikerjakan') selected @endif>Belum Dikerjakan
                    </option>
                    <option value="Sedang Dikerjakan" @if ($perbaikan->status === 'Sedang Dikerjakan') selected @endif>Sedang Dikerjakan
                    </option>
                    <option value="Selesai" @if ($perbaikan->status === 'Selesai') selected @endif>Selesai</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah Barang yang Diperbaiki</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $perbaikan->jumlah }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
