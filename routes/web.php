<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\MahasiswaAbsensiController; 
use App\Http\Controllers\profileController; 
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DevisiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\ProfileMahasiswaController;
use App\Http\Controllers\PermintaanMagangController;
use App\Http\Controllers\RegistrationController;
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
        "title" => "Pendaftaran Magang"
    ]);
});

// from pendaftaran
Route::get('/registration', [RegistrationController::class, 'showForm'])->name('registration.show');
Route::post('/registration', [RegistrationController::class, 'submitForm'])->name('registration.submit');





//route login dan logout
Route::middleware(['guest'])->group(function () {
    
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);
});



// route admin
 Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    //  dashboard
    Route::get('/dashboard', [DashboardController::class, 'admin']);

    // mahasiswa
    Route::resource('/mahasiswa', MahasiswaController::class);

    // Devisi Pegawai (devisi admin)
    Route::resource('/devisi', DevisiController::class);

    // admin
    Route::resource('/data-admin', AdminController::class)->parameters([
        "data-admin" => "admin"
    ]);
    
    
    // userrr
    // show user mahasiswa 
    Route::get('/users/mahasiswa/show/{user:id}', [UserController::class, 'show'])->name('users.mahasiswa.show');
    
    //create user mahasiswa & admin
    Route::get('/users/create/admin', [UserController::class, 'createAdmin'])->name('users.admin.create');
    Route::get('/users/create/mahasiswa', [UserController::class, 'createMahasiswa'])->name('users.mahasiswa.create');

    //password
    Route::get('/users/{user:id}/change-password', [UserController::class, 'editPassword'])->name('users.editPassword');
    Route::put('/users/{user:id}/update-password', [UserController::class, 'updatePassword'])->name('users.updatePassword');

     // user resource
    Route::resource('/users', UserController::class)->except('create');
    // ----------------------------------------
    
    //profile
    
    Route::get('/profile/{admin:nip}/edit', [profileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile/{admin:nip}', [profileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile/{admin:nip}', [profileController::class, 'destroy'])->name('admin.profile.destroy');
    
    Route::resource('/profile', profileController::class);
    
   
    // absensi
 
    Route::resource('/absensi', AbsensiController::class)->except('show', 'create' ,'edit');

    Route::get('/absensi/absen-today', [AbsensiController::class, 'ShowToday'])->name('admin.absensi.today');
    Route::get('/absensi/{mahasiswa:nim_nisn}', [AbsensiController::class, 'show'])->name('admin.absensi.show');
    Route::get('/absensi/create/{mahasiswa:nim_nisn}', [AbsensiController::class, 'create'])->name('admin.absensi.create');
    Route::get('/absensi/edit/{absensi:id}', [AbsensiController::class, 'edit'])->name('admin.absensi.edit');

    //permintaan magang
    Route::resource('/permintaan-magang', PermintaanMagangController::class);

    Route::get('/accept/{permintaan_magang:nim_nisn}', [PermintaanMagangController::class, 'accept'])->name('accept');

    
 });



// ////////////////////////////////////////////////////////////////////////////////////////////////////////




// route mahasiswa
Route::prefix('mahasiswa')->middleware(['auth', 'mahasiswa'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');

    Route::resource('/absensi-mahasiswa', MahasiswaAbsensiController::class)->except('show');

    Route::resource('/jurnal', JurnalController::class);

    Route::resource('/profile-mahasiswa', ProfileMahasiswaController::class);

    
   
});









