<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Dashboard</h2>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Total Barang</h5>
                        <p class="card-text">{{ $jumlahTotalBarang }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Barang Rusak</h5>
                        <p class="card-text">{{ $jumlahBarangRusak }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">History Barang yang dipebaiki</h5>
                        <p class="card-text">{{ $jumlahBarangPerbaikan }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Data Barang</h3>
                {{-- Form Filter --}}
                <form class="d-inline-block" role="search" action="{{ route('filter-barang') }}" method="POST">
                    @csrf
                    <input class="form-control me-2" type="text" name="keyword" placeholder="Cari berdasarkan nama">
                    <button class="btn btn-outline-success d-lg-inline-flex" type="submit">Cari</button>
                </form>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Merk Barang</th>
                            <th>Sumber Perolehan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $barang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $barang->nama }}</td>
                                <td>{{ $barang->merk }}</td>
                                <td>{{ $barang->sumber_peroleh }}</td>
                                <td>{{ $barang->jumlah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
