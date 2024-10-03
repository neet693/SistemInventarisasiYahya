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
                <textarea class="form-control" id="tipe" name="tipe" rows="4" required>{{ $barang->tipe }}</textarea>
            </div>
            <div class="form-group">
                <label for="unit_id">Unit</label>
                <select class="form-control" id="unit_id" name="unit_id" required>
                    @foreach ($units as $unit)
                        @if (auth()->user()->isSarpras() && auth()->user()->unit_id == $unit->id)
                            <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                        @endif
                        @if (auth()->user()->isAdmin())
                            <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                        @endif
                    @endforeach
                </select>
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
                <label for="ruangan_id">Ruangan</label>
                <select class="form-control" id="ruangan_id" name="ruangan_id" required>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}" {{ $barang->ruangan_id == $ruangan->id ? 'selected' : '' }}>
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
            @if ($barang->gambar_barang)
                <div class="form-group">
                    <label for="current_image">Gambar Saat Ini</label>
                    <br>
                    <img src="{{ $barang->gambar_barang ? (Str::startsWith($barang->gambar_barang, 'http') ? $barang->gambar_barang : asset('storage/' . $barang->gambar_barang)) : 'default-image.png' }}"
                        alt="{{ $barang->nama }}" style="max-height: 200px; max-width: 200px;">
                    <br><br>
                    <small>Jika Anda ingin mengubah gambar, silakan unggah gambar baru.</small>
                </div>
            @endif

            <div class="mb-3">
                <label for="gambar_barang" class="form-label">Gambar Barang</label>
                <input class="form-control" type="file" id="gambar_barang" name="gambar_barang"
                    value="{{ $barang->gambar_barang }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
