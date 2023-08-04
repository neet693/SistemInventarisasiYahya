@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Jenis Pengadaan</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>{{ $jenisPengadaan->nama }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('jenis_pengadaans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
