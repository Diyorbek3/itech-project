<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourceController; // <-- BU CourceController (Course emas!)
use App\Http\Controllers\CareerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

// 1. Asosiy sahifa
Route::get('/', function () {
    return view('index');
})->name('home');

// 2. Tilni almashtirish
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ru', 'uz'])) {
        Session::put('locale', $locale);
        Session::save();
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('language.switch');

// 3. Profil (Auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update-avatar');
});

// 4. Kurslar yo'nalishlari (CourceController bilan!)
Route::get('/courses/python', [CourceController::class, 'python'])->name('courses.python');
Route::get('/courses/frontend', [CourceController::class, 'frontend'])->name('courses.frontend');
Route::get('/courses/backend', [CourceController::class, 'backend'])->name('courses.backend');
Route::get('/courses/cybersecurity', [CourceController::class, 'cybersecurity'])->name('courses.cybersecurity');
Route::get('/courses/computer-literacy', [CourceController::class, 'computerLiteracy'])->name('courses.computer_literacy');
Route::get('/courses/ai-developer', [CourceController::class, 'aiDeveloper'])->name('courses.ai_developer');

// ========== YANGI QO'SHILGAN KURSLAR ==========
Route::get('/courses/algorithm', [CourceController::class, 'algorithm'])->name('courses.algorithm');
Route::get('/courses/office', [CourceController::class, 'office'])->name('courses.office');
Route::get('/courses/robotics', [CourceController::class, 'robotics'])->name('courses.robotics');
Route::get('/courses/digital-kids', [CourceController::class, 'digitalKids'])->name('courses.digital_kids');
Route::get('/courses/system-engineering', [CourceController::class, 'systemEngineering'])->name('courses.system_engineering');
Route::get('/courses/devops', [CourceController::class, 'devops'])->name('courses.devops');
Route::get('/courses/data-analytics', [CourceController::class, 'dataAnalytics'])->name('courses.data_analytics');
Route::get('/courses/network-admin', [CourceController::class, 'networkAdmin'])->name('courses.network_admin');
Route::get('/courses/accounting', [CourceController::class, 'accounting'])->name('courses.accounting');


// 5. Career route
Route::get('/career', [CareerController::class, 'index'])->name('career.index');

// 6. Kursga yozilish route (CourceController bilan!)
Route::post('/enroll/submit', [CourceController::class, 'enrollSubmit'])->name('enroll.submit');
Route::post('/contact', [ContactController::class, 'send'])->name('contact-send');

require __DIR__.'/auth.php';
// routes/web.php
Route::get('/kurs/ofis-menejerligi', function () {
    return view('courses.office-manager');
})->name('courses.office-manager');