@foreach($kelasList as $kelas)
    <div class="mb-10 bg-white rounded shadow p-6">
        <h3 class="text-xl font-semibold text-yellow-600 mb-4">
            <i class="fas fa-chalkboard"></i> {{ $kelas->nama }}
        </h3>

        @if($kelas->siswas->isNotEmpty())
            <table class="min-w-full table-auto border border-gray-300 text-sm">
                <thead class="bg-yellow-100 text-gray-700">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">NIS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kelas->siswas as $index => $siswa)
                        <tr>
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $siswa->nama }}</td>
                            <td class="border px-4 py-2">{{ $siswa->nis }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="italic text-gray-500">Tidak ada siswa di kelas ini.</p>
        @endif
    </div>
@endforeach
