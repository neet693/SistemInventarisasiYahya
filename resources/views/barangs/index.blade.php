@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Barang</h2>
        @if (auth()->user()->isAdmin() || auth()->user()->isSarpras())
            @include('components.barang-index-button')
            <a href="{{ route('barangs.downloadQR') }}" class="btn btn-warning mb-2 text-white"><i
                    class="bi bi-cloud-download-fill"></i>
                Download QR Barang
            </a>
        @else
            <a href="{{ route('export-barang') }}" class="btn btn-warning mb-2 text-white"><i
                    class="bi bi-cloud-download-fill"></i>
                Export Barang
            </a>
        @endif
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Kondisi</th>
                    <th>Ruangan</th>
                    {{-- <th>Jumlah</th> --}}
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    {{-- <tr data-href="{{ route('barangs.show', $barang->id) }}"> --}}
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('barangs.show', $barang->kode_barang) }}">{{ $barang->nama }}</a></td>
                        <td>{{ $barang->merk }}</td>
                        <td>{{ $barang->tipe }}</td>
                        <td>{{ $barang->kondisi }}</td>
                        {{-- <td>{{ $barang->kategorial ? $barang->kategorial->nama : 'Belum diisi' }}</td> --}}
                        <td>{{ $barang->ruangan ? $barang->ruangan->nama : 'Belum diisi' }}</td>
                        {{-- <td>{{ $barang->jenisPengadaan ? $barang->jenisPengadaan->nama : 'Belum diisi' }}</td> --}}
                        {{-- <td>{{ $barang->jumlah }}</td> --}}
                        <td>{{ $barang->catatan ?? 'Tidak ada catatan khusus' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('script-table')
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "rowCallback": function(row, data) {
                    var id = data[
                        0]; // Asumsikan ID ada di kolom pertama, sesuaikan dengan struktur data Anda
                    var url = "/barangs/" + id; // Format URL
                    $(row).attr("data-href", url);
                }
            });

            $('#example tbody').on('click', 'tr', function() {
                var id = $(this).data('href'); // Ambil nilai 'id' dari atribut 'data-href'
                var kode_barang = $(this).data(
                    'kode_barang'); // Ambil nilai 'kode_barang' dari atribut 'data-kode-barang'

                if (id) {
                    window.location.href = id; // Arahkan ke rute dengan 'id' saja
                }
            });
        });
    </script>
@endpush
