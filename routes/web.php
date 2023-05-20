<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsServicesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TechnicalsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RepairsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/', [LoginController::class, 'login'])->name('post-login');

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [RegisterController::class, 'store'])->name('register-user');

Route::get('/logout', function(){
    Session::flush();
    Auth::logout();

    return redirect()->route('login');
})->name('logout');

// * DASHBOARD ROUTES

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');


// * REPAIRS ROUTES

Route::get('/repairs', [RepairsController::class, 'index'])->name('dashboard-repairs')->middleware('auth');
// * TECHNICALS ROUTES

Route::get('/technicals', [TechnicalsController::class, 'index'])->name('dashboard-technicals')->middleware('auth');

// * SERVICES AND PRODUCTS ROUTES

Route::get('/services-products', [ProductsServicesController::class, 'index'])->name('dashboard-services_products')->middleware('auth');

// * SETTINGS ROUTES

Route::get('/settings', [SettingsController::class, 'index'])->name('dashboard-settings')->middleware('auth');