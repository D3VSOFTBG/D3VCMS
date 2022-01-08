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

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', 'admin'])->group(function ()
{
    // GET
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin');
    Route::get('/admin/pages/users', [AdminController::class, 'users'])->name('admin.pages.users');

    // POST
    Route::post('/admin/pages/users/delete', [AdminController::class, 'user_delete'])->name('admin.pages.users.delete');
    Route::post('/admin/pages/users/edit', [AdminController::class, 'user_edit'])->name('admin.pages.users.edit');
    Route::post('/admin/pages/users/create', [AdminController::class, 'user_create'])->name('admin.pages.users.create');
});

Auth::routes(['verify' => true]);
