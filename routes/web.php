<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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

Route::get('/','App\Http\Controllers\DashboardController@index');
Route::post('login-register','App\Http\Controllers\DashboardController@loginRegister');
Route::get('logout','App\Http\Controllers\DashboardController@logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard/tasks', [TaskController::class, 'tasks']);
    Route::match(['get','post'],'/dashboard/tasks/new', [TaskController::class, 'newtask']);
    Route::post('/dashboard/tasks/manage',[TaskController::class, 'taskManage']);
});

require __DIR__.'/auth.php';
