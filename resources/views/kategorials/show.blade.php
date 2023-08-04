@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Kategorial</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $kategorial->id }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $kategorial->nama }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('kategorials.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
