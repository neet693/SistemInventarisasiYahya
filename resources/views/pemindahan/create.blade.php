@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Pemindahan Barang</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('pemindahan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="barang_id" class="form-label">Barang</label>
                <select id="barang_id" name="barang_id" class="form-control">
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }} - {{ $barang->kode_barang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="unit_asal_id" class="form-label">Unit Asal</label>
                <select id="unit_asal_id" name="unit_asal_id" class="form-control">
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="ruangan_asal_id" class="form-label">Ruangan Asal</label>
                <select id="ruangan_asal_id" name="ruangan_asal_id" class="form-control">
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="unit_tujuan_id" class="form-label">Unit Tujuan</label>
                <select id="unit_tujuan_id" name="unit_tujuan_id" class="form-control">
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="ruangan_tujuan_id" class="form-label">Ruangan Tujuan</label>
                <select id="ruangan_tujuan_id" name="ruangan_tujuan_id" class="form-control">
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
            </div> --}}

            <div class="mb-3">
                <label for="tanggal_pemindahan" class="form-label">Tanggal Pemindahan</label>
                <input type="datetime-local" class="form-control" id="tanggal_pemindahan" name="tanggal_pemindahan"
                    required>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Pindahkan Barang</button>
        </form>
    </div>
@endsection
