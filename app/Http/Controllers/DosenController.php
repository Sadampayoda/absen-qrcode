<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AmbilMatkul;
use App\Models\JadwalMatkul;
use App\Models\Ruang;
use Illuminate\Http\Request;
use App\Models\Semester;

class DosenController extends Controller
{
    public function index()
    {
        // dd(auth()->user());
        return view('dosen.jadwal-matkul.index',[
            'data' => JadwalMatkul::select('jadwal_matkuls.id as id_jadwal','jadwal_matkuls.*','ruangs.*','matakuliahs.*')->join('matakuliahs','matakuliahs.id','=','jadwal_matkuls.id_matakuliah')->join('ruangs','ruangs.id','=','jadwal_matkuls.id_ruang')->where('id_users',auth()->user()->id)->get(),
            'active' => 'jadwal-dosen'
        ]);
    }

    public function show($id)
    {
        return view('dosen.jadwal-matkul.show',[
            'data' => Ruang::join('jams','ruangs.id_jam','=','jams.id')->where('ruangs.id',$id)->first(),
            'active' => 'jadwal-dosen'
        ]);
    }

    public function siswa($id)
    {
        
        return view('dosen.jadwal-matkul.siswa',[
            'active' => 'jadwal-dosen',
            'data' => AmbilMatkul::select('users.*','jadwal_matkuls.id as id_jadwal')->join('jadwal_matkuls','ambil_matkuls.id_jadwal_matkul','=','jadwal_matkuls.id')->join('matakuliahs','matakuliahs.id','=','jadwal_matkuls.id_matakuliah')->join('users','users.id','=','ambil_matkuls.id_users')->where('jadwal_matkuls.id',$id)->get(),
        ]);
    }

    public function absensi($name,$id)
    {
        $data = Absensi::select('absensis.*','users.*','jadwal_matkuls.id')->join('ambil_matkuls','ambil_matkuls.id','=','absensis.id_ambil_matkul')->join('jadwal_matkuls','jadwal_matkuls.id','=','ambil_matkuls.id_jadwal_matkul')->join('users','users.id','=','ambil_matkuls.id_users')->where('jadwal_matkuls.id',$id)->where('users.name',$name)->paginate(4);
        return view('dosen.absensi.index',[
            'active' => '/',
            'data' => $data
        ]);
    }

    
}
