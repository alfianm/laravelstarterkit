<?php

use App\Http\Controllers\Backend\BackupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
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

// Security
Route::get('profile/security', [ProfileController::class, 'changePassword'])->name('profile.password.change');
Route::post('profile/security', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

// Pages
Route::resource('pages', PageController::class)->except(['show']);

// Backups
Route::resource('backups', BackupController::class)->only('index','store','destroy');
Route::get('backups/{file_name}',[BackupController::class,'download'])->name('backups.download');
Route::delete('backups/clean',[BackupController::class,'clean'])->name('backups.clean');
