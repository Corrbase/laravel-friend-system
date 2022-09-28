<?php

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


Route::get('/friends', \App\Http\Controllers\FriendIndexController::class)->name('friends');

Route::get('/profile/{user}', \App\Http\Controllers\ProfileIndexController::class)->name('profile');



Route::post('/friends/{user_id}', [\App\Http\Controllers\FriendStoreController::class, 'friend'])->name('friends.store');
Route::delete('/friends/{user_id}', \App\Http\Controllers\FriendDestroyController::class)->name('friends.destroy');
Route::patch('/friends/{user_id}', \App\Http\Controllers\FriendPatchController::class)->name('friends.patch');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
