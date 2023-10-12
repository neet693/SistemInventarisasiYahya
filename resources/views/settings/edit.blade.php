@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit User</h2>
        <form action="{{ route('settings.update', ['user' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                    required>
            </div>
            <div class="form-group">
                <label for="unit_id">Unit</label>
                <select class="form-control" id="unit_id" name="unit_id" required>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="level_id">Level</label>
                <select class="form-control" id="level_id" name="level_id" required>
                    @foreach ($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('settings.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
