<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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
    return view('today');
});

Route::view('today', 'today')->name('today');

Route::middleware(['guest'])->group(function () {
    Volt::route('quotes', 'quotes')->middleware(['guest'])->name('quotes');
});

Route::middleware(['auth'])->group(function () {
    Volt::route('favorite-quotes', 'favorites-quotes')->name('favorite-quotes');
    Volt::route('secure-quotes', 'secure-quotes')->name('secure-quotes');
    Volt::route('report-favorite-quotes', 'report-favorite-quotes')->name('report-favorite-quotes');

    Route::view('profile', 'profile')->name('profile');
});

require __DIR__ . '/auth.php';
