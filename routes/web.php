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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/cryptos/details', [CryptosController::class, 'showDetails'])->name('cryptos.details');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/', [ProfileController::class, 'updateCurrency'])->middleware('auth')->name('profile.updateCurrency');
    Route::post('/profile/', [ProfileController::class, 'updateBalance'])
        ->name('profile.updateBalance');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/crypto/{symbol}', [CryptosController::class, 'show'])->name('crypto.show');

});

require __DIR__.'/auth.php';
