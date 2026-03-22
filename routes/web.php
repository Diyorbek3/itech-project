<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourceController; 
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Kurslar yo'nalishlari
Route::get('/courses/python', [CourceController::class, 'python'])->name('courses.python');
Route::get('/courses/frontend', [CourceController::class, 'frontend'])->name('courses.frontend');
Route::get('/courses/backend', [CourceController::class, 'backend'])->name('courses.backend');
Route::get('/courses/cybersecurity', [CourceController::class, 'cybersecurity'])->name('courses.cybersecurity');
Route::get('/courses/computer-literacy', [CourceController::class, 'computerLiteracy'])->name('courses.computer_literacy');
Route::get('/courses/ai-developer', [CourceController::class, 'aiDeveloper'])->name('courses.ai_developer');

// 5. Career route
Route::get('/career', [CareerController::class, 'index'])->name('career.index');

require __DIR__.'/auth.php';