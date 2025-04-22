@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Perbaikan</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('perbaikans.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="no_tiket_perbaikan">No Tiket Perbaikan</label>
                <input type="hidden" class="form-control" id="no_tiket_perbaikan" name="no_tiket_perbaikan" required
                    placeholder="Jika Banyak Barang Tulis Kode saja Misal P atau TRP">
            </div>
            <div class="form-group">
                <label for="unit_id">Pilih Unit:</label>
                <select name="unit_id" id="unit_id" class="form-control" required>
                    <option value="">Pilih Unit</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="ruangan_id">Ruangan:</label>
                <select id="select-ruangan" name="ruangan_id" placeholder="Pilih Ruangan" autocomplete="on">
                    <option value="">Pilih Ruangan</option>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="select-barang">Barang</label>
                <select id="select-barang" name="barang_id[]" class="form-control" multiple required></select>
            </div>

            <div class="form-group">
                <label for="tanggal_kerusakan">Tanggal Kerusakan</label>
                <input type="date" class="form-control" id="tanggal_kerusakan" name="tanggal_kerusakan" required>
            </div>
            <div class="form-group">
                <label for="status">Status Urgensi</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Urgent" style="color: red">Urgent - Segera</option>
                    <option value="Quite Urgent" style="color: yellow">Quite Urgent - Seminggu</option>
                    <option value="Not Urgent" style="color: orange">Not Urgent</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
            </div>

            <div class="form-group">
                <label for="penanggung_jawab_id">Penanggung Jawab</label>
                <select class="form-control" id="penanggung_jawab" name="penanggung_jawab_id" required>
                    <option value="">Pilih Penanggung Jawab</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        // Inisialisasi TomSelect untuk Barang
        var barangSelect = new TomSelect("#select-barang", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        // Inisialisasi TomSelect untuk Ruangan
        var ruanganSelect = new TomSelect("#select-ruangan", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            },
            onChange: function(value) {
                var ruanganId = value;

                // Clear barang setiap kali ruangan ganti
                barangSelect.clearOptions();

                if (ruanganId) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('barang.by.ruangan', ['ruangan_id' => ':ruanganId']) }}'
                            .replace(':ruanganId', ruanganId),
                        success: function(data) {
                            $.each(data, function(index, barang) {
                                barangSelect.addOption({
                                    value: barang.id,
                                    text: barang.nama + ' - Kode Barang: ' + barang
                                        .kode_barang
                                });
                            });
                            barangSelect.refreshOptions();
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error Barang: " + status + " - " + error);
                        }
                    });
                }
            }
        });

        // Event ketika Unit dipilih
        $('#unit_id').on('change', function() {
            var unitId = $(this).val();

            // Kosongkan ruangan dan barang
            ruanganSelect.clearOptions();
            barangSelect.clearOptions();

            if (unitId) {
                $.ajax({
                    url: '{{ route('ruangan.by.unit', ':unit_id') }}'.replace(':unit_id', unitId),
                    type: 'GET',
                    success: function(data) {
                        data.forEach(function(ruangan) {
                            ruanganSelect.addOption({
                                value: ruangan.id,
                                text: ruangan.nama
                            });
                        });
                        ruanganSelect.refreshOptions();
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error Ruangan: " + status + " - " + error);
                    }
                });
            }
        });
    </script>

@endsection
