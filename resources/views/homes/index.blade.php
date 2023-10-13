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
            <div class="col-auto">
                <div class="card">
                    <div class="card-body" title="Total Barang">
                        <a href="{{ route('barangs.index') }}" style="text-decoration:none">
                            <h5 class="card-title"><i class="bi bi-boxes"></i> Total Barang</h5>
                            <p class="card-text">{{ $TotalBarang }}</p>
                            {{-- <p class="card-text">{{ $AvailableBarang }}</p> --}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card">
                    <div class="card-body" title="Total Barang Rusak">
                        <a href="{{ route('perbaikans.index') }}" style="text-decoration: none">
                            <h5 class="card-title" style="color: #D83F31"><i class="bi bi-bookmark-x"></i> Barang Rusak</h5>
                            <p class="card-text"style="color: #D83F31">{{ $totalRusak }}</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card">
                    <div class="card-body" title="Jumlah tiket perbaikan">
                        <a href="{{ route('status_perbaikans.index') }}" style="text-decoration: none">
                            <h5 class="card-title"style="color: #EE9322"><i class="bi bi-database-gear"></i> Tiket Perbaikan
                            </h5>
                            <p class="card-text"style="color: #EE9322">{{ $JumlahTiketPerbaikan }}</p>
                        </a>
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
                                <td><a href="{{ route('barangs.show', $barang->id) }}"
                                        style="text-decoration: none; color: black;">{{ $barang->nama }}</a></td>
                                {{-- <td>{{ $barang->nama }}</td> --}}
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
