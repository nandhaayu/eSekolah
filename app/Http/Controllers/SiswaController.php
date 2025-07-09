<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SiswaController extends Controller
{
    // Tampilkan semua data siswa
    public function index()
    {
        $siswas = Siswa::with('kelas')->get();
        $kelas = Kelas::all(); 
        return view('siswa.index', compact('siswas', 'kelas'));
    }

    // Simpan siswa baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa = Siswa::create($validated);

        return response()->json([
            'message' => 'Data siswa berhasil ditambahkan.',
            'data' => $siswa
        ], 201);
    }

    // Tampilkan detail siswa
    public function show($id)
    {
        $siswa = Siswa::with('kelas')->findOrFail($id);
        return response()->json($siswa);
    }

    // Tampilkan data untuk edit siswa
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return response()->json(['siswa' => $siswa]);
    }

    // Update siswa
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis,' . $id,
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($validated);

        return response()->json([
            'message' => 'Data siswa berhasil diperbarui.',
            'data' => $siswa
        ]);
    }

    // Hapus siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return response()->json([
            'message' => 'Data siswa berhasil dihapus.'
        ]);
    }

    public function siswas(Request $request)
    {
        $kelasId = $request->kelas_id;
        $siswaList = Kelas::with(['siswas' => function ($q){
            $q->orderBy('nama');
        }])
        ->when($kelasId, fn($q)=> $q->where('id', $kelasId))
        ->get();
        return Response::json($siswaList);
        return view('siswa.siswaList', compact('siswaList'));
    }

    public function siswaList()
    {
        $siswas = Siswa::with('kelas')->get();
        $kelas = Kelas::all(); 
        return view('siswa.siswaList', compact('siswas', 'kelas'));
    }
}
