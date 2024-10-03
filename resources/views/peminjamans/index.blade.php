@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Peminjaman</h2>
        <a href="{{ route('peminjamans.create') }}" class="btn btn-primary mb-2">Tambah Peminjaman</a>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Status Peminjaman</th>
                    <th>Jumlah</th>
                    <th>Tanggal Kembali</th>
                    <th>Penerima</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $key => $peminjaman)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $peminjaman->nama_peminjam }}</td>
                        {{-- <td>{{ $peminjaman->no_tiket_peminjaman }}</td> --}}
                        <td>{{ $peminjaman->barang->nama }}</td>
                        <td>{{ $peminjaman->tanggal_pinjam->format('d F Y H:i') }}</td>
                        <td>{{ $peminjaman->status_peminjaman }}</td>
                        <td>{{ $peminjaman->jumlah }}</td>
                        <td>{{ $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('d F Y H:i') : 'Belum Kembali' }}
                        <td>{{ $peminjaman->penerima ? $peminjaman->penerima->nama : 'Belum Kembali' }}</td>
                        </td>
                        @if (auth()->check())
                            <td>
                                @if ($peminjaman->status_peminjaman === 'Dipinjamkan')
                                    <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <!-- Isi formulir -->
                                        <button type="submit" class="btn btn-primary">Kembalikan</button>
                                    </form>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
