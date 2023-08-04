@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Status Perbaikan</h2>
        <table class="table">
            <tr>
                <th>No Tiket Perbaikan</th>
                <td>{{ $statusPerbaikan->no_tiket_perbaikan }}</td>
            </tr>
            <tr>
                <th>Tanggal Selesai</th>
                <td>{{ $statusPerbaikan->tanggal_selesai }}</td>
            </tr>
            <tr>
                <th>Kondisi</th>
                <td>{{ $statusPerbaikan->kondisi }}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>{{ $statusPerbaikan->keterangan }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $statusPerbaikan->created_at }}</td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{ $statusPerbaikan->updated_at }}</td>
            </tr>
        </table>
        <a href="{{ route('status_perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
