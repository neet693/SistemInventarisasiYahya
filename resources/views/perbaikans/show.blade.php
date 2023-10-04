@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Perbaikan</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>No Tiket Perbaikan</th>
                    <td>{{ $perbaikan->no_tiket_perbaikan }}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <td>{{ $perbaikan->barang->nama }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kerusakan</th>
                    <td>{{ $perbaikan->tanggal_kerusakan->format('D, d M Y') }}</td>
                </tr>
                <tr>
                    <th>Status Urgensi</th>
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
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $perbaikan->keterangan }}</td>
                </tr>
                <tr>
                    <th>Penanggung Jawab</th>
                    <td>{{ $perbaikan->penanggung_jawab }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $perbaikan->is_selesai ? 'Selesai' : 'Belum Selesai' }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
