<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'id_ambil' => 'required',
            'image' => 'required',
        ]);

        $image_absen = $request->image;
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_absen));

        
        $image_absen = time() . '_image.jpg';

        
        $path = public_path('image/absen/') . $image_absen;
        file_put_contents($path, $image);
        // dd($image_absen);

        Absensi::create([
            'id_ambil_matkul' => $request->id_ambil,
            'image' => $image_absen,
            'tanggal' => date('Y-m-d'),
            'waktu' => date('H:i:s'),
        ]);

        $token = Str::random(60);

        // 
        while (User::where('token_absen', $token)->exists()) {
            $token = Str::random(60);
        }

        User::where('id',auth()->user()->id)->update([
            'token_absen' => $token
        ]);
        return redirect()->route('krs.index')->with('success', 'Absensi berhasil diambil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
