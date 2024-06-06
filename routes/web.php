<?php

use App\Http\Controllers\FilterTasks;
use App\Http\Controllers\TodoController;
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

Route::get('/', [TodoController::class, 'index'])->name('home')->middleware('auth');

Route::prefix('filter')->name('filter.')->group(function (){
    Route::get('/recycle', [FilterTasks::class, 'recycle'])->name('recycle');
//    Route::delete('/recycle', [::class, 'foreverDelete'])->name('delete');
    Route::get('/completed', [FilterTasks::class, 'completed'])->name('completed');
    Route::get('/pending', [FilterTasks::class, 'pending'])->name('pending');
    Route::get('/expired', [FilterTasks::class, 'expired'])->name('expired');
    Route::get('/planned', [FilterTasks::class, 'planned'])->name('planned');
    Route::get('/today-tasks', [FilterTasks::class, 'today'])->name('today');
});

/**
 * For authentication of users
*/
Route::get('/login',[\App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::get('/logout',[\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
Route::post('/login',[\App\Http\Controllers\UserController::class, 'log']);
Route::get('/register',[\App\Http\Controllers\UserController::class, 'registerForm'])->name('register');
Route::post('/register',[\App\Http\Controllers\UserController::class, 'register']);

Route::prefix('todo')->group(function (){
    Route::resource('task', TodoController::class);
});
