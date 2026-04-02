<?php
// app/Http/Controllers/FeedbackController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    // Telegram bot configuration
    private $telegramBotToken;
    private $telegramChatId;
    
    public function __construct()
    {
 
        $this->telegramBotToken = env('TELEGRAM_BOT_TOKEN_FOR_FEEDBACKS', '');
        $this->telegramChatId = env('TELEGRAM_CHAT_ID_FOR_FEEDBACKS', '');
    }
    
   
    public function store(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string|min:10'
        ]);
        
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }
        
        try {
            // Begin transaction
            DB::beginTransaction();
            
            $userId = auth()->user()->id;
            
            // Insert feedback into database
            $feedbackId = DB::table('tb_feedbacks')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'created_by' => $userId, // Store user ID
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            // Get the inserted feedback with user info
            $feedback = DB::table('tb_feedbacks')
                ->where('id', $feedbackId)
                ->first();
            
            // Get user info if user is authenticated
            $userInfo = null;
            if ($userId) {
                $userInfo = DB::table('users')->where('id', $userId)->first();
            }
            
            // Send to Telegram
            $telegramSent = $this->sendToTelegram($feedback, $userInfo);
            
            DB::commit();
            
            $message = 'Спасибо за ваш отзыв!';
            if ($telegramSent) {
                $message .= ' Ваш отзыв отправлен администратору.';
            }
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'data' => [
                        'id' => $feedbackId,
                        'user_id' => $userId
                    ]
                ], 200);
            }
            
            return back()->with('success', $message);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Произошла ошибка при сохранении отзыва: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Произошла ошибка при сохранении отзыва');
        }
    }
    
    /**
     * Send feedback to Telegram
     */
    private function sendToTelegram($feedback, $userInfo = null)
    {
        // Check if bot token and chat id are configured
        if (empty($this->telegramBotToken) || empty($this->telegramChatId)) {
            return false;
        }
        
        try {
            // Format message for Telegram
            $message = "🔔 <b>Новый отзыв от студента!</b> 🔔\n\n" .
                       "👤 <b>Имя:</b> " . htmlspecialchars($feedback->name) . "\n" .
                       "📧 <b>Email:</b> " . htmlspecialchars($feedback->email) . "\n";
            
            // Add user info if available
            if ($userInfo) {
                $message .= "🆔 <b>ID пользователя:</b> " . $feedback->created_by . "\n";
                if (!empty($userInfo->phone)) {
                    $message .= "📱 <b>Телефон:</b> " . htmlspecialchars($userInfo->phone) . "\n";
                }
                if (!empty($userInfo->role)) {
                    $message .= "👔 <b>Роль:</b> " . htmlspecialchars($userInfo->role) . "\n";
                }
            } elseif ($feedback->created_by) {
                $message .= "🆔 <b>ID пользователя:</b> " . $feedback->created_by . "\n";
            } else {
                $message .= "👤 <b>Статус:</b> Гость (не авторизован)\n";
            }
            
            $message .= "💬 <b>Сообщение:</b>\n" . htmlspecialchars($feedback->message) . "\n\n" .
                       "🕐 <b>Дата:</b> " . date('d.m.Y H:i:s', strtotime($feedback->created_at));
            
            // Send to Telegram
            $response = Http::post("https://api.telegram.org/bot{$this->telegramBotToken}/sendMessage", [
                'chat_id' => $this->telegramChatId,
                'text' => $message,
                'parse_mode' => 'HTML'
            ]);
            
            return $response->successful();
            
        } catch (\Exception $e) {
            \Log::error('Telegram send error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Get all feedbacks with user info (for admin panel)
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');
            
            $feedbacks = DB::table('tb_feedbacks')
                ->leftJoin('users', 'tb_feedbacks.created_by', '=', 'users.id')
                ->select(
                    'tb_feedbacks.*',
                    'users.name as user_name',
                    'users.email as user_email',
                    'users.phone as user_phone',
                    'users.role as user_role'
                )
                ->orderBy($sortBy, $sortOrder)
                ->paginate($perPage);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'data' => $feedbacks
                ], 200);
            }
            
            return view('admin.feedbacks', compact('feedbacks'));
            
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ошибка при получении отзывов'
                ], 500);
            }
            return back()->with('error', 'Ошибка при получении отзывов');
        }
    }
    
    /**
     * Get feedbacks by user ID
     */
    public function getUserFeedbacks($userId, Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
            
            $feedbacks = DB::table('tb_feedbacks')
                ->where('created_by', $userId)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
            
            return response()->json([
                'success' => true,
                'data' => $feedbacks
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении отзывов пользователя'
            ], 500);
        }
    }
    
    /**
     * Delete feedback
     */
    public function destroy($id, Request $request)
    {
        try {
            $feedback = DB::table('tb_feedbacks')->where('id', $id)->first();
            
            if (!$feedback) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Отзыв не найден'
                    ], 404);
                }
                return back()->with('error', 'Отзыв не найден');
            }
            
            $deleted = DB::table('tb_feedbacks')
                ->where('id', $id)
                ->delete();
            
            if ($deleted) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Отзыв успешно удален'
                    ], 200);
                }
                return back()->with('success', 'Отзыв успешно удален');
            } else {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Не удалось удалить отзыв'
                    ], 500);
                }
                return back()->with('error', 'Не удалось удалить отзыв');
            }
            
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ошибка при удалении отзыва'
                ], 500);
            }
            return back()->with('error', 'Ошибка при удалении отзыва');
        }
    }
    
    /**
     * Get feedback statistics
     */
    public function statistics()
    {
        try {
            $total = DB::table('tb_feedbacks')->count();
            $today = DB::table('tb_feedbacks')
                ->whereDate('created_at', today())
                ->count();
            
            $lastWeek = DB::table('tb_feedbacks')
                ->whereDate('created_at', '>=', now()->subDays(7))
                ->count();
            
            $authUsers = DB::table('tb_feedbacks')
                ->whereNotNull('created_by')
                ->count();
            
            $guests = DB::table('tb_feedbacks')
                ->whereNull('created_by')
                ->count();
            
            $topUsers = DB::table('tb_feedbacks')
                ->select(
                    'tb_feedbacks.created_by',
                    'users.name',
                    DB::raw('count(*) as total_feedbacks')
                )
                ->leftJoin('users', 'tb_feedbacks.created_by', '=', 'users.id')
                ->whereNotNull('tb_feedbacks.created_by')
                ->groupBy('tb_feedbacks.created_by', 'users.name')
                ->orderByDesc('total_feedbacks')
                ->limit(10)
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'total' => $total,
                    'today' => $today,
                    'last_week' => $lastWeek,
                    'authorized_users' => $authUsers,
                    'guests' => $guests,
                    'top_users' => $topUsers
                ]
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении статистики'
            ], 500);
        }
    }
}