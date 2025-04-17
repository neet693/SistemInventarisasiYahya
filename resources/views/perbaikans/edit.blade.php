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
                <label for="ruangan_id">Ruangan:</label>
                <select class="form-control" id="ruangan_id" name="ruangan_id" required>
                    <option value="">Pilih Ruangan</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->ruangan->id }}" @if ($perbaikan->barang_id === $barang->id) selected @endif>
                            {{ $barang->ruangan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="barang_id">Barang:</label>
                <select class="form-control" id="barang_id" name="barang_id" required>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->kode_barang }}" disabled
                            @if ($perbaikan->barang_id === $barang->id) selected @endif>
                            {{ $barang->nama }}</option>
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
            <div class="form-group">
                <label for="status">Status</label>
                <input type="checkbox" class="form-control" id="is_selesai" name="is_selesai"
                    {{ $perbaikan->is_selesai ? 'checked' : '' }}>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
