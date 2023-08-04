@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Perbaikan</h2>
        <a href="{{ route('perbaikans.create') }}" class="btn btn-primary mb-2">Tambah Perbaikan</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No Tiket Perbaikan</th>
                    <th>Kode Ruangan</th>
                    <th>Kode Barang</th>
                    <th>Tanggal Kerusakan</th>
                    <th>Keterangan</th>
                    <th>Penanggung Jawab</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perbaikans as $perbaikan)
                    <tr>
                        <td>{{ $perbaikan->no_tiket_perbaikan }}</td>
                        <td>{{ $perbaikan->ruangan->kode_ruangan }}</td>
                        <td>{{ $perbaikan->barang->kode_barang }}</td>
                        <td>{{ $perbaikan->tanggal_kerusakan }}</td>
                        <td>{{ $perbaikan->keterangan }}</td>
                        <td>{{ $perbaikan->penanggung_jawab }}</td>
                        <td>{{ $perbaikan->jumlah }}</td>
                        <td>{{ $perbaikan->is_selesai ? 'Selesai' : 'Belum Selesai' }}</td>
                        <td>
                            <a href="{{ route('perbaikans.show', $perbaikan->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('perbaikans.edit', $perbaikan->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('perbaikans.destroy', $perbaikan->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus perbaikan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
