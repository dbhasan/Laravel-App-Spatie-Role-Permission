<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\HomeController;

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
Route::get('/', [HomeController::class, 'home'])->name('home');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'adminlogin'])->name('admin.login');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('role-index', [RoleController::class, 'indexrole'])->name('role.index');
    Route::get('role-insert', [RoleController::class, 'createrole'])->name('role.create');
    Route::post('role-insert', [RoleController::class, 'storerole'])->name('role.store');
    Route::get('role-update/{id}', [RoleController::class, 'editrole'])->name('role.edit');
    Route::put('role-update/{id}', [RoleController::class, 'updaterole'])->name('role.update');

    Route::get('user-index', [AuthController::class, 'indexuser'])->name('user.index');
    Route::get('user-insert', [AuthController::class, 'createuser'])->name('user.create');
    Route::post('user-insert', [AuthController::class, 'storeuser'])->name('user.store');
    Route::get('user-update/{id}', [AuthController::class, 'edituser'])->name('user.edit');
    Route::put('user-update/{id}', [AuthController::class, 'updateuser'])->name('user.update');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('profle-update', [AuthController::class, 'profileupdate'])->name('profle.update');
    Route::post('profle-update', [AuthController::class, 'passwordupdate'])->name('password.update');
});
