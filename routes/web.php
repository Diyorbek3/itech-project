<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyCourceController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MasterClassController;
use App\Http\Controllers\CareerController; // CareerController qo'shildi
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ---------------------------------------------------------
// 1. ASOSIY SAHIFA VA TILNI BOSHQARISH
// ---------------------------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ru', 'uz'])) {
        Session::put('locale', $locale);
        Session::save();
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('language.switch');

// ---------------------------------------------------------
// 2. PROFIL VA SHAXSIY MA'LUMOTLAR
// ---------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'putUpdate'])->name('profile.update');
    Route::put('/profile/update-password', [ProfileController::class, 'putNewPassword'])->name('profile.update-password');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------------------------------------------------------
// 3. KURSLAR BO'LIMI
// ---------------------------------------------------------
Route::prefix('courses')->group(function () {
    Route::get('/python', [CourceController::class, 'python'])->name('courses.python');
    Route::get('/frontend', [CourceController::class, 'frontend'])->name('courses.frontend');
    Route::get('/backend', [CourceController::class, 'backend'])->name('courses.backend');
    Route::get('/cybersecurity', [CourceController::class, 'cybersecurity'])->name('courses.cybersecurity');
    Route::get('/computer-literacy', [CourceController::class, 'computerLiteracy'])->name('courses.computer_literacy');
    Route::get('/ai-developer', [CourceController::class, 'aiDeveloper'])->name('courses.ai_developer');
    Route::get('/algorithm', [CourceController::class, 'algorithm'])->name('courses.algorithm');
    Route::get('/office', [CourceController::class, 'office'])->name('courses.office');
    Route::get('/robotics', [CourceController::class, 'robotics'])->name('courses.robotics');
    Route::get('/digital-kids', [CourceController::class, 'digitalKids'])->name('courses.digital_kids');
    Route::get('/system-engineering', [CourceController::class, 'systemEngineering'])->name('courses.system_engineering');
    Route::get('/devops', [CourceController::class, 'devops'])->name('courses.devops');
    Route::get('/data-analytics', [CourceController::class, 'dataAnalytics'])->name('courses.data_analytics');
    Route::get('/network-admin', [CourceController::class, 'networkAdmin'])->name('courses.network_admin');
    Route::get('/accounting', [CourceController::class, 'accounting'])->name('courses.accounting');
    
    Route::get('/ofis-menejerligi', function () {
        return view('courses.office-manager');
    })->name('courses.office-manager');
});

// ---------------------------------------------------------
// 4. KARYERA (Career)
// ---------------------------------------------------------
Route::get('/career', [CareerController::class, 'index'])->name('career.index');

// ---------------------------------------------------------
// 5. MENING KURSLARIM (Dashboard/LMS)
// ---------------------------------------------------------
Route::prefix('my-courses')->middleware('auth')->group(function () {
    Route::get('/', [MyCourceController::class, 'index'])->name('my-courses.index');
    Route::post('/', [MyCourceController::class, 'store'])->name('my-courses.store');
    Route::get('/{id}', [MyCourceController::class, 'show'])->name('my-courses.show');
    Route::put('/{id}', [MyCourceController::class, 'update'])->name('my-courses.update');
    Route::delete('/{id}', [MyCourceController::class, 'destroy'])->name('my-courses.destroy');
    Route::post('/{courseId}/add-category', [MyCourceController::class, 'addCategory'])->name('my-courses.add-category');
    Route::delete('/delete-category/{categoryId}', [MyCourceController::class, 'deleteCategory'])->name('my-courses.delete-category');
});

// ---------------------------------------------------------
// 6. FEEDBACK
// ---------------------------------------------------------
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
Route::get('/feedback/statistics', [FeedbackController::class, 'statistics'])->name('feedback.statistics');
Route::get('/user/{userId}/feedbacks', [FeedbackController::class, 'getUserFeedbacks'])->name('feedback.user');

// ---------------------------------------------------------
// 7. MASTERCLASSLARNI BOSHQARISH
// ---------------------------------------------------------
// Umumiy foydalanish uchun
Route::get('/masterclass/{id}/info', [MasterClassController::class, 'getInfo'])->name('masterclass.info');
Route::post('/masterclass/register', [MasterClassController::class, 'register'])->name('masterclass.register');

// Admin qismi (Faqat tizimga kirganlar uchun)
Route::middleware(['auth'])->group(function () {
    Route::get('/master-class', [MasterClassController::class, 'adminIndex'])->name('master_class.admin');
    Route::get('/master-class/create', [MasterClassController::class, 'create'])->name('master_class.create');
    Route::post('/master-class/store', [MasterClassController::class, 'store'])->name('master_class.store');
    Route::get('/master-class/{id}/edit', [MasterClassController::class, 'edit'])->name('master_class.edit');
    Route::put('/master-class/{id}/update', [MasterClassController::class, 'update'])->name('master_class.update');
    Route::delete('/master-class/{id}', [MasterClassController::class, 'destroy'])->name('master_class.destroy');
});

// ---------------------------------------------------------
// 8. ALOQA (Contact)
// ---------------------------------------------------------
Route::post('/contact-send', [HomeController::class, 'sendToTelegram'])->name('contact.send');

// ---------------------------------------------------------
// 9. LARAVEL AUTH
// ---------------------------------------------------------
require __DIR__ . '/auth.php';