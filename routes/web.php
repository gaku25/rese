<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\FirstMiddleware;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [StoreController::class, 'index'])->middleware('auth')->name('index');
Route::post('/', [StoreController::class, 'index'])->middleware('auth');
Route::get('/detail/{id}', [StoreController::class, 'detail'])->name('store.detail')->middleware('web');
Route::post('/done', [ReserveController::class, 'done'])->name('store.done');
Route::get('/search', [StoreController::class, 'search'])->name('store.search');
Route::post('/reserve/delete/{id}', [ReserveController::class, 'delete'])->name('reserve.delete');

Route::post('/favorites/add', [FavoriteController::class, 'add'])->name('favorites.add');
Route::post('/favorites/remove', [FavoriteController::class, 'remove'])->name('favorites.remove');
Route::post('/favorites/toggle/{store_id}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
Route::post('/reserve/delete/{id}', [ReserveController::class, 'delete'])
    ->name('reserve.delete');
Route::post('/favorites/toggle/{store_id}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
Route::get('/mypage', [MypageController::class, 'mypage'])->middleware('auth')->name('mypage');

Route::post('/login', [StoreController::class, 'index'])->middleware(['guest'])->name('login');
Route::post('/reserve', [ReserveController::class, 'store'])->name('reserve.store');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');
Route::match(['get', 'post'], '/favorites/toggle/{store_id}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

require __DIR__.'/auth.php';