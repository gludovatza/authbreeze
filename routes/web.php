<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('user_dashboard');
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::get('/admin-dashboard', function () {
    return view('admin_dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('admin_dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// user middleware-hez tartozó útvonalaink
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    // 1. user útvonal regisztrációja
	// 2. user útvonal regisztrációja
	// ...
	// utolsó user útvonal regisztrációja
});

// admin middleware-hez tartozó útvonalaink
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    // 1. admin útvonal regisztrációja
    // 2. admin útvonal regisztrációja
	// ...
	// utolsó admin útvonal regisztrációja
});

require __DIR__.'/auth.php';
