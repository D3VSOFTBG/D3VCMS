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

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', 'admin'])->group(function ()
{
    // GET
    Route::get('/admin', [DashboardController::class, 'dashboard'])->name('admin');
    Route::get('/admin/pages/users', [UsersController::class, 'users'])->name('admin.pages.users');
    Route::get('/admin/pages/packages', [PackagesController::class, 'packages'])->name('admin.pages.packages');
    Route::get('/admin/pages/settings', [SettingsController::class, 'get'])->name('admin.pages.settings');
    Route::get('/admin/pages/developer', [DeveloperController::class, 'get'])->name('admin.pages.developer');

    // POST
    Route::post('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/admin/pages/users/delete', [UsersController::class, 'delete'])->name('admin.pages.users.delete');
    Route::post('/admin/pages/users/edit', [UsersController::class, 'edit'])->name('admin.pages.users.edit');
    Route::post('/admin/pages/users/create', [UsersController::class, 'create'])->name('admin.pages.users.create');
    Route::post('/admin/pages/settings', [SettingsController::class, 'post'])->name('admin.pages.settings');
    Route::post('/admin/pages/developer', [DeveloperController::class, 'post'])->name('admin.pages.developer');
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
