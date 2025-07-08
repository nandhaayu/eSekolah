<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'allKelas' => Kelas::all(),
            'kelasList' => Kelas::with('siswas')->get(),
            'kelasGuruList' => Kelas::with('gurus')->get(),
        ]);
    }

    public function filterSiswa(Request $request)
    {
        $kelasId = $request->kelas_id;

        $kelasList = $kelasId
            ? Kelas::with('siswas')->where('id', $kelasId)->get()
            : Kelas::with('siswas')->get();

        return view('partials.siswa-table', compact('kelasList'))->render();
    }

    public function filterGuru(Request $request)
    {
        $kelasId = $request->kelas_id;

        $kelasGuruList = Kelas::with(['gurus' => function ($q) {
            $q->orderBy('nama');
        }])
        ->when($kelasId, fn($q) => $q->where('id', $kelasId))
        ->get();

        return view('partials.guru-list', compact('kelasGuruList'));
    }
    
    public function gabungan()
    {
        $kelasList = Kelas::with(['guru', 'siswas'])->get();
        return view('gabungan.index', compact('kelasList'));
    }


}
