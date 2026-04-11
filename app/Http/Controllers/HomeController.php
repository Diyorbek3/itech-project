<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Получаем отзывы для отображения на главной странице
        $feedbacks = $this->getFeedbacksForHomepage();
        
        return view('homepage', compact('feedbacks'));
    }

    /**
     * Получение отзывов для главной страницы
     */
    private function getFeedbacksForHomepage()
    {
        try {
            // Получаем отзывы с данными пользователей
            $feedbacks = DB::table('tb_feedbacks')
                ->leftJoin('users', 'tb_feedbacks.user_id', '=', 'users.id')
                ->select(
                    'tb_feedbacks.id',
                    'tb_feedbacks.name as feedback_name',
                    'tb_feedbacks.email',
                    'tb_feedbacks.message',
                    'tb_feedbacks.created_at',
                    'users.id as user_id',
                    'users.avatar as user_avatar',
                    'users.name as user_name',
                    'users.email as user_email'
                )
                ->where('tb_feedbacks.status', '!=', 'archived')
                ->orderBy('tb_feedbacks.created_at', 'desc')
                ->limit(10)
                ->get();
            
            // Форматируем данные для отображения
            $formattedFeedbacks = [];
            foreach ($feedbacks as $feedback) {
                // Исправляем проблему с датой
                $date = '';
                if ($feedback->created_at) {
                    try {
                        // Если created_at уже строка, преобразуем в Carbon
                        if (is_string($feedback->created_at)) {
                            $date = Carbon::parse($feedback->created_at)->format('d.m.Y');
                        } else {
                            $date = $feedback->created_at->format('d.m.Y');
                        }
                    } catch (\Exception $e) {
                        $date = date('d.m.Y');
                    }
                } else {
                    $date = date('d.m.Y');
                }
                
                // Если пользователь авторизован, берем его имя
                // Если нет, используем данные из формы обратной связи
                $name = $feedback->user_name ?? $feedback->feedback_name;
                
                $formattedFeedbacks[] = (object)[
                    'id' => $feedback->id,
                    'name' => $name,
                    'avatar' => $feedback->user_avatar,
                    'message' => $feedback->message,
                    'date' => $date
                ];
            }
            
            // Если отзывов меньше 3, добавляем демо-отзывы для заполнения слайдера
            if (count($formattedFeedbacks) < 3) {
                $formattedFeedbacks = array_merge($formattedFeedbacks, $this->getDemoFeedbacks());
            }
            
            return $formattedFeedbacks;
            
        } catch (\Exception $e) {
            Log::error('Error getting feedbacks for homepage', ['error' => $e->getMessage()]);
            return $this->getDemoFeedbacks();
        }
    }
    
 
    private function getDemoFeedbacks()
    {
        return [
            (object)[
                'id' => 0,
                'name' => 'Алексей Иванов',
                'avatar' => 'https://randomuser.me/api/portraits/men/1.jpg',
                'message' => 'Отличная академия! Прошел курс по веб-разработке, получил много практических знаний. Преподаватели профессионалы своего дела. Рекомендую!',
                'position' => 'Выпускник 2024',
                'date' => '15.03.2024'
            ],
            (object)[
                'id' => 0,
                'name' => 'Мария Петрова',
                'avatar' => 'https://randomuser.me/api/portraits/women/2.jpg',
                'message' => 'Очень довольна обучением в ITech Academy. Курсы актуальные, много практики. После окончания помогли с трудоустройством. Спасибо команде!',
                'position' => 'Frontend Developer',
                'date' => '20.02.2024'
            ],
            (object)[
                'id' => 0,
                'name' => 'Дмитрий Сидоров',
                'avatar' => 'https://randomuser.me/api/portraits/men/3.jpg',
                'message' => 'Лучшие курсы по Python в городе! Преподаватели объясняют сложные вещи простым языком. Материалы всегда актуальны. Огромное спасибо!',
                'position' => 'Backend Developer',
                'date' => '10.01.2024'
            ]
        ];
    }

    /**
     * API метод для получения отзывов (для AJAX подгрузки)
     */
    public function getFeedbacksApi(Request $request)
    {
        try {
            $limit = $request->get('limit', 10);
            $offset = $request->get('offset', 0);
            
            $feedbacks = DB::table('tb_feedbacks')
                ->leftJoin('users', 'tb_feedbacks.user_id', '=', 'users.id')
                ->select(
                    'tb_feedbacks.id',
                    'tb_feedbacks.name as feedback_name',
                    'tb_feedbacks.email as feedback_email',
                    'tb_feedbacks.message',
                    'tb_feedbacks.created_at',
                    'users.name as user_name',
                    'users.email as user_email'
                )
                ->where('tb_feedbacks.status', '!=', 'archived')
                ->orderBy('tb_feedbacks.created_at', 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get();
            
            $formattedFeedbacks = [];
            foreach ($feedbacks as $feedback) {
                // Исправляем проблему с датой в API
                $date = '';
                if ($feedback->created_at) {
                    try {
                        if (is_string($feedback->created_at)) {
                            $date = Carbon::parse($feedback->created_at)->format('d.m.Y');
                        } else {
                            $date = $feedback->created_at->format('d.m.Y');
                        }
                    } catch (\Exception $e) {
                        $date = date('d.m.Y');
                    }
                } else {
                    $date = date('d.m.Y');
                }
                
                $formattedFeedbacks[] = [
                    'id' => $feedback->id,
                    'name' => $feedback->user_name ?? $feedback->feedback_name,
                    'avatar' => $this->getDefaultAvatar($feedback->user_email ?? $feedback->feedback_email),
                    'message' => $feedback->message,
                    'position' => $feedback->user_id ? 'Наш студент' : 'Посетитель сайта',
                    'date' => $date
                ];
            }
            
            return response()->json([
                'success' => true,
                'data' => $formattedFeedbacks,
                'total' => DB::table('tb_feedbacks')->count()
            ]);
            
        } catch (\Exception $e) {
            Log::error('API get feedbacks error', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении отзывов'
            ], 500);
        }
    }

    public function sendToTelegram(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;
        Log::info("Received contact form submission: Name: $name, Email: $email, Message: $message");

        if (empty($name) || empty($email) || empty($message)) {
            return response()->json(['status' => 'error', 'message' => __('messages.error')], 400);
        }

        $token = env('TELEGRAM_BOT_TOKEN');
        $chat_id = env('TELEGRAM_CHAT_ID');

        $text = "🚀 *" . __('messages.new_request') . "*\n\n";
        $text .= "👤 *" . __('messages.name') . ":* " . $name . "\n";
        $text .= "📧 *" . __('messages.email') . ":* " . $email . "\n";
        $text .= "💬 *" . __('messages.message') . ":* " . $message . "\n\n";
        $text .= "⏰ *" . __('messages.time') . ":* " . now()->format('d.m.Y H:i');

        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chat_id,
            'parse_mode' => 'Markdown',
            'text' => $text,
        ]);

        return response()->json(['message' => __('messages.success')], 200);
    }
}