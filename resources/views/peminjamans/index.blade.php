@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Peminjaman</h2>
        <a href="{{ route('peminjamans.create') }}" class="btn btn-primary mb-2">Tambah Peminjaman</a>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Informasi Peminjaman</th>
                    <th>Status</th>
                    <th>Pengembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjamans as $peminjaman)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- Kolom gabungan --}}
                        <td>
                            <strong>{{ $peminjaman->nama_peminjam }}</strong> <br>
                            <small class="text-muted">{{ $peminjaman->unit->nama }}</small><br>
                            <span class="badge bg-info">{{ $peminjaman->barang->nama }}</span><br>
                            <small class="text-muted">{{ $peminjaman->tanggal_pinjam->format('d M Y H:i') }}</small>
                        </td>

                        {{-- Status --}}
                        <td>
                            <span
                                class="badge bg-{{ $peminjaman->status_peminjaman == 'Dipinjamkan' ? 'warning' : 'success' }}">
                                {{ $peminjaman->status_peminjaman }}
                            </span>
                        </td>

                        {{-- Tanggal Kembali + Penerima --}}
                        <td>
                            @if ($peminjaman->tanggal_kembali)
                                <strong>{{ $peminjaman->tanggal_kembali->format('d M Y H:i') }}</strong><br>
                                <small class="text-muted">{{ $peminjaman->nama_penerima }}</small>
                            @else
                                <span class="text-danger">Belum Kembali</span>
                            @endif
                        </td>

                        {{-- Action --}}
                        <td>
                            @if ($peminjaman->acc_peminjaman === 'pending')
                                {{-- Jika user adalah Admin atau Sarpras --}}
                                @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isSarpras()))
                                    {{-- Form ACC peminjaman --}}
                                    @include('components.acc-peminjaman')
                                @endif
                            @elseif ($peminjaman->acc_peminjaman === 'approved' && $peminjaman->status_peminjaman === 'Dipinjamkan')
                                {{-- Jika user adalah Sarpras --}}
                                @if (Auth::check() && Auth::user()->isSarpras())
                                    {{-- Tombol pengembalian --}}
                                    @include('components.kembalikan-barang-button')
                                @endif
                            @elseif ($peminjaman->acc_peminjaman === 'rejected')
                                <span class="text-danger">Ditolak</span><br>
                                <small>{{ $peminjaman->alasan }}</small>
                            @else
                                <span class="text-muted">Selesai</span>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
