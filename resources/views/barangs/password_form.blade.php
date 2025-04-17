<!-- resources/views/barangs/password_form.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Masukkan Password untuk Melihat Detail Barang</h3>

        <!-- Form untuk memasukkan password -->
        <form method="POST" action="{{ route('barangs.show', $kode_barang) }}">
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Masukkan Password</button>
        </form>
    </div>
@endsection
