<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\FirstMiddleware;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [StoreController::class, 'index'])->name('index');
Route::get('/detail/{id}', [StoreController::class, 'detail'])->name('store.detail');
Route::get('/search', [StoreController::class, 'search'])->name('store.search');
Route::get('/login', [StoreController::class, 'index'])->middleware(['guest'])->name('login');

Route::post('/reserve/delete/{id}', [ReserveController::class, 'delete'])->name('reserve.delete');
Route::post('/done', [ReserveController::class, 'done'])->middleware('auth')->name('store.done');
Route::post('/reserve', [ReserveController::class, 'store'])->middleware('auth')->name('reserve.store');

Route::post('/favorites/add', [FavoriteController::class, 'add'])->middleware('auth')->name('favorites.add');
Route::post('/favorites/remove', [FavoriteController::class, 'remove'])->middleware('auth')->name('favorites.remove');
Route::match(['get', 'post'], '/favorites/toggle/{store_id}', [FavoriteController::class, 'toggle'])->middleware('auth')->name('favorites.toggle');

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware(['guest'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware(['guest'])->name('register');

Route::get('/mypage', [MypageController::class, 'mypage'])->name('mypage');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware(['guest'])->name('login');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

require __DIR__.'/auth.php';