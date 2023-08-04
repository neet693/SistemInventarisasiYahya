@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Level</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>{{ $level->nama }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('levels.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
