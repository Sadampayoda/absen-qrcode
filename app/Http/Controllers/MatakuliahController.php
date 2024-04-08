<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\User;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.matakuliah.index',[
            'data' => Matakuliah::select('matakuliahs.*','users.name')->join('users','users.id','=','matakuliahs.id_users')->get(),
            'active' => 'mata-kuliah'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.matakuliah.create',[
            'active' => 'mata-kuliah',
            'data' => User::where('level','dosen')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'sks' => 'required',
            'semester' => 'required',
            'id_users' => 'required'
        ]);

        Matakuliah::create([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'prasyarat' => $request->prasyarat,
            'id_users' => $request->id_users,
            'prasyarat_sks' => $request->prasyarat_sks,
        ]);



        return redirect()->route('mata-kuliah.index')->with('success','Data Mata Kuliah telah berhasil ditambah'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Matakuliah $matakuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $data = Matakuliah::find($request->mata_kuliah);
        // dd($data);
        return view('admin.matakuliah.edit',[
            'mata_kuliah' => $data,
            'data' => User::all(),
            'active' => 'mata-kuliah'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Matakuliah::find($request->id);
        if($request->nama == $data->nama){
            $validasi = $request->validate([
                'kelas' => 'required',
                'sks' => 'required',
                'semester' => 'required',
                'id_users' => 'required'
            ]);

        }else{
            $validasi = $request->validate([
                'nama' => 'required',
                'kelas' => 'required',
                'sks' => 'required',
                'semester' => 'required',
                'id_users' => 'required'
            ]);
        }

        Matakuliah::where('id',$request->id)->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'prasyarat' => $request->prasyarat,
            'id_users' => $request->id_users,
            'prasyarat_sks' => $request->prasyarat_sks,
        ]);

        
        
        return redirect()->route('mata-kuliah.index')->with('success','Data Mata Kuliah telah berhasil diedit'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // return $request->mata_kuliah;
        Matakuliah::where('id',$request->mata_kuliah)->delete();

        return redirect()->route('mata-kuliah.index')->with('success','Data Mata Kuliah telah berhasil dihapus'); 
    }
}
