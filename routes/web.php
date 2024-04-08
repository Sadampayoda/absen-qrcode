<?php

use App\Http\Controllers\{AbsensiController, AjaxController, DashboardController, DosenController, JadwalMatkulController, JamController, KrsController, MatakuliahController, PengaturanController, PenilaianController, RuangController, SearchController, UserController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index',[
        'active' => '/'
    ]);
})->name('dashboard.index');
Route::get('/khs',[DashboardController::class,'khs'])->name('dashboard.khs');
Route::get('/transkip',[DashboardController::class,'transkip'])->name('dashboard.transkip');
Route::get('{token}/absensi/{id}',[DashboardController::class,'absensi'])->name('dashboard.absensi');
Route::get('{token}/cek/{id}',[DashboardController::class,'cek_qrcode'])->name('dashboard.cek');


Route::resource('user-manejement', UserController::class);
Route::middleware('auth')->group(function(){
    Route::resource('nilai', PenilaianController::class);
    Route::resource('absen', AbsensiController::class);
    Route::middleware('admin')->group(function(){
        Route::resource('pengaturan',PengaturanController::class);
        Route::resource('jam', JamController::class);
        Route::resource('ruang',RuangController::class);
        Route::resource('mata-kuliah',MatakuliahController::class);
        Route::resource('jadwal-matkul',JadwalMatkulController::class);
        Route::controller(SearchController::class)->group(function(){
            Route::get('/search/user','user')->name('search.user');
        });
    });

    Route::middleware('mahasiswa')->group(function(){
        Route::resource('krs',KrsController::class);
        Route::get('/select-krs',[AjaxController::class,'krs'])->name('krs.select');
    });

    Route::middleware('dosen')->group(function(){
        Route::controller(DosenController::class)->group(function(){
            Route::get('/jadwal-dosen','index')->name('jadwal-dosen');
            Route::get('/jadwal-dosen/show/{id}','show')->name('jadwal-dosen.show');
            Route::get('/jadwal-dosen/siswa/{id}','siswa')->name('jadwal-dosen.siswa');
            Route::get('/jadwal-dosen/absen/{name}/{id}','absensi')->name('jadwal-dosen.absensi');
            
        });
    });
    
});




Route::controller(DashboardController::class)->group(function(){
    Route::middleware('guest')->group(function(){
        Route::get('/login','login')->name('dashboard.login');
        Route::post('/login','authentication')->name('dashboard.authentication');
    });
    Route::middleware('auth')->group(function(){
        Route::get('/logout','logout')->name('dashboard.logout');
    });
});