<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AvatarController;

Route::get('/storage/avatars/{filename}', [AvatarController::class, 'show']);
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyCourceController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MasterClassController;
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
    Route::put('/profile/update-security', [ProfileController::class, 'putUpdateSecurity'])->name('profile.update-security');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------------------------------------------------------
// 3. KURSLAR BO'LIMI
// ---------------------------------------------------------
Route::prefix('courses')->group(function () {
    Route::get('/python', [CourseController::class, 'python'])->name('courses.python');
    Route::get('/frontend', [CourseController::class, 'frontend'])->name('courses.frontend');
    Route::get('/backend', [CourseController::class, 'backend'])->name('courses.backend');
    Route::get('/cybersecurity', [CourseController::class, 'cybersecurity'])->name('courses.cybersecurity');
    Route::get('/computer-literacy', [CourseController::class, 'computerLiteracy'])->name('courses.computer_literacy');
    Route::get('/ai-developer', [CourseController::class, 'aiDeveloper'])->name('courses.ai_developer');
    Route::get('/algorithm', [CourseController::class, 'algorithm'])->name('courses.algorithm');
    Route::get('/office', [CourseController::class, 'office'])->name('courses.office');
    Route::get('/robotics', [CourseController::class, 'robotics'])->name('courses.robotics');
    Route::get('/digital-kids', [CourseController::class, 'digitalKids'])->name('courses.digital_kids');
    Route::get('/system-engineering', [CourseController::class, 'systemEngineering'])->name('courses.system_engineering');
    Route::get('/devops', [CourseController::class, 'devops'])->name('courses.devops');
    Route::get('/data-analytics', [CourseController::class, 'dataAnalytics'])->name('courses.data_analytics');
    Route::get('/network-admin', [CourseController::class, 'networkAdmin'])->name('courses.network_admin');
    Route::get('/accounting', [CourseController::class, 'accounting'])->name('courses.accounting');
    
    Route::get('/ofis-menejerligi', function () {
        return view('courses.office-manager');
    })->name('courses.office-manager');
});

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

// ---------------------------------------------------------
// 4. FEEDBACK (FIKRLAR)
// ---------------------------------------------------------
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/feedbacks', [FeedbackController::class, 'index']);
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
Route::get('/feedback/statistics', [FeedbackController::class, 'statistics'])->name('feedback.statistics');
Route::get('/user/{userId}/feedbacks', [FeedbackController::class, 'getUserFeedbacks'])->name('feedback.user');

// ---------------------------------------------------------
// 5. KARYERA (Career) - MASTERCLASS
// ---------------------------------------------------------
Route::get('/career', [CareerController::class, 'index'])->name('career.index');

// Masterclass routes - CareerController orqali
Route::get('/masterclass/{id}', [CareerController::class, 'getMasterclass'])->name('masterclass.detail');
Route::post('/masterclass/register', [CareerController::class, 'registerForMasterclass'])->name('masterclass.register');

// ---------------------------------------------------------
// 6. MENING KURSLARIM (Dashboard/LMS)
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

Route::resource('courses', CourseController::class);
Route::get('/courses/table', [CourseController::class, 'tableRows'])->name('courses.table');

use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// ---------------------------------------------------------
// 7. MASTERCLASSLARNI BOSHQARISH (Admin)
// ---------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/master-class', [MasterClassController::class, 'adminIndex'])->name('master_class.admin_index');
    Route::get('/master-class', [MasterClassController::class, 'adminIndex'])->name('master_class.admin');
    Route::get('/master-class/create', [MasterClassController::class, 'create'])->name('master_class.create');
    Route::post('/master-class/store', [MasterClassController::class, 'store'])->name('master_class.store');
    Route::get('/master-class/{id}/edit', [MasterClassController::class, 'edit'])->name('master_class.edit');
    Route::put('/master-class/{id}/update', [MasterClassController::class, 'update'])->name('master_class.update');
    Route::delete('/master-class/{id}', [MasterClassController::class, 'destroy'])->name('master_class.destroy');
    
    Route::get('/masterclass/{id}/info', [MasterClassController::class, 'getInfo'])->name('masterclass.info');
    Route::post('/masterclass/register', [MasterClassController::class, 'register'])->name('masterclass.register');
});

// ---------------------------------------------------------
// 8. ALOQA (Contact) - ITech Academy uchun
// ---------------------------------------------------------
Route::post('/contact-send', [ContactController::class, 'sendContact'])->name('contact.send');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

// ========== KURSGA YOZILISH ROUTE (TELEGRAM BILAN) ==========
Route::post('/course-enroll', [CourseController::class, 'enrollSubmit'])->name('course.enroll');

// ---------------------------------------------------------
// 9. LARAVEL AUTH
// ---------------------------------------------------------
require __DIR__ . '/auth.php';

// Dashboard route
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::patch('/admin/masterclass-register/{id}/status', [DashboardController::class, 'updateStatus'])
        ->name('admin.masterclass.updateStatus');
    
    Route::get('/admin/masterclass-register/{id}', [DashboardController::class, 'showRegistration'])
        ->name('admin.masterclass.show');
});

Route::get('/get-topic-ids', function () {
    $token = '8675722709:AAEnyw1mPklG4czgs70Ei6bK3x2oX21Iq8E';
    $chatId = '-1003954939150';
    
    $response = Http::get("https://api.telegram.org/bot{$token}/getUpdates");
    
    $topics = [];
    if (isset($response['result'])) {
        foreach ($response['result'] as $update) {
            if (isset($update['message']['message_thread_id']) && isset($update['message']['chat']['id']) && $update['message']['chat']['id'] == $chatId) {
                $threadId = $update['message']['message_thread_id'];
                $text = $update['message']['text'] ?? '';
                $topics[$text] = $threadId;
            }
        }
    }
    
    return response()->json(['topics' => $topics]);
}); 