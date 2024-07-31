<?php

use App\Http\Controllers\CryptosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/cryptos', [CryptosController::class,'index']);

Route::get('/cryptos/{name}', function ($name) {
    $crypto = CryptosController::coinBySymbol($name);
    return view('crypto',['crypto' => $crypto]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-currency', [ProfileController::class, 'updateCurrency'])->middleware('auth')->name('profile.updateCurrency');
    Route::post('/profile/update-balance', [ProfileController::class, 'updateBalance'])
        ->name('profile.updateBalance');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
