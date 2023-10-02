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
                    <th>No Tiket Inventarisasi</th>
                    <td>{{ $perbaikan->no_tiket_inventarisasi }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kerusakan</th>
                    <td>{{ $perbaikan->tanggal_kerusakan }}</td>
                </tr>
                <tr>
                    <th>Status Urgensi</th>
                    <td>
                        @if ($perbaikan->status == 'Urgent')
                            <span class="badge rounded-pill text-danger">
                                {{ $perbaikan->status }}
                            </span>
                        @elseif($perbaikan->status == 'Quite Urgent')
                            <span class="badge rounded-pill text-warning">
                                {{ $perbaikan->status }}
                            </span>
                        @else
                            <span class="badge rounded-pill text-primary">
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
                    <td>{{ $perbaikan->status }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
