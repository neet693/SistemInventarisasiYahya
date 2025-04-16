@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Form Peminjaman Barang</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('peminjamans.store') }}" method="POST">
            @csrf

            <!-- Unit -->
            <div class="mb-3">
                <label for="unit_id" class="form-label">Unit</label>
                <select id="unit_id" name="unit_id" class="form-control" required>
                    <option value="">Pilih Unit</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Barang -->
            <div class="mb-3">
                <label for="barang_id" class="form-label">Barang</label>
                <select id="select-barang" name="barang_id" placeholder="Pilih Barang" autocomplete="off" required>
                    <option value="">Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }} - {{ $barang->kode_barang }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Peminjam -->
            <div class="mb-3">
                <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" required>
            </div>

            <!-- Nama Asesor -->
            <div class="mb-3">
                <label for="nama_asesor" class="form-label">Nama Asesor</label>
                <input type="text" class="form-control" id="nama_asesor" name="nama_asesor" required>
            </div>

            {{-- <!-- Nama Penerima -->
            <div class="mb-3">
                <label for="nama_penerima" class="form-label">Nama Penerima (optional)</label>
                <input type="text" class="form-control" id="nama_penerima" name="nama_penerima">
            </div> --}}

            <!-- Tanggal dan Waktu Pinjam -->
            <div class="mb-3">
                <label for="tanggal_pinjam" class="form-label">Tanggal dan Waktu Pinjam</label>
                <input type="datetime-local" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
            </div>

            {{-- <!-- Tanggal dan Waktu Kembali -->
            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal dan Waktu Kembali</label>
                <input type="datetime-local" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
            </div> --}}


            <!-- Catatan -->
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Pinjam Barang</button>
        </form>
    </div>
    <script>
        new TomSelect("#select-barang", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>
@endsection
