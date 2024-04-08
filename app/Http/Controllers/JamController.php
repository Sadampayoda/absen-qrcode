<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use Illuminate\Http\Request;

class JamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jam = ['07:00', '09:00', '11:00', '14:00', '16:00', '18:00'];
        
        
        
        return view('admin.jam.index',[
            'active' => 'jam',
            'data' => Jam::all(), 
            'Senin' => Jam::select('jam_mulai','jam_akhir')->where('hari','Senin')->orderBy('jam_mulai','asc')->get(),
            'Selasa' => Jam::select('jam_mulai','jam_akhir')->where('hari','Selasa')->orderBy('jam_mulai','asc')->get(),
            'Rabu' => Jam::select('jam_mulai','jam_akhir')->where('hari','Rabu')->orderBy('jam_mulai','asc')->get(),
            'Kamis' => Jam::select('jam_mulai','jam_akhir')->where('hari','Kamis')->orderBy('jam_mulai','asc')->get(),
            'Jumat' => Jam::select('jam_mulai','jam_akhir')->where('hari','Jumat')->orderBy('jam_mulai','asc')->get(),
            'Sabtu' => Jam::select('jam_mulai','jam_akhir')->where('hari','Sabtu')->orderBy('jam_mulai','asc')->get(),
            'jam' => $jam,
            'SeninCount' => Jam::select('jam_mulai','jam_akhir')->where('hari','Senin')->count(),
            'SelasaCount' => Jam::select('jam_mulai','jam_akhir')->where('hari','Selasa')->count(),
            'RabuCount' => Jam::select('jam_mulai','jam_akhir')->where('hari','Rabu')->count(),
            'KamisCount' => Jam::select('jam_mulai','jam_akhir')->where('hari','Kamis')->count(),
            'JumatCount' => Jam::select('jam_mulai','jam_akhir')->where('hari','Jumat')->count(),
            'SabtuCount' => Jam::select('jam_mulai','jam_akhir')->where('hari','Sabtu')->count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jam.create',[
            'active' => 'jam'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $waktu = explode("-", $request->jam);
        $jam_mulai = $waktu[0]; 
        $jam_akhir = $waktu[1];
        // dd($request->jam_mulai);
        // $jam_awal = date("H:i", intval($request->jam_mulai));
        // $jam_akhir = date("H:i", intval($request->jam_akhir));
        $check_jam = Jam::where('hari',$request->hari)->where('jam_mulai',$jam_mulai)
                                                        ->count();

        if($check_jam > 0){
            return redirect()->back()->with('error','Maaf waktu sudah terpakai');
        }
        if($request->hari == 'jumat' and $jam_mulai == '11:00')
        {
            return redirect()->back()->with('error','Maaf hari jumat tidak bisa jam 11.00');

        }

        Jam::create([
            'hari' => $request->hari,
            'jam_mulai' => $jam_mulai,
            'jam_akhir' => $jam_akhir
        ]);

        return redirect()->route('jam.index')->with('success','Data Jam telah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jam $jam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jam $jam)
    {
        return view('admin.jam.edit',[
            'active' => 'jam',
            'jam' => Jam::findOrFail($jam->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jam $jam)
    {
        $waktu = explode("-", $request->jam);
        $jam_mulai = $waktu[0]; 
        $jam_akhir = $waktu[1];
        // dd($request->jam_mulai);
        // $jam_awal = date("H:i", intval($request->jam_mulai));
        // $jam_akhir = date("H:i", intval($request->jam_akhir));
        $check_jam = Jam::where('hari',$request->hari)->where('jam_mulai',$jam_mulai)
                                                        ->count();

        if($check_jam > 0){
            return redirect()->back()->with('error','Maaf waktu sudah terpakai');
        }
        if($request->hari == 'jumat' and $jam_mulai == '11:00')
        {
            return redirect()->back()->with('error','Maaf hari jumat tidak bisa jam 11.00');

        }
        
        $jam = Jam::findOrFail($jam->id);
        $jam->hari = $request->hari;
        $jam->jam_mulai = $jam_mulai;
        $jam->jam_akhir = $jam_akhir;
        $jam->save();

        return redirect()->route('jam.index')->with('success','Data Jam telah berhasil diedit');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jam $jam)
    {
        
        $data = Jam::findOrFail($jam->id);
        $data->delete();

        return redirect()->route('jam.index')->with('success','Data Jam telah berhasil dihapus');

    }
}
