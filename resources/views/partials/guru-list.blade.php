@foreach($kelasGuruList as $kelas)
    <div class="mb-10 bg-gray-50 rounded shadow p-6">
        <h3 class="text-xl font-semibold text-blue-800 mb-4">
            <i class="fas fa-chalkboard-teacher"></i> {{ $kelas->nama }}
        </h3>

        @if($kelas->gurus->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-300 text-sm">
                    <thead class="bg-blue-100 text-gray-700">
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">NIP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kelas->gurus as $index => $guru)
                            <tr class="hover:bg-gray-100">
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">{{ $guru->nama }}</td>
                                <td class="border px-4 py-2">{{ $guru->nip }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="italic text-gray-500">Tidak ada guru yang terhubung dengan kelas ini.</p>
        @endif
    </div>
@endforeach