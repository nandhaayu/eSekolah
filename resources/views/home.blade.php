<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eSekolah</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-white text-gray-800">

<!-- Navbar -->
@include('partials.navbar')

<!-- Navbar -->
@include('partials.hero')

<!-- Section: Siswa Berdasarkan Kelas -->
<section id="siswa-kelas" class="py-12 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Daftar Siswa Berdasarkan Kelas</h2>

        <!-- Tombol Filter Kelas -->
        <div class="flex flex-wrap gap-2 justify-center mb-6">
            <button onclick="loadSiswa(null, this)" class="filter-btn bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Semua
            </button>
            @foreach($allKelas as $kelasItem)
                <button onclick="loadSiswa({{ $kelasItem->id }}, this)" class="filter-btn bg-white border border-yellow-500 text-yellow-600 px-4 py-2 rounded hover:bg-yellow-500 hover:text-white">
                    {{ $kelasItem->nama }}
                </button>
            @endforeach
        </div>

        <!-- Tempat menampilkan siswa -->
        <div id="siswaContainer">
            @include('partials.siswa-table', ['kelasList' => $kelasList])
        </div>
    </div>
</section>

<section id="guru-kelas" class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Daftar Guru Berdasarkan Kelas</h2>

        <!-- Tombol Filter -->
        <div class="flex flex-wrap gap-2 justify-center mb-6">
            <button onclick="loadGuru(null, this)" class="filter-guru-btn bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Semua
            </button>

            @foreach($allKelas as $kelasItem)
                <button
                    onclick="loadGuru({{ $kelasItem->id }}, this)"
                    class="filter-guru-btn bg-white border border-blue-500 text-blue-600 px-4 py-2 rounded hover:bg-blue-500 hover:text-white"
                >
                    {{ $kelasItem->nama }}
                </button>
            @endforeach
        </div>


        <!-- Container Guru -->
        <div id="guruContainer">
            @include('partials.guru-list', ['kelasGuruList' => $kelasGuruList])
        </div>
    </div>
</section>

<section id="data-gabungan" class="py-12 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Daftar Keseluruhan</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300 text-sm bg-white rounded shadow">
                <thead class="bg-yellow-100 text-gray-700">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama Siswa</th>
                        <th class="border px-4 py-2">NIS</th>
                        <th class="border px-4 py-2">Kelas</th>
                        <th class="border px-4 py-2">Guru</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($kelasList as $kelas)
                        @foreach($kelas->siswas as $siswa)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $no++ }}</td>
                                <td class="border px-4 py-2">{{ $siswa->nama }}</td>
                                <td class="border px-4 py-2">{{ $siswa->nis }}</td>
                                <td class="border px-4 py-2">{{ $kelas->nama }}</td>
                                <td class="border px-4 py-2">
                                    {{ $kelas->gurus->first()->nama ?? 'Belum ada guru' }}
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>


<script>
function loadSiswa(kelasId, btn) {
    // Highlight tombol aktif
    document.querySelectorAll('.filter-btn').forEach(el => {
        el.classList.remove('bg-yellow-500', 'text-white');
        el.classList.add('bg-white', 'text-yellow-600');
    });

    btn.classList.remove('bg-white', 'text-yellow-600');
    btn.classList.add('bg-yellow-500', 'text-white');

    // Fetch data siswa
    fetch(`/filter-siswa?kelas_id=${kelasId ?? ''}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('siswaContainer').innerHTML = html;
    })
    .catch(err => console.error('Gagal memuat data siswa:', err));
}
</script>
<script>
    function loadGuru(kelasId = null, btn) {
        document.querySelectorAll('.filter-guru-btn').forEach(b => b.classList.remove('bg-blue-500', 'text-white'));
        btn.classList.add('bg-blue-500', 'text-white');

        fetch(`/filter-guru?kelas_id=${kelasId ?? ''}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('guruContainer').innerHTML = html;
        })
        .catch(err => console.error(err));
    }
</script>
</body>
</html>