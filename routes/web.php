<?php

use App\Http\Controllers\CryptosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

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
    Route::post('/profile/update-balance', [ProfileController::class, 'updateBalance'])->middleware('auth')->name('profile.updateBalance');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
