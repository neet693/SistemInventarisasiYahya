@extends('layouts.app')
@section('content')
    <h1>Welcome to the Inventory Management System</h1>

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Inventory Summary:</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
            <p>Total Barang: {{ $totalBarang }}</p>
            <p>Total Penempatan: {{ $totalPenempatan }}</p>
            <p>Total Perbaikan: {{ $totalPerbaikan }}</p>
            <a href="{{ route('barangs.index') }}" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>
    </div>
@endsection
