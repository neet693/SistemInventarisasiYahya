@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Unit</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>{{ $unit->nama }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('units.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
