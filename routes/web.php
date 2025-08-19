<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MinatBakatController;
use App\Http\Controllers\HasilTesController;
use App\Http\Controllers\KategoriMinatController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\PilihanJawabanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatatanController;

/*
|---------------------------------------------------------------------------
| Web Routes - SIMBK
|---------------------------------------------------------------------------
|
| Ini adalah route utama untuk project Sistem Informasi Bimbingan Konseling (SIMBK).
|
*/

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('siswa', SiswaController::class);
    Route::resource('admin', adminController::class);
    Route::resource('admin', adminController::class);
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('schedule', ScheduleController::class);
    Route::resource('catatan', CatatanController::class);
    Route::get('schedule-json', [ScheduleController::class, 'getSchedules'])->name('schedule.json');
    Route::get('schedule/{id}/approve', [ScheduleController::class, 'approve'])->name('schedule.approve');
    Route::get('schedule/{id}/reject', [ScheduleController::class, 'reject'])->name('schedule.reject');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/formulir-minat-bakat', [MinatBakatController::class, 'create'])->name('minat-bakat.create');
    Route::get('/hasil-tes', [HasilTesController::class, 'index'])->name('hasil.index');
    Route::get('/hasil-tes/{user}', [HasilTesController::class, 'show'])->name('hasil.show');
    Route::post('/minat-bakat', [MinatBakatController::class, 'store'])->name('minat-bakat.store');
    Route::delete('/tes-minat-bakat', [MinatBakatController::class, 'destroy'])->name('minat-bakat.destroy');
    // Master Data Routes
    Route::resource('kategori-minat', KategoriMinatController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('soal', SoalController::class);
    Route::resource('pilihan-jawaban', PilihanJawabanController::class);
});

// // Halaman Welcome (default)
// Route::get('/', function () {
//     return view('welcome');
// });


// // Home setelah login default
// Route::get('/home', [HomeController::class, 'index'])->name('home');

// // Dashboard utama SIMBK, dilindungi oleh middleware 'auth' untuk pengguna yang terautentikasi
// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware('auth')
//     ->name('dashboard.index');

// // (Optional) Dashboard Test
// Route::get('/dashboard/test', [DashboardController::class, 'test'])
//     ->middleware('auth')
//     ->name('dashboard.test');

// // Routing untuk data SIMBK, dilindungi oleh middleware 'auth'
// Route::prefix('simbk')->middleware('auth')->group(function () {
//     Route::get('/', [SimbkDataController::class, 'index'])->name('simbk.index');
//     Route::get('/create', [SimbkDataController::class, 'create'])->name('simbk.create');
//     Route::post('/store', [SimbkDataController::class, 'store'])->name('simbk.store');
// });

// // Routing untuk login/logout siswa
// Route::prefix('siswa')->middleware('guest')->group(function () {
//     Route::get('login', [SiswaLoginController::class, 'showLoginForm'])->name('siswa.login');
//     Route::post('login', [SiswaLoginController::class, 'login']);
//     Route::post('logout', [SiswaLoginController::class, 'logout'])->name('siswa.logout');
// });

// // Routing untuk login/logout guru
// Route::prefix('guru')->middleware('guest')->group(function () {
//     Route::get('login', [GuruLoginController::class, 'showLoginForm'])->name('guru.login');
//     Route::post('login', [GuruLoginController::class, 'login']);
//     Route::post('logout', [GuruLoginController::class, 'logout'])->name('guru.logout');
// });

// // Routing untuk login/logout admin
// Route::prefix('admin')->middleware('guest')->group(function () {
//     Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('login', [AdminLoginController::class, 'login']);
//     Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
// });

// Route::get('/admin/tambah-siswa', function () {
//     return view ('layouts.admin.tambah-siswa');
// })->name('/admin/tambah-siswa');

// Route::get('/admin/tambah-guru', function () {
//     return view ('layouts.admin.tambah-guru');
// })->name('/admin/tambah-guru');

// Route::get('/admin/tambah-konseling', function () {
//     return view ('layouts.admin.tambah-konseling');
// })->name('/admin/tambah-konseling');

// Route::get('/admin/tambah-jadwal', function () {
//     return view ('layouts.admin.tambah-jadwal');
// })->name('/admin/tambah-');

// // routes/web.php
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
// });

// Route::middleware(['auth', 'role:guru'])->group(function () {
//     Route::get('/dashboard/guru', [DashboardController::class, 'guru'])->name('dashboard.guru');
// });

// Route::middleware(['auth', 'role:siswa'])->group(function () {
//     Route::get('/dashboard/siswa', [DashboardController::class, 'siswa'])->name('dashboard.siswa');
// });

// Route::get('/formulir', [App\Http\Controllers\FormulirController::class, 'index'])->name('formulir.index');
// Route::post('/formulir', [App\Http\Controllers\FormulirController::class, 'store'])->name('formulir.store');
// Route::get('/formulir/success', [App\Http\Controllers\FormulirController::class, 'success'])->name('formulir.success');
// Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
// Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
// Route::resource('siswa', SiswaController::class);
