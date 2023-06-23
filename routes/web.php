<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
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
Route::get('/', [StoreController::class, 'index']);
Route::post('/', [StoreController::class, 'index']);
Route::get('/detail/{id}', [StoreController::class, 'detail'])
    ->name('store.detail');
Route::get('/done', [StoreController::class, 'done']);
Route::get('/thanks', [StoreController::class, 'thanks']);
Route::get('/search', [StoreController::class, 'search'])
    ->name('store.search');

Route::post('/favorites/add', [FavoriteController::class, 'add'])
    ->name('favorites.add');
Route::post('/favorites/remove', [FavoriteController::class, 'remove'])
    ->name('favorites.remove');
Route::post('/favorites/toggle/{store_id}', [FavoriteController::class, 'toggle'])
    ->name('favorites.toggle');

Route::get('/mypage', [MypageController::class, 'mypage'])
    ->middleware('auth')
    ->name('mypage');

Route::post('/login', [StoreController::class, 'index'])
    ->middleware(['guest'])
    ->name('login');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware(['guest'])
    ->name('register');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

require __DIR__.'/auth.php';