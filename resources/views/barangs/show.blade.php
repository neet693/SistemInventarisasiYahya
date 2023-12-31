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
        <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>

        {{-- <div class="bagian d-flex align-items-center justify-content-center flex-wrap">
            <div class="box">
                <div class="body-kartu">
                    <div class="imgContainer">
                        <img src="{{ asset('storage/' . $barang->gambar_barang) }}" alt="">
                    </div>
                    <div class="content d-flex flex-column align-items-center justify-content-center">
                        <div>
                            <h3 class="text-white fs-5">{{ $barang->nama }} <span
                                    class="badge rounded-pill {{ $barang->kondisi == 'Baik' ? 'text-bg-success' : 'text-bg-danger' }}">{{ $barang->kondisi }}</span>
                            </h3>
                            <h4 class="text-white fs-5">{{ $barang->kode_barang }} |
                                {{ $barang->kategorial ? $barang->kategorial->nama : 'Belum diisi' }} </h4>
                            <p class="text-white">{{ $barang->merk }} | {{ $barang->tipe }} | {{ $barang->tahun }}</p>
                            <p class="text-white">Ruangan: {{ $barang->ruangan ? $barang->ruangan->nama : 'Belum diisi' }}
                            </p>
                            <p class="text-white">Jenis Pengadaan:
                                {{ $barang->jenisPengadaan ? $barang->jenisPengadaan->nama : 'Belum diisi' }}</p>
                            <p class="text-white">Jumlah: {{ $barang->jumlah }}</p>
                            <p class="fs-6 text-white">Catatan:
                                {{ $barang->catatan ? $barang->catatan : 'Tidak ada Catatan' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        @can('view', $barang)
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
                                        <img src="{{ asset('storage/' . $barang->gambar_barang) }}" alt="">
                                    </div>
                                    <div class="content d-flex flex-column align-items-center justify-content-center">
                                        <div>
                                            <img src="{{ asset('storage/' . $barang->ruangan->gambar_ruangan) }}"
                                                alt="" style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        @endsection
