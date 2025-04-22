<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> --}}
    <link rel="icon" href="{{ asset('assets/logo-itdept.ico') }}" type="image/x-icon" />

    <link href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.min.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}"> --}}
    {{-- Data Table --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    {{-- Tom --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg">
            <div class="container main-navbar">
                <a class="navbar-brand" href="{{ route('home') }}">SKY-IMS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth
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
                                        <a class="nav-link" href="{{ route('perbaikans.index') }}"
                                            title="Daftar Perbaikan"><i class="bi bi-database-gear"></i> Daftar
                                            Perbaikan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('status_perbaikans.index') }}"
                                            title="Status Perbaikan"><i class="bi bi-clipboard-pulse"></i>
                                            Daftar
                                            Status
                                            Perbaikan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('peminjamans.index') }}">{{ __('Peminjaman') }}</a>
                                    </li>
                                </ul>
                            </li>
                            @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isSarpras()))
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Data Master
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('kategorials.index') }}"
                                                title="Daftar Kategori"><i class="bi bi-clipboard-fill"></i>
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
                                            <a class="nav-link" href="{{ route('ruangans.index') }}"
                                                title="Daftar Ruangan"><i class="bi bi-building"></i> Daftar
                                                Ruangan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('units.index') }}" title="Daftar Unit"><i
                                                    class="bi bi-building"></i> Daftar
                                                Unit</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if (Auth::check() && Auth::user()->isAdmin())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        User Setting
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('levels.index') }}"><i
                                                    class="bi bi-person-gear"></i>
                                                Pengaturan
                                                Level</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('settings.index') }}"><i
                                                    class="bi bi-person-gear"></i>
                                                User Settings</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('peminjamans.create') }}">{{ __('Pinjam Barang') }}</a>
                            </li>
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nama }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ secure_asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    @include('layouts.script')
</body>

</html>
