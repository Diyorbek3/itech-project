<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

            $validated['created_by'] = auth()->user()->id;
            $feedback = Feedback::create($validated);


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
        // ========== TELEGRAMGA XABAR YUBORISH (TO'G'RILANGAN) ==========
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');                    // TO'G'RILANDI!
        $topicId = env('TELEGRAM_TOPIC_ID_FEEDBACK', 5);      // QO'SHILDI! (Feedback topic ID = 5)

        if (!$token || !$chatId || !$topicId) {
            Log::warning('Telegram sozlamalari topilmadi (Feedback)', [
                'token' => $token ? 'bor' : 'yo\'q',
                'chatId' => $chatId ? 'bor' : 'yo\'q',
                'topicId' => $topicId ? 'bor' : 'yo\'q'
            ]);
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
                'message_thread_id' => (int)$topicId,    // QO'SHILDI!
                'text' => $message,
                'parse_mode' => 'HTML'
            ]);
            
            if ($response->successful()) {
                Log::info('Feedback Telegramga yuborildi (Feedback topic)', [
                    'topic_id' => $topicId,
                    'feedback_id' => $feedback->id
                ]);
            } else {
                Log::warning('Feedback Telegram xatosi: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Feedback Telegram xatosi: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $feedbacks = Feedback::latest()->get();
        return response()->json($feedbacks);
    }
}