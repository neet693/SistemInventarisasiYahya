@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Ruangan</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>Kode Ruangan</th>
                    <td>{{ $ruangan->kode_ruangan }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $ruangan->nama }}</td>
                </tr>
                <tr>
                    <th>Jenis Ruangan</th>
                    <td>{{ $ruangan->jenisRuangan->nama }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('ruangans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
