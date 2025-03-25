<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmatController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\TausiyahController;
use App\Models\Tausiyah;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// Route::get('/', function () {
//     return view('dashboard');
// });


Route::middleware(['auth'])->group(function () {
Route::middleware(['admin'])->group(function () {
    //user
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/pdf', [App\Http\Controllers\UserController::class, 'pdf'])->name('user.pdf');
    // Umat
    Route::resource('umats', UmatController::class);
});



    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('absensis', AbsensiController::class);
    Route::resource('tausiyahs', TausiyahController::class);
    Route::get('/halaqoh/create', [TausiyahController::class, 'create'])->middleware('auth');
    Route::post('/halaqoh/store', [TausiyahController::class, 'store'])->middleware('auth');
});
