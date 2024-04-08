<?php

namespace App\Http\Controllers;

use App\Models\JadwalMatkul;
use App\Models\Matakuliah;
use App\Models\Ruang;
use Illuminate\Http\Request;

class JadwalMatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JadwalMatkul::select('matakuliahs.nama')->join('matakuliahs','matakuliahs.id','=','jadwal_matkuls.id_matakuliah')->groupBy('matakuliahs.nama')->get();

        $select = Matakuliah::select('matakuliahs.nama')->groupBy('matakuliahs.nama')->get();

        return view('admin.jadwal-matkul.index',[
            'active' => 'jadwal-matkul',
            'data' => $data ,
            'select' => $select
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request->nama);
        $data = JadwalMatkul::join('matakuliahs','matakuliahs.id','=','jadwal_matkuls.id_matakuliah')->join('ruangs','ruangs.id','=','jadwal_matkuls.id_ruang')->where('matakuliahs.nama',$request->nama)->get();

        $kelas = [];
        $ruang = [];
        // dd($request->nama)
        // dd(Matakuliah::where('nama',$request->name)->get());
        $dataMatkul = Matakuliah::where('nama',$request->nama)->get();
        $dataRuang = Ruang::all();
        
        foreach($dataMatkul as $item)
        {
            if(JadwalMatkul::join('matakuliahs','matakuliahs.id','=','jadwal_matkuls.id_matakuliah')->join('ruangs','ruangs.id','=','jadwal_matkuls.id_ruang')->where('matakuliahs.id',$item->id)->count() == 0)
            {
                $kelas[] = $item->kelas;
            }

            
        }

        foreach($dataRuang as $item)
        {
            if(JadwalMatkul::join('matakuliahs','matakuliahs.id','=','jadwal_matkuls.id_matakuliah')->join('ruangs','ruangs.id','=','jadwal_matkuls.id_ruang')->where('ruangs.id',$item->id)->count() == 0){
                $ruang[] = $item->ruangan; 
            }
        }
        // dd($ruang);
        // foreach($data as $item)
        // {
        //     // $kelas[] = Matakuliah::where('kelas','!=',)
        // }
        $select = Matakuliah::select('matakuliahs.nama')->groupBy('matakuliahs.nama')->get();
        if(empty($kelas)){
            return redirect()->route('jadwal-matkul.index')->with('error','Mata kuliah '.$request->nama.'Kelasnya sudah di beri ruang');
        }

        return view('admin.jadwal-matkul.create',[
            'active' => 'jadwal-matkul',
            'data' => $ruang,
            'kelas' => $kelas,
            'name' => $request->nama,
            'select' => $select
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'ruang' => 'required',
            'kelas' => 'required'
        ]);
        $kelas = Matakuliah::where('kelas',$request->kelas)->where('nama',$request->nama)->first();
        $ruang = Ruang::where('ruangan',$request->ruang)->first();

        // dd($kelas,$ruang);
        JadwalMatkul::create([
            'id_matakuliah' => $kelas->id,
            'id_ruang' => $ruang->id
        ]);

        return redirect()->route('jadwal-matkul.index')->with('success','Data Jadwal telah berhasil ditambah');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $select = Matakuliah::select('matakuliahs.nama')->groupBy('matakuliahs.nama')->get();
        return view('admin.jadwal-matkul.show',[
            'data' => JadwalMatkul::join('matakuliahs','matakuliahs.id','=','jadwal_matkuls.id_matakuliah')->join('ruangs','ruangs.id','=','jadwal_matkuls.id_ruang')->join('jams','ruangs.id_jam','=','jams.id')->where('matakuliahs.nama',$request->jadwal_matkul)->get(),
            'active' => 'jadwal-matkul',
            'select' => $select
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalMatkul $jadwalMatkul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalMatkul $jadwalMatkul)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = JadwalMatkul::select('jadwal_matkuls.id')->join('matakuliahs','matakuliahs.id','=','jadwal_matkuls.id_matakuliah')->join('ruangs','ruangs.id','=','jadwal_matkuls.id_ruang')->where('matakuliahs.nama',$request->jadwal_matkul)->where('matakuliahs.kelas',$request->kelas)->first();
        
        JadwalMatkul::where('id',$data->id)->delete();
        return redirect()->route('jadwal-matkul.index')->with('success','Data Jadwal telah berhasil dihapus');

    }
}
