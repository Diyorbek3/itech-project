<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ContactController extends Controller
{
    public function sendContact(Request $request)
    {
        // Tilni olish
        $locale = App::getLocale();
        
        try {
            // Validation xatolarini o'zbek tilida chiqarish
            $validator = validator($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20|regex:/^\+998 \(\d{2}\) \d{3}-\d{2}-\d{2}$/'
            ], [
                'name.required' => __('messages.name_required'),
                'email.required' => __('messages.email_required'),
                'email.email' => __('messages.email_invalid'),
                'phone.required' => __('messages.phone_required'),
                'phone.regex' => __('messages.phone_invalid')
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }
            
            // Log faylga yozish
            \Log::info('Contact form submitted:', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'time' => now()
            ]);
            
            // Telegramga yuborish
            $token = "8586485983:AAF-7NhRKL72j3zXWUdznuHFv3rHCh1SIVc";
            $chatId = "-1003836558266";
            $text = "🆕 YANGI ARIZA!\n\n👤 Ism: " . $request->name . "\n📧 Email: " . $request->email . "\n📞 Telefon: " . $request->phone;
            $url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chatId}&text=" . urlencode($text);
            file_get_contents($url);
            
            return response()->json([
                'success' => true,
                'message' => __('messages.application_received')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('messages.validation_error') . ' ' . $e->getMessage()
            ], 500);
        }

    }
    /**
 * Masterclassga ro'yxatdan o'tish (Telegramga yuborish + DB saqlash)
 */
public function registerForMasterclass(Request $request)
{
    // 1. Validatsiya
    $validator = Validator::make($request->all(), [
        'masterclass_id' => 'required|integer|exists:master_classes,id',
        'name' => 'required|string|min:2|max:255',
        'phone' => 'required|string|min:9|max:20'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Ma\'lumotlarni to\'g\'ri kiriting',
            'errors' => $validator->errors()
        ], 422);
    }

    // 2. Masterclass ma'lumotlarini olish
    $masterclass = DB::table('master_classes')->where('id', $request->masterclass_id)->first();
    
    if (!$masterclass) {
        return response()->json([
            'success' => false,
            'message' => 'Masterclass topilmadi'
        ], 404);
    }
    
    // 3. Telegramga yuborish uchun ma'lumot tayyorlash
    $telegramData = [
        'name' => $request->name,
        'phone' => $request->phone,
        'masterclass_title' => $masterclass->title,
        'masterclass_date' => $masterclass->event_date ?? $masterclass->date ?? 'Ko\'rsatilmagan'
    ];
    
    // 4. Telegramga yuborish
    $telegramResult = $this->sendToTelegram($telegramData, 'masterclass');
    
    // 5. Bazaga saqlash (✅ TO'G'RILANGAN)
    try {
        // Jadval mavjudligini tekshirish
        if (!Schema::hasTable('masterclass_registrations')) {
            Log::error('masterclass_registrations jadvali mavjud emas!');
            return response()->json([
                'success' => false,
                'message' => 'Jadval mavjud emas. Iltimos, migratsiyani ishga tushiring.'
            ], 500);
        }
        
        // Ma'lumotni saqlash
        $registrationId = DB::table('masterclass_registrations')->insertGetId([
            'masterclass_id' => $request->masterclass_id,
            'user_id' => auth()->check() ? auth()->id() : null,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email ?? null,
            'telegram_sent' => $telegramResult['success'] ? 1 : 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        Log::info('Masterclass registration saved. ID: ' . $registrationId);
        
    } catch (\Exception $e) {
        Log::error('Masterclass registration save error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Ma\'lumotni saqlashda xatolik: ' . $e->getMessage()
        ], 500);
    }
    
    // 6. Natija qaytarish
    if ($telegramResult['success']) {
        return response()->json([
            'success' => true,
            'message' => 'Siz muvaffaqiyatli ro\'yxatdan o\'tdingiz! Tez orada siz bilan bog\'lanamiz.'
        ]);
    } else {
        return response()->json([
            'success' => true,
            'message' => 'Arizangiz qabul qilindi.'
        ]);
    }
}
}