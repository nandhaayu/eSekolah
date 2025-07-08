<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    // Menampilkan semua guru
    public function index()
    {
        $gurus = Guru::with('kelas')->get();
        $kelas = Kelas::all();
        return view('guru.index', compact('gurus', 'kelas'));
    }

    // Form tambah guru
    public function create()
    {
        $kelas = Kelas::all();
        return view('guru.create', compact('kelas'));
    }

    // Simpan guru baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:gurus',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $guru = Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'kelas_id' => $request->kelas_id,
        ]);

        return response()->json([
            'message' => 'Data guru berhasil ditambahkan.',
            'data' => $guru
        ]);
    }

    // Tampilkan detail
    public function show($id)
    {
        $guru = Guru::with('kelas')->findOrFail($id);
        return response()->json($guru);
    }

    // Form edit guru
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $kelas = Kelas::all();

        return response()->json([
        'guru' => $guru,
        'kelas' => $kelas
        ]);
    }

    // Update guru
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:gurus,nip,' . $id,
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $guru->update($request->all());

        return response()->json([
            'message' => 'Data guru berhasil diperbarui.',
            'data' => $guru
        ]);
    }

    // Hapus guru
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return response()->json(['message' => 'Data guru berhasil dihapus.']);
    }
}
