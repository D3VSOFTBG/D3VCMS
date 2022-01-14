<?php

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

use App\Http\Controllers\Admin\CacheController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', 'admin'])->group(function ()
{
    // GET
    Route::get('/admin', [DashboardController::class, 'dashboard'])->name('admin');
    Route::get('/admin/pages/users', [AdminController::class, 'users'])->name('admin.pages.users');
    Route::get('/admin/pages/packages', [AdminController::class, 'packages'])->name('admin.pages.packages');
    Route::get('/admin/pages/settings', [AdminController::class, 'settings_get'])->name('admin.pages.settings');
    Route::get('/admin/pages/cache', [CacheController::class, 'get'])->name('admin.pages.cache');

    // POST
    Route::post('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/admin/pages/users/delete', [AdminController::class, 'user_delete'])->name('admin.pages.users.delete');
    Route::post('/admin/pages/users/edit', [AdminController::class, 'user_edit'])->name('admin.pages.users.edit');
    Route::post('/admin/pages/users/create', [AdminController::class, 'user_create'])->name('admin.pages.users.create');
    Route::post('/admin/pages/settings', [AdminController::class, 'settings_post'])->name('admin.pages.settings');
    Route::post('/admin/pages/cache', [CacheController::class, 'post'])->name('admin.pages.cache');
});

Auth::routes(['verify' => true]);

Route::middleware(['install'])->group(function ()
{
    // GET
    Route::get('/install', [InstallController::class, 'install_get'])->name('install');
    Route::get('/install/1', [InstallController::class, 'install_1_get'])->name('install.1');
    Route::get('/install/2', [InstallController::class, 'install_2_get'])->name('install.2');

    // POST
    Route::post('/install/1', [InstallController::class, 'install_1_post'])->name('install.1');
    Route::post('/install/2', [InstallController::class, 'install_2_post'])->name('install.2');
});
