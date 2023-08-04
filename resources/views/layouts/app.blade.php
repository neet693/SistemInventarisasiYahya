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
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Inventory Management System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}" title="Beranda"><i class="bi bi-house"></i>
                            Home</a>
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
                                <a class="nav-link" href="{{ route('penempatans.index') }}" title="Daftar Penempatan"><i
                                        class="bi bi-building-check"></i> Daftar Penempatan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('perbaikans.index') }}" title="Daftar Perbaikan"><i
                                        class="bi bi-database-gear"></i> Daftar Perbaikan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('status_perbaikans.index') }}"
                                    title="Status Perbaikan"><i class="bi bi-clipboard-pulse"></i> Daftar Status
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
                                        class="bi bi-clipboard-fill"></i> Kategori Barang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('jenis_pengadaans.index') }}"
                                    title="Jenis Pengadaan"><i class="bi bi-clipboard-check"></i> Jenis Pengadaan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('jenis_ruangans.index') }}" title="Jenis Ruangan"><i
                                        class="bi bi-building-add"></i> Jenis Ruangan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ruangans.index') }}" title="Daftar Ruangan"><i
                                        class="bi bi-building"></i> Daftar Ruangan</a>
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
                                <a class="nav-link" href="{{ route('levels.index') }}"><i
                                        class="bi bi-person-gear"></i>
                                    Pengaturan
                                    Level</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
