<?php

namespace App\Http\Controllers;

use App\Models\AmbilMatkul;
use App\Models\JadwalMatkul;
use App\Models\Matakuliah;
use App\Models\Pengaturan;
use App\Models\Semester;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sks = Semester::where('id_user',auth()->user()->id)->first();
        $data = AmbilMatkul::select('ambil_matkuls.id as id_ambil', 'matakuliahs.*')->join('jadwal_matkuls', 'jadwal_matkuls.id', '=', 'ambil_matkuls.id_jadwal_matkul')->join('matakuliahs', 'matakuliahs.id', '=', 'jadwal_matkuls.id_matakuliah')->join('users', 'ambil_matkuls.id_users', '=', 'users.id')->join('semesters', 'semesters.id_user', '=', 'users.id')->where('ambil_matkuls.id_users', auth()->user()->id)->where('ambil_matkuls.periode',$sks->periode)->get();
        // dd($data);

        $pengaturan = Pengaturan::first();
        // $today = now();
        $today = now()->format('Y-m-d');
        $today = date($today);
        $mulai = date($pengaturan->krs_mulai);
        $akhir = date($pengaturan->krs_akhir);
        // dd($today);
        if ($mulai < $today && $today < $akhir) {
            $status = 'aktif';
            $active = 'krs'; 
        } else {
            $status = 'non'; 
            $active = '/'; 
        }
        // dd($status);
        return view('mahasiswa.krs.index', [
            'data' => $data,
            'active' => $active,
            'sks' => $sks,
            'status' => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Matakuliah::select('semester')->groupBy('semester')->get();



        // dd($tes);
        return view('mahasiswa.krs.create', [
            'data' => $data,
            'active' => 'krs'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = AmbilMatkul::select('ambil_matkuls.id as id_ambil', 'matakuliahs.*')->join('jadwal_matkuls', 'jadwal_matkuls.id', '=', 'ambil_matkuls.id_jadwal_matkul')->join('matakuliahs', 'matakuliahs.id', '=', 'jadwal_matkuls.id_matakuliah')->where('ambil_matkuls.id_users', auth()->user()->id)->where('matakuliahs.nama', $request->matkul)->count();

        // dd($data,$data->count());

        if ($data > 0) {
            return redirect()->route('krs.index')->with('error', 'mata kuliah sudah di ambil');
        }

        $periode = Semester::where('id_user',auth()->user()->id)->first();
        AmbilMatkul::create([
            'id_users' => auth()->user()->id,
            'id_jadwal_matkul' => $request->id_jadwal,
            'periode' => $periode->periode
        ]);

        return redirect()->route('krs.index')->with('success', 'mata kuliah berhasil diambil');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        

        // dd($data);

        $token = Str::random(60);

        // 
        while (User::where('token_absen', $token)->exists()) {
            $token = Str::random(60);
        }

        User::where('id',auth()->user()->id)->update([
            'token_absen' => $token
        ]);

        $data = AmbilMatkul::select('ambil_matkuls.id as id_ambil', 'matakuliahs.*','users.*')->join('users', 'users.id', '=', 'ambil_matkuls.id_users')->join('jadwal_matkuls', 'jadwal_matkuls.id', '=', 'ambil_matkuls.id_jadwal_matkul')->join('matakuliahs', 'matakuliahs.id', '=', 'jadwal_matkuls.id_matakuliah')->where('ambil_matkuls.id_users', auth()->user()->id)->where('ambil_matkuls.id', $id)->first();
        // auth()->user()->api_token = $token;
        // auth()->user()->save();

    
        // return view('qr_code', compact('qrCode'));

        return view('mahasiswa.krs.show', [
            'data' => $data,
            // 'qrCode' => $qrCode,
            'active' => 'krs'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        AmbilMatkul::where('id', $id)->delete();

        return redirect()->route('krs.index')->with('success', 'mata kuliah berhasil dihapus');
    }
}
