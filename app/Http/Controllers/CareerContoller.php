<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\LengthAwarePaginator;

class CareerController extends Controller
{
    /**
     * Bosh sahifa (index method)
     */
    public function index()
    {
        try {
            // Masterclass'larni pagination bilan olish
            $masterClasses = DB::table('master_classes')
                ->orderBy('id', 'desc')
                ->paginate(6);
                
        } catch (\Exception $e) {
            // Agar xato bo'lsa, bo'sh pagination obyektini qaytaramiz
            $masterClasses = new LengthAwarePaginator([], 0, 6);
            Log::warning("Master classes xatolik: " . $e->getMessage());
        }

        return view('career.index', compact('masterClasses'));
    }

    /**
     * Fikr-mulohazani saqlash - Telegramga yuborish
     */
    public function storeFeedback(Request $request)
    {
        // 1. Ma'lumotlarni validatsiya qilish
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:5|max:5000'
        ], [
            'name.required' => 'Iltimos, ismingizni kiriting',
            'name.max' => 'Ism 255 ta belgidan oshmasligi kerak',
            'email.required' => 'Iltimos, email manzilingizni kiriting',
            'email.email' => 'To\'g\'ri email manzil kiriting',
            'message.required' => 'Iltimos, xabar matnini kiriting',
            'message.min' => 'Xabar kamida 5 ta belgidan iborat bo\'lishi kerak',
            'message.max' => 'Xabar 5000 ta belgidan oshmasligi kerak'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validatsiya xatoligi',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Ma'lumotlarni tayyorlash
        $validatedData = $validator->validated();

        // 3. Telegramga yuboramiz
        $telegramResult = $this->sendToTelegram($validatedData, 'feedback');

        // 4. Bazaga saqlaymiz
        $feedbackId = $this->saveToDatabase($validatedData, $telegramResult, $request);

        if (!$feedbackId) {
            return response()->json([
                'success' => false,
                'message' => 'Fikrni saqlashda xatolik yuz berdi'
            ], 500);
        }

        // 5. Natijani qaytarish
        if ($telegramResult['success']) {
            return response()->json([
                'success' => true,
                'message' => 'Fikringiz uchun rahmat! Xabaringiz Telegramga yuborildi.',
                'feedback_id' => $feedbackId
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Fikringiz uchun rahmat! Xabaringiz saqlandi.',
                'feedback_id' => $feedbackId
            ]);
        }
    }

    /**
     * Telegramga xabar yuborish
     */
    private function sendToTelegram($data, $type = 'feedback')
    {
        // Yangi bot token va chat ID
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        if (empty($botToken) || empty($chatId)) {
            Log::error('Telegram credentials not configured');
            return [
                'success' => false,
                'error' => 'Telegram bot sozlanmagan.'
            ];
        }

        // Xabar turiga qarab formatlash
        if ($type == 'feedback') {
            $message = $this->formatFeedbackMessage($data);
        } else {
            $message = $this->formatMasterclassMessage($data);
        }

        try {
            $response = Http::timeout(10)->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true
            ]);

            $result = $response->json();

            if ($response->successful() && isset($result['ok']) && $result['ok'] === true) {
                Log::info('Telegram message sent successfully');
                return [
                    'success' => true,
                    'message_id' => $result['result']['message_id'] ?? null
                ];
            } else {
                Log::error('Telegram API error: ' . json_encode($result));
                return [
                    'success' => false,
                    'error' => $result['description'] ?? 'Telegram API xatoligi'
                ];
            }
        } catch (\Exception $e) {
            Log::error('Telegram send exception: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Feedback xabarini formatlash
     */
    private function formatFeedbackMessage($data)
    {
        $userType = auth()->check() ? '👤 <b>Avtorizatsiya qilingan foydalanuvchi</b>' : '👥 <b>Mehmon</b>';
        $userId = auth()->check() ? ' (ID: ' . auth()->id() . ')' : '';

        $message = "🔔 <b>SAYTDAN YANGI FIKR-MULOHAZA</b> 🔔\n\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "📋 <b>JO'NATUVCHI MA'LUMOTLARI</b>\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "{$userType}{$userId}\n";
        $message .= "📛 <b>Ism:</b> " . htmlspecialchars($data['name']) . "\n";
        $message .= "📧 <b>Email:</b> " . htmlspecialchars($data['email']) . "\n";
        $message .= "⏰ <b>Vaqt:</b> " . date('d.m.Y H:i:s') . "\n\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "💬 <b>XABAR MATNI</b>\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= htmlspecialchars($data['message']) . "\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        $message .= "📊 <b>Holat:</b> 🟢 Yangi\n";
        $message .= "🌐 <b>Manba:</b> ITech Academy sayti\n";

        return $message;
    }

    /**
     * Masterclass xabarini formatlash
     */
    private function formatMasterclassMessage($data)
    {
        $userStatus = auth()->check() ? '✅ Avtorizatsiya qilingan' : '👤 Mehmon';
        $userId = auth()->check() ? ' (ID: ' . auth()->id() . ')' : '';

        $message = "🎓 <b>MASTERCLASSGA YANGI ARIZA</b> 🎓\n\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "📚 <b>MASTERCLASS MA'LUMOTLARI</b>\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "📖 <b>Nomi:</b> " . htmlspecialchars($data['masterclass_title']) . "\n";
        $message .= "📅 <b>Sana:</b> " . ($data['masterclass_date'] ?? 'Ko\'rsatilmagan') . "\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "👤 <b>ISHTIROKCHI MA'LUMOTLARI</b>\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "Holat: {$userStatus}{$userId}\n";
        $message .= "📛 <b>Ism:</b> " . htmlspecialchars($data['name']) . "\n";
        $message .= "📞 <b>Telefon:</b> " . htmlspecialchars($data['phone']) . "\n";
        $message .= "⏰ <b>Ariza vaqti:</b> " . date('d.m.Y H:i:s') . "\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        $message .= "📊 <b>Holat:</b> 🟢 Yangi\n";
        $message .= "🌐 <b>Manba:</b> ITech Academy sayti\n";

        return $message;
    }

    /**
     * Bazaga saqlash
     */
    private function saveToDatabase($data, $telegramResult, $request)
    {
        try {
            $tableName = 'tb_feedbacks';
            
            if (!Schema::hasTable($tableName)) {
                $tableName = 'feedbacks';
            }
            
            if (!Schema::hasTable($tableName)) {
                Log::warning("Table {$tableName} does not exist");
                return true;
            }
            
            return DB::table($tableName)->insertGetId([
                'name' => $data['name'],
                'email' => $data['email'],
                'message' => $data['message'],
                'user_id' => auth()->check() ? auth()->id() : null,
                'telegram_sent' => $telegramResult['success'] ? 1 : 0,
                'telegram_response' => $telegramResult['success'] ? 'Sent' : ($telegramResult['error'] ?? null),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } catch (\Exception $e) {
            Log::error('Database save error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Masterclass haqida ma'lumot olish (AJAX uchun)
     */
    public function getMasterclass($id)
    {
        try {
            $masterclass = DB::table('master_classes')->where('id', $id)->first();
            
            if (!$masterclass) {
                return response()->json(['error' => 'Masterclass topilmadi'], 404);
            }
            
            // Rasm URL'ini to'liq qilib qaytarish
            if ($masterclass->image && !str_starts_with($masterclass->image, 'http')) {
                $masterclass->image_url = asset('storage/' . $masterclass->image);
            } else {
                $masterclass->image_url = $masterclass->image ?? null;
            }
            
            return response()->json($masterclass);
        } catch (\Exception $e) {
            Log::error('Get masterclass error: ' . $e->getMessage());
            return response()->json(['error' => 'Xatolik yuz berdi'], 500);
        }
    }

    /**
     * Masterclassga ro'yxatdan o'tish (Telegramga yuborish)
     */
    public function registerForMasterclass(Request $request)
    {
        // 1. Validatsiya
        $validator = Validator::make($request->all(), [
            'masterclass_id' => 'required|integer',
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
        
        // 5. Bazaga saqlash (agar jadval mavjud bo'lsa)
        try {
            if (Schema::hasTable('masterclass_registrations')) {
                DB::table('masterclass_registrations')->insert([
                    'masterclass_id' => $request->masterclass_id,
                    'user_id' => auth()->check() ? auth()->id() : null,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'telegram_sent' => $telegramResult['success'] ? 1 : 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Masterclass registration save error: ' . $e->getMessage());
        }
        
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