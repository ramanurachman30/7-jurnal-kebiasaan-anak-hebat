<?php

use App\Http\Controllers\Web\GuestController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\WebOtherController;
use Illuminate\Support\Facades\Route;
use App\Routes\RouteNames;

//Route
//home

Route::controller(GuestController::class)
    ->group(function () {
        Route::get('/guest/{slug}', 'viewInvitation')->name('viewInvitation');
        Route::get('/qrcode/scanner', 'showScanner')->name('qrcode.scanner');
        Route::post('/qrcode/process', 'processQrCode')->name('qrcode.process');
        Route::get('/qrcode/listener', 'showListener')->name('qrcode.listener');
        Route::post('/invitation/{slug}/message', 'storeMessage')->name('invitation.storeMessage');
        Route::get('/invitation/{slug}/messages', 'getMessages')->name('invitation.getMessages');
    });

Route::get('/', [HomeController::class, 'index'])->name(RouteNames::HOME);
Route::get('/about-us', [HomeController::class, 'aboutUsPage'])->name('aboutUsPage');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/contact-us', [HomeController::class, 'contactus'])->name('contactus');
Route::get('/news-n-events', [HomeController::class, 'newsNEvents'])->name('newsNEvents');
Route::get('/detail-events', [HomeController::class, 'detailEvents'])->name('detailEvents');
Route::get('/detail-news', [HomeController::class, 'detailNews'])->name('detailNews');

