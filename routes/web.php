<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified', 'is_active.user'])->name('dashboard');

Route::prefix('users')->group(function() {
    Route::get('/create', [UserController::class, 'create'])->name('users.create')->middleware('store.user');
    Route::post('/create', [UserController::class, 'store'])->name('users.store')->middleware('store.user');
    Route::get('/{user:id}/edit', [UserController::class, 'editPassword'])->name('users.editPassword')->middleware('update.user');
    Route::put('/{user:id}/update', [UserController::class, 'updatePassword'])->name('users.updatePassword')->middleware('update.user');

    Route::put('/{user:id}/active', [UserController::class, 'active'])->name('users.active')->middleware('deactive.user');
    Route::put('/{user:id}/deactive', [UserController::class, 'deactive'])->name('users.deactive')->middleware('deactive.user');
    Route::delete('/{user:id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('delete.user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
