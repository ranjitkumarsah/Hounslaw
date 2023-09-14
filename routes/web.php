<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;

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
Route::post('/cropImage', [MainController::class, 'cropImage'])->name('cropImage');

Route::post('details', [MainController::class, 'details'])->name('details');


Route::get('getDocTypes/{code}',[MainController::class,'getDocTypes'])->name('getDocTypes');

Route::post('/download-image',[MainController::class,'downloadImage']);
Route::post('/save-img-session',[MainController::class,'saveImageSession']);
Route::get('getDocumentSize/{code}',[MainController::class,'documentSize']);

Route::post('sendEmail',[HomeController::class,'sendEmail'])->name('sendEmail');
Route::post('stripePay',[PaymentController::class,'stripeCheckout'])->name('stripePay');
Route::get('stripe/checkout/success',[PaymentController::class,'stripeCheckoutSuccess'])->name('stripe.checkout.success');

Route::get('/choose-payment', [HomeController::class, 'choosePayment'])->name('choose-payment');
Route::get('/thank-you', [MainController::class, 'thankYou'])->name('thank-you');

Auth::routes(['verify' => true]);

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class,'index'])->name('admin.home');
    Route::get('getDocumentSize/{code}',[AdminController::class,'documentSize'])->name('documentSize');

    Route::post('documentSizeUpdate/{id}',[AdminController::class,'documentSizeUpdate'])->name('documentSizeUpdate');
    Route::get('/exportDocType',[AdminController::class,'exportDocType']);
    Route::post('/importDocTypeSize',[AdminController::class,'importDocTypeSize'])->name('importDocTypeSize');
});


