<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    // Menampilkan semua guru
    public function index()
    {
        $gurus = Guru::with('kelas')->get();
        return view('guru.index', compact('gurus'));
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

        Guru::create($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    // Tampilkan detail (opsional)
    public function show($id)
    {
        $guru = Guru::with('kelas')->findOrFail($id);
        return view('guru.show', compact('guru'));
    }

    // Form edit guru
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $kelas = Kelas::all();
        return view('guru.edit', compact('guru', 'kelas'));
    }

    // Update guru
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:gurus,nip,' . $id,
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->update($request->all());

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    // Hapus guru
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
