<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'eSekolah') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Kiri: Brand -->
                <a class="navbar-brand d-flex align-items-center gap-2 fw-bold text-primary" href="{{ url('/') }}">
                    <i class="fas fa-school text-warning fs-4"></i> <span class="text-primary">eSekolah</span>
                </a>

                <!-- Toggle Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Isi Navbar -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Tengah: Menu -->
                    <ul class="navbar-nav mx-auto d-flex gap-4 align-items-center">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-1" href="{{ route('kelas.index') }}">
                                    <i class="fas fa-desktop text-dark"></i> <span class="text-dark">Kelas</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-1" href="{{ route('siswa.index') }}">
                                    <i class="fas fa-user-graduate text-dark"></i> <span class="text-dark">Siswa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-1" href="{{ route('guru.index') }}">
                                    <i class="fas fa-chalkboard-teacher text-dark"></i> <span class="text-dark">Guru</span>
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Kanan: Login / Profile -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm text-white me-2" href="{{ route('login') }}"
                                    style="background-color: #fbbf24;">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                            </li>

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm text-white" href="{{ route('register') }}"
                                        style="background-color: #22c55e;">
                                        <i class="fas fa-user-plus me-1"></i> Register
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fw-semibold d-flex align-items-center gap-1"
                                href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-1"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 px-2">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
