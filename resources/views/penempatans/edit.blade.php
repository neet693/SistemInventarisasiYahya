@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Penempatan Barang</div>

                    <div class="card-body">
                        <form action="{{ route('penempatans.update', $penempatan->kode_ruangan) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="jenis_ruangan_id"> Jenis Ruangan</label>
                                <select name="jenis_ruangan_id" id="jenis_ruangan_id" class="form-control" required>
                                    <option value="">Pilih Ruangan</option>
                                    @foreach ($jenisRuangans as $jenisRuangan)
                                        <option value="{{ $jenisRuangan->id }}"
                                            {{ $jenisRuangan->id == $jenisRuangan->id ? 'selected' : '' }}>
                                            {{ $jenisRuangan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="barang_id">Barang</label>
                                <select name="barang_id" id="barang_id" class="form-control" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}"
                                            {{ $penempatan->barang_id == $barang->id ? 'selected' : '' }}>
                                            {{ $barang->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ruangan_id">Ruangan</label>
                                <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                                    <option value="">Pilih Ruangan</option>
                                    @foreach ($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}"
                                            {{ $penempatan->ruangan_id == $ruangan->id ? 'selected' : '' }}>
                                            {{ $ruangan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jumlah_ditempatkan">Jumlah Barang</label>
                                <input type="number" name="jumlah_ditempatkan" id="jumlah_ditempatkan" class="form-control"
                                    value="{{ $penempatan->jumlah_ditempatkan }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
