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
                <label for="unit_id" class="form-label">Unit Peminjam</label>
                <select id="unit_id" name="unit_id" class="form-control" required>
                    <option value="">Pilih Unit</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Barang -->
            <div class="mb-3">
                <label for="select-barang" class="form-label">Barang</label>
                <select id="select-barang" name="barang_id[]" multiple placeholder="Pilih Barang" autocomplete="off"
                    required>
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

            <!-- Tanggal dan Waktu Pinjam -->
            <div class="mb-3">
                <label for="tanggal_pinjam" class="form-label">Tanggal dan Waktu Pinjam</label>
                <input type="datetime-local" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
            </div>

            <!-- Catatan -->
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
            </div>


            <!-- Tombol untuk membuka modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#passwordModal">
                Pinjam Barang
            </button>

            <!-- Modal Password -->
            <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="passwordModalLabel">Masukkan Password untuk Peminjaman</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="passwordForm" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Verifikasi Password</button>
                                </div>
                                <div id="error-message" class="alert alert-danger d-none">
                                    Password yang dimasukkan salah!
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <button type="submit" class="btn btn-primary">Pinjam Barang</button> --}}

        </form>
    </div>
    <script>
        new TomSelect("#select-barang", {
            maxItems: null, // null artinya tidak dibatasi jumlah pilihan
            plugins: ['remove_button'],
            create: false,
            persist: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Event ketika form password disubmit
            $('#passwordForm').on('submit', function(event) {
                event.preventDefault(); // Menghindari submit form yang biasa

                // Ambil password dari input
                var password = $('#password').val();

                // Kirim request ke server untuk memverifikasi password
                $.ajax({
                    url: '{{ route('peminjaman.verify-password') }}', // Route untuk verifikasi password
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        password: password
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Jika password benar, tutup modal dan lanjutkan peminjaman
                            $('#passwordModal').modal('hide');
                            $('#peminjamanForm').submit(); // Submit form peminjaman
                        } else {
                            // Jika password salah, tampilkan pesan error
                            $('#error-message').removeClass('d-none');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            });
        });
    </script>

@endsection
