<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

            $feedback = Feedback::create($validated);

            // Telegramga yuborish
            $this->sendToTelegram($feedback);

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
        // ✅ TO'G'RI - .env faylidan o'qiydi
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        if (!$token || !$chatId) {
            Log::warning('Telegram sozlamalari topilmadi');
            return;
        }

        $message = "💬 <b>Yangi Feedback!</b>\n\n";
        $message .= "👤 <b>Ism:</b> " . e($feedback->name) . "\n";
        $message .= "📧 <b>Email:</b> " . e($feedback->email) . "\n";
        $message .= "📝 <b>Xabar:</b> \n" . e($feedback->message) . "\n";
        $message .= "⏰ <b>Vaqt:</b> " . now()->format('d.m.Y H:i');

        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML'
            ]);
            
            Log::info('Telegramga yuborildi');
        } catch (\Exception $e) {
            Log::error('Telegram xatosi: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $feedbacks = Feedback::latest()->get();
        return response()->json($feedbacks);
    }
}