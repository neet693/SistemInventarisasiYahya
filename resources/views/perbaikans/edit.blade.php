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
                    @foreach ($penempatans as $penempatan)
                        <option value="{{ $penempatan->kode_ruangan }}" @if ($perbaikan->kode_ruangan === $penempatan->ruangan->kode_ruangan) selected @endif>
                            {{ $penempatan->ruangan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="barang_id">Barang:</label>
                <select class="form-control" id="barang_id" name="barang_id" required>
                    @foreach ($penempatans as $penempatan)
                        <option value="{{ $penempatan->barang->kode_barang }}" disabled
                            @if ($perbaikan->barang_id === $penempatan->barang_id) selected @endif>
                            {{ $penempatan->barang->nama }} - Jumlah: {{ $penempatan->jumlah_ditempatkan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status Urgensi</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Urgent" style="color: red" {{ $perbaikan->status == 'Urgent' ? 'selected' : '' }}>Urgent
                    </option>
                    <option value="Quite Urgent" style="color: yellow"
                        {{ $perbaikan->status == 'Quite Urgent' ? 'selected' : '' }}>Quite Urgent</option>
                    <option value="Not Urgent" style="color: orange"
                        {{ $perbaikan->status == 'Not Urgent' ? 'selected' : '' }}>
                        Not Urgent</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tanggal_kerusakan">Tanggal Kerusakan</label>
                <input type="date" class="form-control" id="tanggal_kerusakan" name="tanggal_kerusakan"
                    value="{{ $perbaikan->tanggal_kerusakan }}" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" required>{{ $perbaikan->keterangan }}</textarea>
            </div>
            <div class="form-group">
                <label for="penanggung_jawab">Penanggung Jawab</label>
                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                    value="{{ $perbaikan->penanggung_jawab }}" required>
            </div>
            {{-- <div class="form-group">
                <label for="status">Status</label>
                <input type="checkbox" class="form-control" id="is_selesai" name="is_selesai"
                    {{ $perbaikan->is_selesai ? 'checked' : '' }}>
            </div> --}}
            <div class="form-group">
                <label for="jumlah_perbaikan">Jumlah Barang yang Diperbaiki</label>
                <input type="number" class="form-control" id="jumlah_perbaikan" name="jumlah_perbaikan"
                    value="{{ $perbaikan->jumlah_perbaikan }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
