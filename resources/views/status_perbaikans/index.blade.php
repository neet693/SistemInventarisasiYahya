@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Status Perbaikan</h2>
        <a href="{{ route('status_perbaikans.create') }}" class="btn btn-primary mb-2">Tambah Status Perbaikan</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No Tiket Perbaikan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Selesai</th>
                    <th>Kondisi</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statusPerbaikans as $statusPerbaikan)
                    <tr>
                        <td>{{ $statusPerbaikan->no_tiket_perbaikan }}</td>
                        <td>{{ $statusPerbaikan->perbaikan->jumlah }}</td>
                        <td>{{ $statusPerbaikan->tanggal_selesai }}</td>
                        <td>{{ $statusPerbaikan->kondisi }}</td>
                        <td>{{ $statusPerbaikan->keterangan }}</td>
                        <td>
                            <a href="{{ route('status_perbaikans.show', $statusPerbaikan->no_tiket_perbaikan) }}"
                                class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('status_perbaikans.edit', $statusPerbaikan->no_tiket_perbaikan) }}"
                                class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('status_perbaikans.destroy', $statusPerbaikan->no_tiket_perbaikan) }}"
                                method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus status perbaikan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
