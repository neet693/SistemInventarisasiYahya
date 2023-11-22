<!-- resources/views/peminjaman/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Form Peminjaman Barang</h2>
        <form action="{{ route('peminjamans.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="barang_id" class="form-label">Barang</label>
                <select class="form-select" name="barang_id" id="barang_id" required>
                    <option value="" disabled selected>Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }} - {{ $barang->jumlah }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>
            <button type="submit" class="btn btn-primary">Pinjam Barang</button>
        </form>
    </div>
@endsection
