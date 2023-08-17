<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;

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


Route::get('/', [MainController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('details', [MainController::class, 'details'])->name('details');
Route::get('/thank-you', [MainController::class, 'thankYou'])->name('thank-you');

Route::get('getDocTypes/{code}',[MainController::class,'getDocTypes'])->name('getDocTypes');

Route::post('/save-img-session',[MainController::class,'saveImageSession']);


Auth::routes(['verify' => true]);

Route::get('/choose-payment', [HomeController::class, 'choosePayment'])->name('choose-payment');


