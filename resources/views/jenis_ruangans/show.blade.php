@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Jenis Ruangan</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>{{ $jenisRuangan->nama }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('jenis_ruangans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
