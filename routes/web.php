<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\DashboardController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin','middleware'=>['auth:admin']],function(){
    Route::get('/',[DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/roles', RolesController::class);
    Route::resource('/users', UsersController::class);
});

Route::group(['prefix'=>'admin'],function(){
  //login route
    Route::get('/login',[LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login/submit',[LoginController::class, 'login'])->name('admin.login.submit');
    // logout route
    Route::post('/logout/submit',[LoginController::class, 'logout'])->name('admin.logout.submit');
    // forget password route
    Route::get('/password/reset',[ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('/password/reset',[ResetPasswordController::class, 'reset'])->name('admin.password.update');

});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
