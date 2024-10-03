<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-dark" role="alert">
            Selamat Datang, {{ Auth::user()->nama }} <br>
            Anda dari unit {{ Auth::user()->unit ? Auth::user()->unit->nama : 'Admin' }} <br>
            Role anda adalah {{ Auth::user()->level->nama }} <br>
        </div>
        <h2>Dashboard</h2>

        <div class="row mt-4">
            @foreach ($units as $unit)
                <div class="col-auto">
                    <div class="card">
                        <div class="card-body" title="Barang Unit {{ $unit->nama }}">
                            <a href="{{ route('home.unit', $unit->nama) }}" style="text-decoration:none" class="random-color">
                                <h5 class="card-title random-color"><i class="bi bi-boxes"></i>
                                    Barang Unit {{ $unit->nama }}</h5>
                                <p class="card-text">{{ $unit->total_barang }}</p>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
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
                                {{-- <td><a href="{{ route('barangs.show', $barang->id) }}"
                                        style="text-decoration: none; color: black;">{{ $barang->nama }}</a></td> --}}
                                <td><a href="{{ route('barangs.show', $barang->kode_barang) }}"
                                        style="text-decoration: none; color: black;">{{ $barang->nama }}</a></td>
                                <td>{{ $barang->merk }}</td>
                                <td>{{ $barang->sumber_peroleh }}</td>
                                <td>{{ $barang->jumlah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <h3>Log Aktivitas</h3>
                <table id="activitylogs" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Action</th>
                            <th>IP Address</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->email }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->ip_address }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
