<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // DB facade qo'shildi

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'message' => 'required|string|min:2',
            ]);

            // Bazaga ma'lumotni modelisiz saqlash
            $feedbackId = DB::table('feedback')->insertGetId([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'message' => $validated['message'],
                'created_by' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Telegram uchun obyekt yasab olamiz (model o'rniga)
            $feedbackData = (object)[
                'id' => $feedbackId,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'message' => $validated['message']
            ];

            // Telegramga yuborish
            $this->sendToTelegram($feedbackData);

            return response()->json([
                'success' => true,
                'message' => 'Fikringiz uchun rahmat!'
            ]);
        } catch (\Exception $e) {
            Log::error('Feedback error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function sendToTelegram($feedback)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID'); 
        $topicId = env('TELEGRAM_TOPIC_ID_FEEDBACK', 5);

        if (!$token || !$chatId || !$topicId) {
            Log::warning('Telegram sozlamalari topilmadi (Feedback)');
            return;
        }

        $message = "💬 <b>Yangi Feedback!</b>\n\n";
        $message .= "👤 <b>Ism:</b> " . e($feedback->name) . "\n";
        $message .= "📧 <b>Email:</b> " . e($feedback->email) . "\n";
        $message .= "📝 <b>Xabar:</b> \n" . e($feedback->message) . "\n";
        $message .= "⏰ <b>Vaqt:</b> " . now()->format('d.m.Y H:i');

        try {
            $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'message_thread_id' => (int)$topicId,
                'text' => $message,
                'parse_mode' => 'HTML'
            ]);
            
            if ($response->successful()) {
                Log::info('Feedback Telegramga yuborildi', ['feedback_id' => $feedback->id]);
            }
        } catch (\Exception $e) {
            Log::error('Feedback Telegram xatosi: ' . $e->getMessage());
        }
    }

    public function index()
    {
        // Model o'rniga Query Builder
        $feedbacks = DB::table('feedback')->orderBy('created_at', 'desc')->get();
        return response()->json($feedbacks);
    }
}