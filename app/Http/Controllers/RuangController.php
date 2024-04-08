<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.ruang.index',[
            'active' => 'ruang',
            'data' => Ruang::select('ruangan')->groupBy('ruangan')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = null;
        if($request->id)
        {
            $id = $request->id;
        }
        return view('admin.ruang.create',[
            'active' => 'ruang',
            'data' => Jam::orderBy('hari','asc')->get(),
            'id' => $id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->id)
        {
            $validasi = $request->validate([
                'jam' => 'required'
            ]);
            if(Ruang::where('id_jam',$request->jam)->where('ruangan',$request->id)->count() > 0)
            {
                return redirect()->back()->with('error','Maaf Hari dan Jam tersebut sudah di pakai ');   
            }
            Ruang::create([
                'ruangan' => $request->id,
                'id_jam' => $request->jam
            ]);
    
            return redirect()->route('ruang.show',['ruang' => $request->id])->with('success','Data Ruangan telah berhasil ditambah');

        }else{
            $validasi = $request->validate([
                'ruangan' => 'required|unique:ruangs,ruangan',
                'jam' => 'required'
            ]);
    
            if(Ruang::where('id_jam',$request->jam)->where('ruangan',$request->ruangan)->count() > 0)
            {
                return redirect()->back()->with('error','Maaf Hari dan Jam tersebut sudah di pakai ');   
            }
    
    
            Ruang::create([
                'ruangan' => $request->ruangan,
                'id_jam' => $request->jam
            ]);
    
            return redirect()->route('ruang.index')->with('success','Data Ruangan telah berhasil ditambah');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // return 'o';
        // dd($request->ruang);

        return view('admin.ruang.show',[
            'active' => 'ruang',
            'data' => Ruang::select('ruangs.id as id_ruang','ruangan','jams.*')->join('jams','jams.id','=','ruangs.id_jam')
                            ->where('ruangan',$request->ruang)
                            ->get(),
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        return view('admin.ruang.edit',[
            'active' => 'ruang',
            'data' => $request->ruang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validasi = $request->validate([
            'ruangan' => 'required|unique:ruangs,ruangan',
        ]);
        Ruang::where('ruangan',$request->name)->update([
            'ruangan' => $request->ruangan
        ]);

        return redirect()->route('ruang.index')->with('success','Data Ruangan telah berhasil diedit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if($request->type == 'jam')
        {
            $data = Ruang::where('id',$request->ruang)->get();
            if(Ruang::where('ruangan',$data[0]->ruangan)->count() == 1){
                Ruang::where('id',$request->ruang)->delete();
                return redirect()->route('ruang.index')->with('success','Data Ruangan telah berhasil dihapus');
            }
            Ruang::where('id',$request->ruang)->delete();
            return redirect()->route('ruang.show',['ruang' => $data[0]->ruangan])->with('success','Data Ruangan telah berhasil dihapus');
        }
    }
}
