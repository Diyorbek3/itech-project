<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Course;  // <--- QO'SHISH KERAK!

class HomeController extends Controller
{
    public function index()
{
    // KURSLARNI OLISH
    try {
        $courses = Course::all();
    } catch (\Exception $e) {
        $courses = collect([]); // Bo'sh collection
    }
    
    $feedbacks = $this->getFeedbacksForHomepage();
    
    return view('homepage', compact('feedbacks', 'courses'));
}


    private function getFeedbacksForHomepage()
    {
        try {
            $feedbacks = DB::table('feedback')
                ->Join('users', 'feedback.created_by', '=', 'users.id')
                ->select(
                    'feedback.id',
                    'feedback.name as feedback_name',
                    'feedback.email',
                    'feedback.message',
                    'feedback.created_at',
                    'users.id as user_id',
                    'users.avatar as user_avatar',
                    'users.name as user_name',
                    'users.email as user_email'
                )
                ->orderBy('feedback.created_at', 'desc')
                ->limit(10)
                ->get();
            
            // Форматируем данные для отображения
            $formattedFeedbacks = [];
            foreach ($feedbacks as $feedback) {
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
                
                $name = $feedback->feedback_name ?? $feedback->user_name;
                
                $formattedFeedbacks[] = (object)[
                    'id' => $feedback->id,
                    'name' => $name,
                    'avatar' => $feedback->user_avatar,
                    'message' => $feedback->message,
                    'date' => $date
                ];
            }
            
        
            
            return $formattedFeedbacks;
            
        } catch (\Exception $e) {
            Log::error('Error getting feedbacks for homepage', ['error' => $e->getMessage()]);
        }
    }
    

    public function sendToTelegram(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

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