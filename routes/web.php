<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscribeController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

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
    auth()->loginUsingId(2);

    return view('twitter');
})->name('home');


Route::view('twitter', 'twitter')->name('twitter');
Route::get('subscribe', SubscribeController::class)
    ->name('subscribe')
    ->middleware([Authenticate::class]);

Route::get('verified-organization', \App\Http\Controllers\VerifiedOrganizationController::class)
    ->name('verified-organization')
    ->middleware([Authenticate::class]);

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
