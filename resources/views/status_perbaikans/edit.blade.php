@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Status Perbaikan</h2>
        <form action="{{ route('status_perbaikans.update', $statusPerbaikan->no_tiket_perbaikan) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="no_tiket_perbaikan">No Tiket Perbaikan</label>
                <select class="form-control" id="no_tiket_perbaikan" name="no_tiket_perbaikan" required>
                    <option value="">Pilih No Tiket Perbaikan</option>
                    @foreach ($perbaikans as $perbaikan)
                        <option value="{{ $perbaikan->no_tiket_perbaikan }}"
                            @if ($perbaikan->no_tiket_perbaikan === $statusPerbaikan->no_tiket_perbaikan) selected @endif>{{ $perbaikan->no_tiket_perbaikan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                    value="{{ $statusPerbaikan->tanggal_selesai }}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Dalam Perbaikan" @if ($statusPerbaikan->status === 'Dalam Perbaikan') selected @endif>Dalam Perbaikan
                    </option>
                    <option value="Selesai" @if ($statusPerbaikan->status === 'Selesai') selected @endif>Selesai</option>
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" required>{{ $statusPerbaikan->keterangan }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('status_perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
