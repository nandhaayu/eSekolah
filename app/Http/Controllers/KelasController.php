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
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kelas = Kelas::create([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'message' => 'Data kelas berhasil ditambahkan.',
            'data' => $kelas,
        ], 201);
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kelas->update([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'message' => 'Data kelas berhasil diperbarui.',
            'data' => $kelas,
        ]);
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
