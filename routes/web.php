<?php

use App\Livewire\CharityView;
use App\Livewire\Home;
use App\Livewire\WishlistView;
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

Route::get('/', Home::class)
    ->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('wishlist', WishlistView::class)
    ->name('wishlist');

Route::get('charities/{id}', CharityView::class)
    ->name('charity.show');

require __DIR__.'/auth.php';
