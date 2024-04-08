<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengaturan.index', [
            'data' => Pengaturan::first(),
            'active' => '/'
        ]);
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
    
        $request->validate([
            'krs_mulai' => 'required|date',
            'krs_akhir' => 'required|date|after_or_equal:krs_mulai',
            'khs_mulai' => 'required|date',
            'khs_akhir' => 'required|date|after_or_equal:khs_mulai',
        ]);

        
        Pengaturan::create([
            'krs_mulai' => $request->krs_mulai,
            'krs_akhir' => $request->krs_akhir,
            'khs_mulai' => $request->khs_mulai,
            'khs_akhir' => $request->khs_akhir,
        ]);

        
        return redirect()->back()->with('success', 'Periode KRS dan KHS berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaturan $pengaturan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengaturan $pengaturan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengaturan $pengaturan)
    {
        
        $request->validate([
            'krs_mulai' => 'required|date',
            'krs_akhir' => 'required|date|after_or_equal:krs_mulai',
            'khs_mulai' => 'required|date',
            'khs_akhir' => 'required|date|after_or_equal:khs_mulai',
        ]);

        
        Pengaturan::where('id',$pengaturan->id)->update([
            'krs_mulai' => $request->krs_mulai,
            'krs_akhir' => $request->krs_akhir,
            'khs_mulai' => $request->khs_mulai,
            'khs_akhir' => $request->khs_akhir,
        ]);

        return redirect()->back()->with('success', 'Periode KRS dan KHS berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengaturan $pengaturan)
    {
        //
    }
}
