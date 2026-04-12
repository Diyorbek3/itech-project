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
     * Главная страница
     */
    public function index()
    {
        return view('career.index');
    }


    /**
     * Сохранение отзыва - сначала в Telegram, потом в БД
     */
    public function storeFeedback(Request $request)
    {
        // 1. Валидация данных
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

        // 2. Подготовка данных
        $validatedData = $validator->validated();
        
        // 3. СНАЧАЛА отправляем в Telegram
        $telegramResult = $this->sendToTelegram($validatedData);
        
        // 4. ПОТОМ сохраняем в базу данных
        $feedbackId = $this->saveToDatabase($validatedData, $telegramResult, $request);
        
        if (!$feedbackId) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при сохранении отзыва в базу данных'
            ], 500);
        }
        
        // 5. Возвращаем результат
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
     * Отправка сообщения в Telegram
     */
    private function sendToTelegram($data)
    {
        // Настройки Telegram бота (можно вынести в .env)
        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');
        
        // Проверяем наличие настроек
        if (empty($botToken) || empty($chatId)) {
            Log::error('Telegram credentials not configured', [
                'bot_token_set' => !empty($botToken),
                'chat_id_set' => !empty($chatId)
            ]);
            
            return [
                'success' => false,
                'error' => 'Telegram бот не настроен. Пожалуйста, добавьте TELEGRAM_BOT_TOKEN и TELEGRAM_CHAT_ID в .env файл'
            ];
        }
        
        // Форматируем сообщение
        $message = $this->formatTelegramMessage($data);
        
        try {
            // Отправляем запрос к Telegram API
            $response = Http::timeout(10)->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true
            ]);
            
            $result = $response->json();
            
            // Проверяем успешность отправки
            if ($response->successful() && isset($result['ok']) && $result['ok'] === true) {
                Log::info('Telegram message sent successfully', [
                    'chat_id' => $chatId,
                    'message_id' => $result['result']['message_id'] ?? null
                ]);
                
                return [
                    'success' => true,
                    'response' => json_encode($result),
                    'message_id' => $result['result']['message_id'] ?? null
                ];
            } else {
                $errorMessage = $result['description'] ?? 'Unknown Telegram API error';
                Log::error('Telegram API error', [
                    'error' => $errorMessage,
                    'response' => $result
                ]);
                
                return [
                    'success' => false,
                    'error' => $errorMessage,
                    'response' => json_encode($result)
                ];
            }
            
        } catch (\Exception $e) {
            Log::error('Telegram send exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Форматирование сообщения для Telegram
     */
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
    
    /**
     * Сохранение в базу данных
     */
    private function saveToDatabase($data, $telegramResult, $request)
    {
        try {
            $feedbackId = DB::table('tb_feedbacks')->insertGetId([
                'name' => $data['name'],
                'email' => $data['email'],
                'message' => $data['message'],
                'user_id' => auth()->check() ? auth()->id() : null,
                'telegram_sent' => $telegramResult['success'] ? 1 : 0,
                'telegram_response' => isset($telegramResult['response']) ? $telegramResult['response'] : null,
                'telegram_error' => isset($telegramResult['error']) ? $telegramResult['error'] : null,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            Log::info('Feedback saved to database', [
                'feedback_id' => $feedbackId,
                'telegram_sent' => $telegramResult['success']
            ]);
            
            return $feedbackId;
            
        } catch (\Exception $e) {
            Log::error('Database save error', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            
            return false;
        }
    }
    
    /**
     * Получение всех отзывов (для админки)
     */
    public function getAllFeedbacks()
    {
        try {
            $feedbacks = DB::table('tb_feedbacks')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            
            return response()->json([
                'success' => true,
                'data' => $feedbacks
            ]);
            
        } catch (\Exception $e) {
            Log::error('Get feedbacks error', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении отзывов'
            ], 500);
        }
    }
    
    /**
     * Получение конкретного отзыва
     */
    public function getFeedback($id)
    {
        try {
            $feedback = DB::table('tb_feedbacks')->where('id', $id)->first();
            
            if (!$feedback) {
                return response()->json([
                    'success' => false,
                    'message' => 'Отзыв не найден'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $feedback
            ]);
            
        } catch (\Exception $e) {
            Log::error('Get feedback error', ['error' => $e->getMessage(), 'id' => $id]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении отзыва'
            ], 500);
        }
    }
    
    /**
     * Повторная отправка в Telegram (для неотправленных отзывов)
     */
    public function resendToTelegram($id)
    {
        try {
            // Получаем отзыв из базы
            $feedback = DB::table('tb_feedbacks')->where('id', $id)->first();
            
            if (!$feedback) {
                return response()->json([
                    'success' => false,
                    'message' => 'Отзыв не найден'
                ], 404);
            }
            
            // Подготавливаем данные для отправки
            $data = [
                'name' => $feedback->name,
                'email' => $feedback->email,
                'message' => $feedback->message
            ];
            
            // Отправляем в Telegram
            $telegramResult = $this->sendToTelegram($data);
            
            // Обновляем статус в базе данных
            DB::table('tb_feedbacks')
                ->where('id', $id)
                ->update([
                    'telegram_sent' => $telegramResult['success'] ? 1 : 0,
                    'telegram_response' => isset($telegramResult['response']) ? $telegramResult['response'] : null,
                    'telegram_error' => isset($telegramResult['error']) ? $telegramResult['error'] : null,
                    'updated_at' => now()
                ]);
            
            if ($telegramResult['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Отзыв успешно отправлен в Telegram'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Ошибка при отправке: ' . ($telegramResult['error'] ?? 'Неизвестная ошибка')
                ], 500);
            }
            
        } catch (\Exception $e) {
            Log::error('Resend to telegram error', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Получение статистики по отзывам
     */
    public function getFeedbackStats()
    {
        try {
            $total = DB::table('tb_feedbacks')->count();
            $telegramSent = DB::table('tb_feedbacks')->where('telegram_sent', 1)->count();
            $telegramFailed = DB::table('tb_feedbacks')->where('telegram_sent', 0)->count();
            $today = DB::table('tb_feedbacks')->whereDate('created_at', today())->count();
            $thisWeek = DB::table('tb_feedbacks')->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'total' => $total,
                    'telegram_sent' => $telegramSent,
                    'telegram_failed' => $telegramFailed,
                    'today' => $today,
                    'this_week' => $thisWeek
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Get stats error', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении статистики'
            ], 500);
        }
    }
    
    /**
     * Удаление отзыва
     */
    public function deleteFeedback($id)
    {
        try {
            $deleted = DB::table('tb_feedbacks')->where('id', $id)->delete();
            
            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Отзыв не найден'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Отзыв успешно удален'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Delete feedback error', ['error' => $e->getMessage(), 'id' => $id]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении отзыва'
            ], 500);
        }
    }
}





