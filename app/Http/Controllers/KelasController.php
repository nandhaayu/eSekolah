<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Kelas::create($request->only('nama'));

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update(['nama' => $request->nama]);

        if ($request->ajax()) {
            return response()->json(['message' => 'Kelas diperbarui']);
        }

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
}

    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.show', compact('kelas'));
    }

    public function destroy($id)
    {
        Kelas::destroy($id);
        return redirect()->route('kelas.index')->with('success', 'Data guru berhasil dihapus.');

    }
}
