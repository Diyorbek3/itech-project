<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;

Route::get('language/{locale}', function ($locale) {
    // Ruxsat etilgan tillar
    $availableLocales = ['en', 'ru', 'uz'];
    
    if (in_array($locale, $availableLocales)) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    
    return redirect()->back();
})->name('language.switch');


Route::auto('contact', HomeController::class);
Route::resource('contact', HomeController::class);



Route::post('/contact-send', [HomeController::class, 'sendToTelegram']);

Route::get('/', [HomeController::class, 'index']);
