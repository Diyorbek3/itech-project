<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourceController; 
use App\Http\Controllers\CareerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyCourceController;
use App\Http\Controllers\FeedbackController;
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

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update-avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Feedback routelari
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
Route::get('/feedback/statistics', [FeedbackController::class, 'statistics'])->name('feedback.statistics');
Route::get('/user/{userId}/feedbacks', [FeedbackController::class, 'getUserFeedbacks'])->name('feedback.user');

// 5. Kurslar yo'nalishlari (CourceController bilan!)
Route::get('/courses/python', [CourceController::class, 'python'])->name('courses.python');
Route::get('/courses/frontend', [CourceController::class, 'frontend'])->name('courses.frontend');
Route::get('/courses/backend', [CourceController::class, 'backend'])->name('courses.backend');
Route::get('/courses/cybersecurity', [CourceController::class, 'cybersecurity'])->name('courses.cybersecurity');
Route::get('/courses/computer-literacy', [CourceController::class, 'computerLiteracy'])->name('courses.computer_literacy');
Route::get('/courses/ai-developer', [CourceController::class, 'aiDeveloper'])->name('courses.ai_developer');

// Yangi qo'shilgan kurslar
Route::get('/courses/algorithm', [CourceController::class, 'algorithm'])->name('courses.algorithm');
Route::get('/courses/office', [CourceController::class, 'office'])->name('courses.office');
Route::get('/courses/robotics', [CourceController::class, 'robotics'])->name('courses.robotics');
Route::get('/courses/digital-kids', [CourceController::class, 'digitalKids'])->name('courses.digital_kids');
Route::get('/courses/system-engineering', [CourceController::class, 'systemEngineering'])->name('courses.system_engineering');
Route::get('/courses/devops', [CourceController::class, 'devops'])->name('courses.devops');
Route::get('/courses/data-analytics', [CourceController::class, 'dataAnalytics'])->name('courses.data_analytics');
Route::get('/courses/network-admin', [CourceController::class, 'networkAdmin'])->name('courses.network_admin');
Route::get('/courses/accounting', [CourceController::class, 'accounting'])->name('courses.accounting');

// 6. Career route
Route::get('/career', [CareerController::class, 'index'])->name('career.index');

// 7. My courses routelari
Route::prefix('my-courses')->group(function () {
    Route::get('/', [MyCourceController::class, 'index'])->name('my-courses.index');
    Route::post('/', [MyCourceController::class, 'store'])->name('my-courses.store');
    Route::get('/{id}', [MyCourceController::class, 'show'])->name('my-courses.show');
    Route::put('/{id}', [MyCourceController::class, 'update'])->name('my-courses.update');
    Route::delete('/{id}', [MyCourceController::class, 'destroy'])->name('my-courses.destroy');
    Route::post('/{courseId}/add-category', [MyCourceController::class, 'addCategory'])->name('my-courses.add-category');
    Route::delete('/delete-category/{categoryId}', [MyCourceController::class, 'deleteCategory'])->name('my-courses.delete-category');
});

// Laravel Auth (Login, Register va h.k.)
require __DIR__.'/auth.php';

Route::get('/kurs/ofis-menejerligi', function () {
    return view('courses.office-manager');
})->name('courses.office-manager');

// 9. Auth routelari
require __DIR__.'/auth.php';

use App\Http\Controllers\MasterclassController;

// Masterclass routelari
Route::get('/masterclass/{id}/info', [MasterclassController::class, 'getInfo'])->name('masterclass.info');
Route::post('/masterclass/register', [MasterclassController::class, 'register'])->name('masterclass.register');