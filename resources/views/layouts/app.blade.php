<!-- resources/views/layouts/app.blade.php -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- Data Table --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

</head>

<body>
    {{-- Navbar Section --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container main-navbar">
            <a class="navbar-brand" href="{{ route('home') }}">SKY-IMS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            List Daftar
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('barangs.index') }}" title="Daftar Barang"><i
                                        class="bi bi-boxes"></i> Daftar Barang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('perbaikans.index') }}" title="Daftar Perbaikan"><i
                                        class="bi bi-database-gear"></i> Daftar
                                    Perbaikan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('status_perbaikans.index') }}"
                                    title="Status Perbaikan"><i class="bi bi-clipboard-pulse"></i>
                                    Daftar
                                    Status
                                    Perbaikan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('kategorials.index') }}" title="Daftar Kategori"><i
                                        class="bi bi-clipboard-fill"></i>
                                    Kategori
                                    Barang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('jenis_pengadaans.index') }}"
                                    title="Jenis Pengadaan"><i class="bi bi-clipboard-check"></i>
                                    Jenis
                                    Pengadaan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ruangans.index') }}" title="Daftar Ruangan"><i
                                        class="bi bi-building"></i> Daftar
                                    Ruangan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            User Setting
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('levels.index') }}"><i class="bi bi-person-gear"></i>
                                    Pengaturan
                                    Level</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    {{-- Content Section --}}
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    @include('layouts.script')
</body>

</html>
