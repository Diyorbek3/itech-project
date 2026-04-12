<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller
{
    /**
     * Bosh sahifa
     */
    public function index()
{
    try {
        // ->get() o'rniga ->paginate(6) ishlatamiz (har sahifada 6 ta master-klass)
        $masterClasses = DB::table('master_classes')
            ->orderBy('event_date', 'desc')
            ->paginate(6); 
            
    } catch (\Exception $e) {
        // Agar xato bo'lsa, bo'sh pagination obyektini qaytaramiz
        $masterClasses = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 6);
        Log::warning("Master classes xatolik: " . $e->getMessage());
    }

    return view('career.index', compact('masterClasses'));
}

    /**
     * Fikr-mulohazani saqlash - avval Telegramga, keyin MBga
     */
    public function storeFeedback(Request $request)
    {
        // 1. Ma'lumotlarni validatsiya qilish
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:5|max:5000'
        ], [
            'name.required' => 'Пожалуйста, укажите ваше имя',
            'name.max' => 'Имя не должно превышать 255 символов',
            'email.required' => 'Пожалуйста, укажите email',
            'email.email' => 'Введите корректный email адрес',
            'message.required' => 'Пожалуйста, введите текст отзыва',
            'message.min' => 'Отзыв должен содержать минимум 5 символов',
            'message.max' => 'Отзыв не должен превышать 5000 символов'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Ma'lumotlarni tayyorlash
        $validatedData = $validator->validated();

        // 3. AVVAL Telegramga yuboramiz
        $telegramResult = $this->sendToTelegram($validatedData);

        // 4. KEYIN bazaga saqlaymiz
        $feedbackId = $this->saveToDatabase($validatedData, $telegramResult, $request);

        if (!$feedbackId) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при сохранении отзыва в базу данных'
            ], 500);
        }

        // 5. Natijani qaytarish
        if ($telegramResult['success']) {
            return response()->json([
                'success' => true,
                'message' => 'Спасибо за ваш отзыв! Он успешно отправлен в Telegram и сохранен в базе данных.',
                'feedback_id' => $feedbackId,
                'telegram_sent' => true
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Спасибо за отзыв! Он сохранен в базе данных, но не был отправлен в Telegram (ошибка: ' . ($telegramResult['error'] ?? 'неизвестная ошибка') . ')',
                'feedback_id' => $feedbackId,
                'telegram_sent' => false,
                'telegram_error' => $telegramResult['error']
            ]);
        }
    }

    /**
     * Telegramga xabar yuborish
     */
    private function sendToTelegram($data)
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        if (empty($botToken) || empty($chatId)) {
            Log::error('Telegram credentials not configured');
            return [
                'success' => false,
                'error' => 'Telegram бот не настроен.'
            ];
        }

        $message = $this->formatTelegramMessage($data);

        try {
            $response = Http::timeout(10)->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true
            ]);

            $result = $response->json();

            if ($response->successful() && isset($result['ok']) && $result['ok'] === true) {
                return [
                    'success' => true,
                    'response' => json_encode($result),
                    'message_id' => $result['result']['message_id'] ?? null
                ];
            } else {
                return [
                    'success' => false,
                    'error' => $result['description'] ?? 'Unknown Telegram API error',
                    'response' => json_encode($result)
                ];
            }
        } catch (\Exception $e) {
            Log::error('Telegram send exception: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    private function formatTelegramMessage($data)
    {
        $userType = auth()->check() ? '👤 <b>Авторизованный пользователь</b>' : '👥 <b>Гость</b>';
        $userId = auth()->check() ? ' (ID: ' . auth()->id() . ')' : '';

        $message = "🔔 <b>НОВЫЙ ОТЗЫВ НА САЙТЕ</b> 🔔\n\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "📋 <b>ИНФОРМАЦИЯ ОБ ОТПРАВИТЕЛЕ</b>\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "{$userType}{$userId}\n";
        $message .= "📛 <b>Имя:</b> " . htmlspecialchars($data['name']) . "\n";
        $message .= "📧 <b>Email:</b> " . htmlspecialchars($data['email']) . "\n";
        $message .= "⏰ <b>Время:</b> " . date('d.m.Y H:i:s') . "\n\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "💬 <b>ТЕКСТ СООБЩЕНИЯ</b>\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= htmlspecialchars($data['message']) . "\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
        $message .= "📊 <b>Статус:</b> 🟢 Новый\n";
        $message .= "🌐 <b>Источник:</b> Сайт ITech Academy\n";

        return $message;
    }

    private function saveToDatabase($data, $telegramResult, $request)
    {
        try {
            return DB::table('tb_feedbacks')->insertGetId([
                'name' => $data['name'],
                'email' => $data['email'],
                'message' => $data['message'],
                'user_id' => auth()->check() ? auth()->id() : null,
                'telegram_sent' => $telegramResult['success'] ? 1 : 0,
                'telegram_response' => $telegramResult['response'] ?? null,
                'telegram_error' => $telegramResult['error'] ?? null,
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

    public function getAllFeedbacks()
    {
        try {
            $feedbacks = DB::table('tb_feedbacks')
                ->orderBy('created_at', 'desc')
                ->paginate(20);

            return response()->json(['success' => true, 'data' => $feedbacks]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ошибка при получении отзывов'], 500);
        }
    }

    public function getFeedback($id)
    {
        try {
            $feedback = DB::table('tb_feedbacks')->where('id', $id)->first();
            if (!$feedback) {
                return response()->json(['success' => false, 'message' => 'Отзыв не найден'], 404);
            }
            return response()->json(['success' => true, 'data' => $feedback]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ошибка'], 500);
        }
    }

    public function resendToTelegram($id)
    {
        try {
            $feedback = DB::table('tb_feedbacks')->where('id', $id)->first();
            if (!$feedback) {
                return response()->json(['success' => false, 'message' => 'Отзыв не найден'], 404);
            }

            $telegramResult = $this->sendToTelegram([
                'name' => $feedback->name,
                'email' => $feedback->email,
                'message' => $feedback->message
            ]);

            DB::table('tb_feedbacks')->where('id', $id)->update([
                'telegram_sent' => $telegramResult['success'] ? 1 : 0,
                'telegram_response' => $telegramResult['response'] ?? null,
                'telegram_error' => $telegramResult['error'] ?? null,
                'updated_at' => now()
            ]);

            return response()->json(['success' => $telegramResult['success'], 'message' => $telegramResult['success'] ? 'Успешно' : 'Ошибка']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getFeedbackStats()
    {
        try {
            return response()->json([
                'success' => true,
                'data' => [
                    'total' => DB::table('tb_feedbacks')->count(),
                    'telegram_sent' => DB::table('tb_feedbacks')->where('telegram_sent', 1)->count(),
                    'telegram_failed' => DB::table('tb_feedbacks')->where('telegram_sent', 0)->count(),
                    'today' => DB::table('tb_feedbacks')->whereDate('created_at', today())->count(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }

    public function deleteFeedback($id)
    {
        try {
            $deleted = DB::table('tb_feedbacks')->where('id', $id)->delete();
            return response()->json(['success' => (bool)$deleted]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }
}