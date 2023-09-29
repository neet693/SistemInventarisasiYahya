@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Barang</h2>
        <form action="{{ route('barangs.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ $barang->kode_barang }}"
                    required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $barang->nama }}"
                    required>
            </div>
            <div class="form-group">
                <label for="merk">Merk</label>
                <input type="text" class="form-control" id="merk" name="merk" value="{{ $barang->merk }}"
                    required>
            </div>
            <div class="form-group">
                <label for="tipe">Tipe</label>
                <textarea class="form-control" id="tipe" name="tipe" rows="4" required>{{ $barang->spesifikasi }}</textarea>
            </div>
            <div class="form-group">
                <label for="tahun">Tahun Pengadaan</label>
                <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $barang->tahun }}"
                    min="1900" max="2099" required>
            </div>
            <div class="form-group">
                <label for="kondisi">Kondisi</label>
                <select class="form-control" id="kondisi" name="kondisi" required>
                    <option value="Baik" {{ $barang->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak" {{ $barang->kondisi == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    <option value="Butuh Perbaikan" {{ $barang->kondisi == 'Butuh Perbaikan' ? 'selected' : '' }}>Butuh
                        Perbaikan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kategorial_id">Kategorial</label>
                <select class="form-control" id="kategorial_id" name="kategorial_id" required>
                    @foreach ($kategorials as $kategorial)
                        <option value="{{ $kategorial->id }}"
                            {{ $barang->kategorial_id == $kategorial->id ? 'selected' : '' }}>
                            {{ $kategorial->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kode_ruangan">Ruangan</label>
                <select class="form-control" id="kode_ruangan" name="kode_ruangan" required>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->kode_ruangan }}"
                            {{ $barang->kode_ruangan == $ruangan->kode_ruangan ? 'selected' : '' }}>
                            {{ $ruangan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_pengadaan_id">Jenis Pengadaan</label>
                <select class="form-control" id="jenis_pengadaan_id" name="jenis_pengadaan_id" required>
                    @foreach ($jenis_pengadaans as $jenis_pengadaan)
                        <option value="{{ $jenis_pengadaan->id }}"
                            {{ $barang->jenis_pengadaan_id == $jenis_pengadaan->id ? 'selected' : '' }}>
                            {{ $jenis_pengadaan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">jumlah</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" value="{{ $barang->jumlah }}"
                    required>
            </div>
            <div class="form-group">
                <label for="sumber_peroleh">Sumber Dana</label>
                <input type="text" class="form-control" id="sumber_peroleh" name="sumber_peroleh"
                    value="{{ $barang->sumber_peroleh }}" required>
            </div>
            @if ($barang->kondisi !== 'Baik')
                <div class="form-group" id="catatan-group">
                    <label for="catatan">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan">{{ $barang->catatan }}</textarea>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
