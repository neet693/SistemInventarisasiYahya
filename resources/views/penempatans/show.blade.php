@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Penempatan</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>No Inventarisasi</th>
                    <td>{{ $penempatan->no_inventarisasi }}</td>
                </tr>
                <tr>
                    <th>Nama Ruangan</th>
                    <td>{{ $penempatan->nama_ruangan }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('penempatans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
