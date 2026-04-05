<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourceController; // Loyihangizdagi nomga ko'ra
use App\Http\Controllers\CareerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyCourceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Asosiy sahifa
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Tilni almashtirish
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ru', 'uz'])) {
        Session::put('locale', $locale);
        Session::save();
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('language.switch');

// 3. Profil (Faqat tizimga kirganlar uchun)
Route::middleware('auth')->group(function () {
    // Profil sahifasi
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    
    // Ism-familiyani yangilash (AJAX orqali PUT)
    Route::put('/profile/update', [ProfileController::class, 'putUpdate'])->name('profile.update');
    
    // Parolni yangilash (AJAX orqali PUT)
    Route::put('/profile/update-password', [ProfileController::class, 'putNewPassword'])->name('profile.update-password');
    
    // Avatarni yangilash (Rasm yuklash uchun POST yoki PUT)
    Route::put('/profile/update-avatar', [ProfileController::class, 'putUpdate'])->name('profile.update-avatar');
});

// 4. Kurslar yo'nalishlari (CourceController - imloga e'tibor bering)
Route::prefix('courses')->group(function () {
    Route::get('/python', [CourceController::class, 'python'])->name('courses.python');
    Route::get('/frontend', [CourceController::class, 'frontend'])->name('courses.frontend');
    Route::get('/backend', [CourceController::class, 'backend'])->name('courses.backend');
    Route::get('/cybersecurity', [CourceController::class, 'cybersecurity'])->name('courses.cybersecurity');
    Route::get('/computer-literacy', [CourceController::class, 'computerLiteracy'])->name('courses.computer_literacy');
    Route::get('/ai-developer', [CourceController::class, 'aiDeveloper'])->name('courses.ai_developer');

    // Yangi qo'shilgan kurslar
    Route::get('/algorithm', [CourceController::class, 'algorithm'])->name('courses.algorithm');
    Route::get('/office', [CourceController::class, 'office'])->name('courses.office');
    Route::get('/robotics', [CourceController::class, 'robotics'])->name('courses.robotics');
    Route::get('/digital-kids', [CourceController::class, 'digitalKids'])->name('courses.digital_kids');
    Route::get('/system-engineering', [CourceController::class, 'systemEngineering'])->name('courses.system_engineering');
    Route::get('/devops', [CourceController::class, 'devops'])->name('courses.devops');
    Route::get('/data-analytics', [CourceController::class, 'dataAnalytics'])->name('courses.data_analytics');
    Route::get('/network-admin', [CourceController::class, 'networkAdmin'])->name('courses.network_admin');
    Route::get('/accounting', [CourceController::class, 'accounting'])->name('courses.accounting');
});

// Ofis menejerligi uchun alohida view (agarda controllerda bo'lmasa)
Route::get('/kurs/ofis-menejerligi', function () {
    return view('courses.office-manager');
})->name('courses.office-manager');

// 5. Karyera (Career)
Route::get('/career', [CareerController::class, 'index'])->name('career.index');

// 6. Mening kurslarim (My Courses) - Dashboard qismi uchun
Route::prefix('my-courses')->middleware('auth')->group(function () {
    Route::get('/', [MyCourceController::class, 'index'])->name('my-courses.index');
    Route::post('/', [MyCourceController::class, 'store']);
    Route::get('/{id}', [MyCourceController::class, 'show']);
    Route::put('/{id}', [MyCourceController::class, 'update']);
    Route::delete('/{id}', [MyCourceController::class, 'destroy']);
    Route::post('/{courseId}/add-category', [MyCourceController::class, 'addCategory']);
    Route::delete('/delete-category/{categoryId}', [MyCourceController::class, 'deleteCategory']);
});

// Laravel Auth (Login, Register va h.k.)
require __DIR__.'/auth.php';