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
                <input type="text" class="form-control" id="no_tiket_perbaikan" name="no_tiket_perbaikan" required>
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

            <div class="form-group">
                <label for="barang_id">Barang:</label>
                <select id="select-barang" name="barang_id" placeholder="Pilih Barang" autocomplete="off">
                    <option value="">Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }} - {{ $barang->kode_barang }}
                        </option>
                    @endforeach
                </select>
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
            {{-- <div class="form-group">
                <label for="penanggung_jawab">Penanggung Jawab</label>
                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" required>
            </div> --}}
            <div class="form-group">
                <label for="penanggung_jawab_id">Penanggung Jawab</label>
                <select class="form-control" id="penanggung_jawab" name="penanggung_jawab_id" required>
                    <option value="">Pilih Penanggung Jawab</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="jumlah_perbaikan">Jumlah Barang yang Diperbaiki</label>
                <input type="number" class="form-control" id="jumlah_perbaikan" name="jumlah_perbaikan" min="1"
                    required>
                @error('jumlah_perbaikan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> --}}
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('perbaikans.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        var barangSelect = new TomSelect("#select-barang", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        var ruanganSelect = new TomSelect("#select-ruangan", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            },
            onChange: function(value) {
                var ruanganId = value;
                if (ruanganId) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('barang.by.ruangan', ['ruangan_id' => ':ruanganId']) }}'
                            .replace(':ruanganId', ruanganId),
                        data: {
                            ruangan_id: ruanganId
                        },
                        success: function(data) {
                            barangSelect.clearOptions();
                            $.each(data, function(index, barang) {
                                barangSelect.addOption({
                                    value: barang.id,
                                    text: barang.nama + ' - Kode Barang: ' + barang
                                        .kode_barang
                                });
                            });
                            barangSelect
                                .refreshOptions(); // Refresh the options to update the dropdown
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error: " + status + " - " + error);
                        }
                    });
                } else {
                    barangSelect.clearOptions();
                }
            }
        });
    </script>

@endsection
