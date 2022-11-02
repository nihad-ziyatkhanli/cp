<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as C;
use App\Http\Livewire as L;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('cp')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', L\Dashboard\Index::class);

    Route::get('roles', L\Role\Index::class)->name('roles');
    Route::get('roles/create', L\Role\Create::class)->name('roles.create');
	Route::get('roles/{id}/update', L\Role\Update::class)->name('roles.update');

    Route::get('users', L\User\Index::class)->name('users');
    Route::get('users/create', L\User\Create::class)->name('users.create');
	Route::get('users/{id}/update', L\User\Update::class)->name('users.update');

});
