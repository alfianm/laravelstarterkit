<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\ProfileController;

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
Route::get('/dashboard', DashboardController::class)->name('dashboard');

// Roles dan Users
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

// Profile
Route::get('profile', [ProfileController::class,'index'])->name('profile.index');
Route::post('profile', [ProfileController::class,'update'])->name('profile.update');

// Backups
Route::resource('backups', BackupController::class)->only(['index','store','destroy']);
