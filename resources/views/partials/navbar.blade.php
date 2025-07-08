<!-- Top Bar -->
    <div class="bg-[#0d2c4d] text-white text-sm py-2 px-4 flex justify-between items-center">
        <div class="flex items-center gap-6">
            <span><i class="fas fa-map-marker-alt mr-1 text-yellow-400"></i>123 Street, New York, USA</span>
            <span><i class="fas fa-clock mr-1 text-yellow-400"></i>Mon - Fri: 09.00 AM - 09.00 PM</span>
        </div>
        <div class="flex items-center gap-4">
            <span><i class="fas fa-phone-alt mr-1 text-yellow-400"></i>+012 345 6789</span>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
        <div class="flex items-center gap-2 text-2xl font-bold text-blue-900">
            <i class="fas fa-school text-warning fs-4"></i> eSekolah
        </div>
        <ul class="hidden md:flex gap-6 font-medium text-sm items-center">
            <li><a href="#" class="text-yellow-500 font-bold">Home</a></li>
            <li><a href="#siswa-kelas" class="hover:text-yellow-500">Data Siswa Berdasarkan Kelas</a></li>
            <li><a href="#guru-kelas" class="hover:text-yellow-500">Data Guru Berdasarkan Kelas</a></li>
            <li><a href="#data-gabungan" class="hover:text-yellow-500">Data Keseluruhan</a></li>
        </ul>

        @if (Route::has('login'))
        <div class="hidden md:flex gap-4 items-center ml-4">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="px-4 py-2 text-sm border border-gray-300 rounded hover:border-gray-400"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center gap-2"
                >
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center gap-2"
                    >
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                @endif
            @endauth
        </div>
    @endif
    </nav>
