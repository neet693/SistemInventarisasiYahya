@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Barang</h2>
        <form action="{{ route('barangs.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="merk">Merk</label>
                <input type="text" class="form-control" id="merk" name="merk" required>
            </div>
            <div class="form-group">
                <label for="spesifikasi">Spesifikasi</label>
                <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
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
                <label for="kategorial_id">Kategorial</label>
                <select class="form-control" id="kategorial_id" name="kategorial_id" required>
                    @foreach ($kategorials as $kategorial)
                        <option value="{{ $kategorial->id }}">{{ $kategorial->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kode_ruangan">Ruangan</label>
                <select class="form-control" id="kode_ruangan" name="kode_ruangan" required>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->kode_ruangan }}">{{ $ruangan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_pengadaan_id">Jenis Pengadaan</label>
                <select class="form-control" id="jenis_pengadaan_id" name="jenis_pengadaan_id" required>
                    @foreach ($jenis_pengadaans as $jenis_pengadaan)
                        <option value="{{ $jenis_pengadaan->id }}">{{ $jenis_pengadaan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah Barang</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>
            <div class="form-group">
                <label for="sumber_dana">Sumber Dana</label>
                <input type="text" class="form-control" id="sumber_dana" name="sumber_dana" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
