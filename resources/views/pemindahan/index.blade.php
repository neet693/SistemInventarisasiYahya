@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('pemindahan.create') }}" class="btn btn-warning mb-2 text-white"><i
                class="bi bi-cloud-download-fill"></i>
            Pemindahan Barang
        </a>
        <h1>Daftar Pemindahan Barang</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table id="pemindahanTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Unit Asal</th>
                    <th>Unit Tujuan</th>
                    <th>Ruangan Asal</th>
                    <th>Ruangan Tujuan</th>
                    <th>Tanggal Pemindahan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemindahans as $pemindahan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemindahan->barang->nama }}</td>
                        <td>{{ $pemindahan->unitAsal->nama }}</td>
                        <td>{{ $pemindahan->unitTujuan->nama }}</td>
                        <td>{{ $pemindahan->ruanganAsal->nama }}</td>
                        <td>{{ $pemindahan->ruanganTujuan->nama }}</td>
                        <td>{{ $pemindahan->tanggal_pemindahan->format('d F Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
