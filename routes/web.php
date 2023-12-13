<?php

use App\Models\Donut;
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
    $featured = Donut::query()->inRandomOrder()->limit(1)->first();

    return view('dashboard', [
        'featured' => $featured,
        'random' => Donut::query()->whereNot('id', $featured?->id)->inRandomOrder()->limit(3)->get(),
    ]);
})->name('home');

Volt::route('donuts', 'pages.donuts.index')
    ->name('donuts');

Volt::route('donuts/{donut}', 'pages.donuts.show')
    ->name('donuts.show');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('profile', 'profile')
        ->name('profile');

    Volt::route('my-donuts', 'pages.donuts.index-user')
        ->name('my-donuts');

    Volt::route('my-donuts/create', 'pages.donuts.edit')
        ->name('my-donuts.add');

    Volt::route('my-donuts/edit/{donut}', 'pages.donuts.edit')
        ->name('my-donuts.edit');

    Volt::route('my-donuts/favourites', 'pages.donuts.favourites')
        ->name('my-donuts.favourites');
});
