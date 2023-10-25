<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
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
Route::post('login','App\Http\Controllers\DashboardController@login');
Route::get('logout','App\Http\Controllers\DashboardController@logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/dashboard/tasks', [TaskController::class, 'tasks']);
        Route::match(['get','post'],'/dashboard/tasks/new', [TaskController::class, 'newtask']);
        Route::post('/dashboard/tasks/manage',[TaskController::class, 'taskManage']);
        Route::get('tasks/files/{id?}',[TaskController::class, 'filesIndex']);
        Route::post('tasks/files/upload',[TaskController::class, 'fileUpload']);
});

        Route::match(['GET','POST'],'admin/login','App\Http\Controllers\AdminController@login');
        //Admin Group
        Route::group(['middleware'=>['admin']],function(){
            Route::get('admin/dashboard',[AdminController::class, 'dashboard']);
            Route::get('admin/dashboard/tasks',[AdminController::class, 'tasks']);
            Route::post('admin/dashboard/tasks/manage',[TaskController::class, 'taskManage']);
            Route::get('admin/dashboard/users',[AdminController::class, 'users']);
            Route::post('admin/dashboard/user/delete',[AdminController::class, 'userDelete']);
            Route::match(['get','post'],'admin/dashboard/user/new', [AdminController::class, 'newUser']);
            Route::get('admin/dashboard/admins',[AdminController::class, 'admins']);
            Route::post('admin/dashboard/admin/manage',[AdminController::class, 'adminManage']);
            Route::match(['get','post'],'admin/dashboard/admin/new', [AdminController::class, 'newAdmin']);
            Route::get('admin/users/tasks/{id}',[AdminController::class, 'userTasks']);
            Route::get('admin/tasks/files/{id?}',[TaskController::class, 'filesIndex']);
            Route::post('admin/tasks/files/upload',[TaskController::class, 'fileUpload']);
            Route::get('admin/logout',[AdminController::class, 'logout']);


        });

require __DIR__.'/auth.php';
