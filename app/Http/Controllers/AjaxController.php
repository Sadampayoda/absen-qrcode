<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalMatkul;

class AjaxController extends Controller
{
    public function krs(Request $request)
    {
        $jadwal = JadwalMatkul::select('jadwal_matkuls.id as id_jadwal', 'matakuliahs.*', 'ruangs.*', 'jams.*')->join('ruangs', 'jadwal_matkuls.id_ruang', '=', 'ruangs.id')->join('matakuliahs', 'matakuliahs.id', '=', 'jadwal_matkuls.id_matakuliah')->join('jams', 'jams.id', '=', 'ruangs.id_jam')->where('semester',$request->semester)->get();
        // return 'oke';
        return view('mahasiswa.krs.select',[
            'data' => $jadwal,
            'active' => 'krs'
        ]);
    }
}
