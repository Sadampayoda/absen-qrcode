<?php

namespace App\Http\Controllers;

use App\Models\AmbilMatkul;
use App\Models\JadwalMatkul;
use App\Models\Pengaturan;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaturan = Pengaturan::first();
        $today = now()->format('Y-m-d');
        $today = date($today);
        $mulai = date($pengaturan->khs_mulai);
        $akhir = date($pengaturan->khs_akhir);
        // dd($today);
        if ($mulai < $today && $today < $akhir) {
            $status = 'aktif';
            // $active = 'krs'; 
        } else {
            $status = 'non'; 
            // $active = '/'; 
        }
        
        return view('dosen.nilai.index',[
            'data' => JadwalMatkul::select('jadwal_matkuls.id as id_jadwal','jadwal_matkuls.*','ruangs.*','matakuliahs.*')->join('matakuliahs','matakuliahs.id','=','jadwal_matkuls.id_matakuliah')->join('ruangs','ruangs.id','=','jadwal_matkuls.id_ruang')->where('id_users',auth()->user()->id)->get(),
            'active' => '/',
            'status' => $status
        ]);
        // return view()
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validasi = $request->validate([
            'nilai' => 'required',
            'id_ambil_matkul' => 'required'
        ]);


        Penilaian::create($validasi);
        return redirect()->route('nilai.index')->with('success', 'Penilaian berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data = AmbilMatkul::select('users.*','matakuliahs.*','ambil_matkuls.id as id_ambil')->join('jadwal_matkuls','ambil_matkuls.id_jadwal_matkul','=','jadwal_matkuls.id')->join('matakuliahs','matakuliahs.id','=','jadwal_matkuls.id_matakuliah')->join('users','users.id','=','ambil_matkuls.id_users')->where('jadwal_matkuls.id',$request->nilai)->get();
        
        $data->map(function($data){
            $cek = Penilaian::where('id_ambil_matkul',$data->id_ambil)->first();
            if($cek){
                $data->nilai = $cek->nilai;
            }else{
                $data->nilai = 'not';
            }
        });
        // dd($penilaian->id);
        
        return view('dosen.nilai.show',[
            'active' => '/',
            'data' => $data,
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penilaian $penilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penilaian $penilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penilaian $penilaian)
    {
        //
    }
}
