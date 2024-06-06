<?php

use App\Livewire\CharityView;
use App\Livewire\Home;
use App\Livewire\WishlistEdit;
use App\Livewire\ThankYouPage;
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

Route::get('my-wishlist', WishlistView::class)
    ->name('my-wishlist');

Route::get('charities/{id}', CharityView::class)
    ->name('charity.show');

Route::get('wishlists/{id}', WishlistView::class)
    ->name('wishlist.show');

Route::get('wishlist-settings', WishlistEdit::class)
    ->name('wishlist.edit');
    
Route::get('thank-you', ThankYouPage::class)->name('thank-you');

require __DIR__.'/auth.php';
