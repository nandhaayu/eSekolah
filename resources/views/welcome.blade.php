{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eSekolah</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="bg-white text-gray-800">

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
            <li><a href="#" class="hover:text-yellow-500">About</a></li>
            <li><a href="#" class="hover:text-yellow-500">Courses</a></li>
            <li class="relative group">
                <a href="#" class="hover:text-yellow-500">Pages <i class="fas fa-chevron-down text-xs ml-1"></i></a>
                <!-- Dropdown -->
                <ul class="absolute left-0 top-full mt-2 w-40 bg-white shadow-lg rounded-md hidden group-hover:block">
                    <li><a href="#" class="block px-4 py-2 hover:bg-yellow-100">Page 1</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-yellow-100">Page 2</a></li>
                </ul>
            </li>
            <li><a href="#" class="hover:text-yellow-500">Contact</a></li>
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

    <!-- Hero Section -->
    <section class="relative h-[500px] bg-cover bg-center flex items-center justify-center text-white" style="background-image: url('/your-image.jpg');">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative text-center px-4">
            <h1 class="text-4xl md:text-5xl font-bold">Learn To Drive<br>With Confidence</h1>
        </div>
        <!-- Arrows -->
        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-yellow-600 p-2 text-white cursor-pointer">
            <i class="fas fa-chevron-left"></i>
        </div>
        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-yellow-600 p-2 text-white cursor-pointer">
            <i class="fas fa-chevron-right"></i>
        </div>
    </section>

</body>
</html> --}}
