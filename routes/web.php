<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\OtentifikasiController;
use App\Http\Controllers\QuarterlyReportController;
use App\Http\Controllers\RefController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SemesterReportController;
use App\Http\Controllers\YearlyReportController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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

// Route::get('/', function () {
//     return view('dashboard');
// });
// Livewire::setScriptRoute(function($handle){
//     return Route::get('jempolan/public/livewire/livewire.js',$handle);
// });

// Livewire::setUpdateRoute(function($handle){
//     return Route::get('jempolan/public/livewire/update',$handle);
// });


Route::middleware('guest')->group(function(){
    Route::get('/login',[OtentifikasiController::class,'index'])->name('login');
    Route::post('/attemptlogin',[OtentifikasiController::class,'attemptLogin']);
});

Route::middleware('auth')->group(function(){
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/get_data_chart', 'getDataChart');
       
    });
    Route::controller(OtentifikasiController::class)->group(function () {
        Route::get('/logout', 'logout');
        Route::get('/daftar_akun', 'daftarAkun');
        Route::get('/get_daftar_akun', 'getDaftarAkun');
        Route::post('/insert_akun', 'insertAkun');
        Route::post('/edit_akun', 'editAkun');
        Route::post('/delete_akun', 'deleteAkun');

       
    });

    Route::controller(RefController::class)->group(function () {
        Route::get('/jenis_laporan', 'jenisLaporan');
        Route::get('/get_jenis_laporan', 'getJenisLaporan');
        Route::post('/ref/add_laporan', 'addLaporan');
        Route::post('/ref/edit_laporan', 'editLaporan');
        Route::post('/ref/delete_laporan', 'deleteLaporan');

       
    });
    Route::controller(ReportController::class)->group(function () {
        Route::get('report/mingguan/{unit}', 'mingguan');
        Route::get('/get_laporan_mingguan/{unit}', 'getLaporanMingguan');
        Route::post('/report/insert_laporan_mingguan', 'insertLaporanMingguan');
        Route::post('/report/edit_laporan_mingguan', 'editLaporanMingguan');
        Route::post('/report/delete_laporan_mingguan', 'deleteLaporanMingguan');
        
    });
    Route::controller(MonthlyReportController::class)->group(function () {
        Route::get('report/bulanan/{unit}', 'bulanan');
        Route::get('/get_laporan_bulanan/{unit}', 'getLaporanBulanan');
        Route::post('/report/insert_laporan_bulanan', 'insertLaporanBulanan');
        Route::post('/report/edit_laporan_bulanan', 'editLaporanBulanan');
        Route::post('/report/delete_laporan_bulanan', 'deleteLaporanBulanan');
        
    });
    Route::controller(QuarterlyReportController::class)->group(function () {
        Route::get('report/triwulan/{unit}', 'triwulan');
        Route::get('/get_laporan_triwulan/{unit}', 'getLaporanTriwulan');
        Route::post('/report/insert_laporan_triwulan', 'insertLaporanTriwulan');
        Route::post('/report/edit_laporan_triwulan', 'editLaporanTriwulan');
        Route::post('/report/delete_laporan_triwulan', 'deleteLaporanTriwulan');
        
    });
    Route::controller(SemesterReportController::class)->group(function () {
        Route::get('report/semester/{unit}', 'semester');
        Route::get('/get_laporan_semester/{unit}', 'getLaporanSemester');
        Route::post('/report/insert_laporan_semester', 'insertLaporanSemester');
        Route::post('/report/edit_laporan_semester', 'editLaporanSemester');
        Route::post('/report/delete_laporan_semester', 'deleteLaporanSemester');
        
    });
    Route::controller(YearlyReportController::class)->group(function () {
        Route::get('report/tahunan/{unit}', 'tahunan');
        Route::get('/get_laporan_tahunan/{unit}', 'getLaporanTahunan');
        Route::post('/report/insert_laporan_tahunan', 'insertLaporanTahunan');
        Route::post('/report/edit_laporan_tahunan', 'editLaporanTahunan');
        Route::post('/report/delete_laporan_tahunan', 'deleteLaporanTahunan');
        
    });
});
