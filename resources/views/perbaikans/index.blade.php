@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Perbaikan</h2>
        <a href="{{ route('perbaikans.create') }}" class="btn btn-primary mb-2">Tambah Perbaikan</a>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No Tiket Perbaikan</th>
                    <th>Nama Ruangan</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Kerusakan</th>
                    <th>Status Urgensi</th>
                    <th>Keterangan</th>
                    <th>Penanggung Jawab</th>
                    <th>Jumlah</th>
                    <th>Status Perbaikan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perbaikans as $perbaikan)
                    <tr>
                        <td>{{ $perbaikan->no_tiket_perbaikan }}</td>
                        <td>{{ $perbaikan->ruangan->nama }}</td>
                        <td>{{ $perbaikan->barang->nama }}</td>
                        <td>{{ $perbaikan->tanggal_kerusakan->format('d M Y') }}</td>
                        <td>
                            @if ($perbaikan->status == 'Urgent')
                                <span class="badge rounded-pill text-bg-danger">
                                    {{ $perbaikan->status }}
                                </span>
                            @elseif($perbaikan->status == 'Quite Urgent')
                                <span class="badge rounded-pill text-bg-warning">
                                    {{ $perbaikan->status }}
                                </span>
                            @else
                                <span class="badge rounded-pill text-bg-primary">
                                    {{ $perbaikan->status }}
                                </span>
                            @endif
                        </td>
                        <td>{{ $perbaikan->keterangan }}</td>
                        <td>{{ $perbaikan->penanggung_jawab }}</td>
                        <td>{{ $perbaikan->jumlah_perbaikan }}</td>
                        <td>{{ $perbaikan->is_selesai ? 'Selesai' : 'Belum Selesai' }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-gear-fill text-white"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('perbaikans.show', $perbaikan->id) }}"><i
                                            class="bi bi-eye text-white"title="Lihat Barang"></i></a>
                                    <a class="btn btn-warning btn-sm"
                                        href="{{ route('perbaikans.edit', $perbaikan->id) }}"><i
                                            class="bi bi-pencil-square text-white" title="Edit Barang"></i></a>

                                    <form action="{{ route('perbaikans.destroy', $perbaikan->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data pernaikan ini?')"><i
                                                class="bi bi-trash3 text-white" title="Hapus Barang"></i></button>
                                    </form>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
