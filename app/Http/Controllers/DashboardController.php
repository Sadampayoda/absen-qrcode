<?php

namespace App\Http\Controllers;

use App\Models\AmbilMatkul;
use App\Models\Pengaturan;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function login()
    {
        return view('dashboard.login',[
            'active' => '/'
        ]);
    }

    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard.index');
        }

        return back()->with('error', 'Email dan Password anda salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function absen(Request $request)
    {
        dd($request);
    }

    public function absensi(Request $request)
    {
        // dd($request->all());
        // return 'alert';
        $data = AmbilMatkul::select('ambil_matkuls.id as id_ambil', 'matakuliahs.*','users.*','jams.*')->join('users', 'users.id', '=', 'ambil_matkuls.id_users')->join('jadwal_matkuls', 'jadwal_matkuls.id', '=', 'ambil_matkuls.id_jadwal_matkul')->join('matakuliahs', 'matakuliahs.id', '=', 'jadwal_matkuls.id_matakuliah')->join('ruangs', 'ruangs.id', '=', 'jadwal_matkuls.id_ruang')->join('jams', 'jams.id', '=', 'ruangs.id_jam')->where('ambil_matkuls.id_users', auth()->user()->id)->where('ambil_matkuls.id', $request->id)->first();

        if($request->token == null || $request->token != auth()->user()->token_absen )
        {
            return redirect()->back();
        }
        
        return view('absensi.index',[
            'data' => $data,
            'active' => '/',
        ]);
    }
    public function cek_qrcode(Request $request)
    {
        // dd($request->all());
        // return 'alert';
        $data = AmbilMatkul::select('ambil_matkuls.id as id_ambil', 'matakuliahs.*','users.*')->join('users', 'users.id', '=', 'ambil_matkuls.id_users')->join('jadwal_matkuls', 'jadwal_matkuls.id', '=', 'ambil_matkuls.id_jadwal_matkul')->join('matakuliahs', 'matakuliahs.id', '=', 'jadwal_matkuls.id_matakuliah')->where('ambil_matkuls.id_users', auth()->user()->id)->where('ambil_matkuls.id', $request->id)->first();

        if($request->token == null || $request->token != auth()->user()->token_absen )
        {
            $data = null;
        }
        
        return view('absensi.cek',[
            'data' => $data,
            'active' => '/',
            
        ]);
    }

    public function khs()
    {
        $sks = Semester::where('id_user',auth()->user()->id)->first();
        $data = AmbilMatkul::select('ambil_matkuls.id as id_ambil', 'matakuliahs.*','penilaians.nilai')->join('jadwal_matkuls', 'jadwal_matkuls.id', '=', 'ambil_matkuls.id_jadwal_matkul')->join('matakuliahs', 'matakuliahs.id', '=', 'jadwal_matkuls.id_matakuliah')->join('users', 'ambil_matkuls.id_users', '=', 'users.id')->join('semesters', 'semesters.id_user', '=', 'users.id')
        ->leftJoin('penilaians', 'penilaians.id_ambil_matkul', '=', 'ambil_matkuls.id')->where('ambil_matkuls.id_users', auth()->user()->id)->where('ambil_matkuls.periode',$sks->periode)->get();
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
        
        return view('mahasiswa.khs.index', [
            'data' => $data,
            'status' => $status,
            'active' => '/'
        ]);
    }
    public function transkip()
    {
        // $sks = Semester::where('id_user',auth()->user()->id)->first();
        $data = AmbilMatkul::select('ambil_matkuls.id as id_ambil', 'matakuliahs.*','penilaians.nilai')->join('jadwal_matkuls', 'jadwal_matkuls.id', '=', 'ambil_matkuls.id_jadwal_matkul')->join('matakuliahs', 'matakuliahs.id', '=', 'jadwal_matkuls.id_matakuliah')->join('users', 'ambil_matkuls.id_users', '=', 'users.id')->join('semesters', 'semesters.id_user', '=', 'users.id')
        ->join('penilaians', 'penilaians.id_ambil_matkul', '=', 'ambil_matkuls.id')->where('ambil_matkuls.id_users', auth()->user()->id)->get();
        
        
        return view('mahasiswa.transkip.index', [
            'data' => $data,
            // 'status' => $status,
            'active' => '/'
        ]);
    }


}
