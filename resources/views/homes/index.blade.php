<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Halo {{ Auth::user()->nama }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Anda dari unit <strong>{{ Auth::user()->unit ? Auth::user()->unit->nama : 'Admin' }}</strong><br>
                    Role anda adalah <strong>{{ Auth::user()->level->nama }}</strong>
                </div>
            </div>
        </div>
        <h2>Dashboard</h2>
        <div class="row mt-4">
            @foreach ($units as $unit)
                <div class="col-3">
                    <div class="card mb-3"
                        style="background-color: {{ $unit->nama == 'TK' ? '#FFA55D' : ($unit->nama == 'SD' ? '#F08E8F' : ($unit->nama == 'SMP' ? '#024887' : ($unit->nama == 'SMA' ? '#5FB5EC' : '#333333'))) }}">

                        <div class="card-body" title="Unit {{ $unit->nama }}">
                            <a href="{{ route('home.unit', $unit->nama) }}" style="text-decoration:none">
                                <h5 class="card-title text-white"><i class="bi bi-boxes"></i> Unit
                                    {{ $unit->nama }}</h5>
                                <p class="card-text text-white">{{ $unit->total_barang_baik }}</p>
                                <!-- Menggunakan total_barang_baik -->
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Log Aktivitas</h3>
                <table id="activitylogs" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Action</th>
                            <th>IP Address</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->email }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->ip_address }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastEl = document.querySelector('.toast');
            if (toastEl) {
                const bsToast = new bootstrap.Toast(toastEl, {
                    delay: 4000
                });
                bsToast.show();
            }
        });
    </script>
@endsection
