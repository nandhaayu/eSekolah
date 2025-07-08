<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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

        $kelas = Kelas::create($request->only('nama'));

        if ($request->ajax()) {
            return response()->json(['message' => 'Data kelas berhasil ditambahkan.', 'data' => $kelas]);
        }

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return response()->json(['kelas' => $kelas]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->nama = $request->nama;
        $kelas->save();

        return response()->json(['message' => 'Data kelas berhasil diperbarui']);
    }

    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return response()->json($kelas);
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return response()->json([
            'message' => 'Data kelas berhasil dihapus.'
        ]);

    }
}
