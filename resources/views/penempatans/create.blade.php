@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Penempatan Barang</h2>
        <form action="{{ route('penempatans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode_ruangan">Ruangan</label>
                <select class="form-control" id="kode_ruangan" name="kode_ruangan" required>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->kode_ruangan }}">{{ $ruangan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jenis_ruangan_id">Jenis Ruangan</label>
                <select class="form-control" id="jenis_ruangan_id" name="jenis_ruangan_id" required>
                    @foreach ($jenisRuangans as $jenisRuangan)
                        <option value="{{ $jenisRuangan->id }}">{{ $jenisRuangan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="barang_id">Inventaris Barang</label>
                <select class="form-control" id="barang_id" name="barang_id">
                    <option value="" selected disabled>Pilih Inventaris Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }} - Jumlah: {{ $barang->jumlah }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah Barang yang Ditempatkan</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahInput = document.getElementById('jumlah');
            const inventarisSelect = document.getElementById('inventaris_id');

            // Fungsi untuk mengupdate nilai jumlah barang yang tersedia berdasarkan pilihan inventaris barang
            function updateJumlahTersedia() {
                const selectedInventarisId = inventarisSelect.value;
                const selectedInventaris = @json($barangs->keyBy('id')->toArray())[selectedInventarisId];

                if (selectedInventaris) {
                    const jumlahTersedia = selectedInventaris.jumlah - jumlahInput.value;
                    const jumlahTersediaElement = document.getElementById('jumlah_tersedia');

                    if (jumlahTersedia >= 0) {
                        jumlahTersediaElement.textContent = jumlahTersedia;
                    } else {
                        jumlahTersediaElement.textContent = 'Jumlah barang yang tersedia kurang';
                    }
                }
            }

            inventarisSelect.addEventListener('change', updateJumlahTersedia);
            jumlahInput.addEventListener('input', updateJumlahTersedia);
            updateJumlahTersedia();
        });
    </script>
@endsection
