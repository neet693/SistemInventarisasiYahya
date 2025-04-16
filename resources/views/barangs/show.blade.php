@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Barang</h2>
        @can('update', $barang)
            <a class="btn btn-warning text-white" href="{{ route('barangs.edit', $barang->id) }}"><i
                    class="bi bi-pencil-square text-white" title="Edit Barang"></i> Edit barang</a>
        @endcan
        @can('destroy', $barang)
            <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger text-white"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"><i class="bi bi-trash3 text-white"
                        title="Hapus Barang"></i> Hapus Barang</button>
            </form>
        @endcan
        <a href="{{ url()->previous() ?: url('/home') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('barangs.printQr', $barang->kode_barang) }}" target="_blank" class="btn btn-primary mt-3">
            Download QR Code (PNG)
        </a>


        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Kode Barang</th>
                                <td>{{ $barang->kode_barang }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $barang->nama }}</td>
                            </tr>
                            <tr>
                                <th>Merk</th>
                                <td>{{ $barang->merk }}</td>
                            </tr>
                            <tr>
                                <th>Tipe</th>
                                <td>{{ $barang->tipe }}</td>
                            </tr>
                            <tr>
                                <th>Unit</th>
                                <td>{{ $barang->unit->nama }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Pengadaan</th>
                                <td>{{ $barang->tahun }}</td>
                            </tr>
                            <tr>
                                <th>Kondisi</th>
                                <td>
                                    <span
                                        class="badge rounded-pill {{ $barang->kondisi == 'Baik' ? 'text-bg-success' : 'text-bg-danger' }}">{{ $barang->kondisi }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Kategorial</th>
                                <td>{{ $barang->kategorial ? $barang->kategorial->nama : 'Belum diisi' }}</td>
                            </tr>
                            <tr>
                                <th>Ruangan</th>
                                <td>{{ $barang->ruangan ? $barang->ruangan->nama : 'Belum diisi' }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Pengadaan</th>
                                <td>{{ $barang->jenisPengadaan ? $barang->jenisPengadaan->nama : 'Belum diisi' }}</td>
                            </tr>
                            <tr>
                                <th>Sumber Perolehan</th>
                                <td>{{ $barang->sumber_peroleh }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Barang</th>
                                <td>{{ $barang->jumlah }}</td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td>{{ $barang->catatan ?? 'Tidak ada Catatan Khusus' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col">
                    <div class="bagian d-flex align-items-center justify-content-center flex-wrap">
                        <div class="box">
                            <div class="body-kartu">
                                <div class="imgContainer">
                                    <img src="{{ $barang->gambar_barang ? (Str::startsWith($barang->gambar_barang, 'http') ? $barang->gambar_barang : asset('storage/' . $barang->gambar_barang)) : 'default-image.png' }}"
                                        alt="{{ $barang->nama }}">
                                </div>
                                <div class="content d-flex flex-column align-items-center justify-content-center">
                                    {{-- <div>
                                        <img src="{{ asset('storage/' . $barang->ruangan->gambar_ruangan) }}"
                                            alt="" style="width: 100%">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <h2>QR Code Barang</h2>
                        <div>{!! $qrCode !!}</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @can('view', $barang) --: --}}
    @endsection
