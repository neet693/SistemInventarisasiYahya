<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Dashboard</h2>

        <div class="row mt-4">
            <div class="col-auto">
                <div class="card">
                    <div class="card-body" title="Total Barang">
                        <h5 class="card-title"><i class="bi bi-boxes"></i> Total Barang</h5>
                        <p class="card-text">{{ $totalTersedia }}</p>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card">
                    <div class="card-body" title="Total Barang Rusak">
                        <h5 class="card-title"><i class="bi bi-bookmark-x"></i> Barang Rusak</h5>
                        <p class="card-text">{{ $totalRusak }}</p>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card">
                    <div class="card-body" title="Barang yang harus diperbaiki">
                        <h5 class="card-title"><i class="bi bi-database-gear"></i> Maintenance</h5>
                        <p class="card-text">{{ $totalMaintenance }}</p>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card">
                    <div class="card-body" title="Total Barang yang ditempatkan">
                        <h5 class="card-title"><i class="bi bi-building-down"></i> Penempatan</h5>
                        <p class="card-text">{{ $totalPenempatan }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Data Barang</h3>
                <table id="example" class="display" style="width:100%">
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
