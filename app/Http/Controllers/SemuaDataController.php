<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SemuaDataController extends Controller
{
    public function index(){
        return view('semuaData', [
            'allKelas' => Kelas::all(),
            'kelasList' => Kelas::with('siswas')->get(),
            'kelasGuruList' => Kelas::with('gurus')->get(),
        ]);
    }

    public function dataList(){
        $data=Kelas::with(['gurus', 'siswas'])->get();
        return Response::json($data);
    }
}
