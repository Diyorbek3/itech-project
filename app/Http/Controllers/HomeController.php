<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
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

        // 2. Xabar matni
        $text = "🚀 *" . __('messages.new_request') . "*\n\n";
        $text .= "👤 *" . __('messages.name') . ":* " . $name . "\n";
        $text .= "📧 *" . __('messages.email') . ":* " . $email . "\n";
        $text .= "💬 *" . __('messages.message') . ":* " . $message . "\n\n";
        $text .= "⏰ *" . __('messages.time') . ":* " . now()->format('d.m.Y H:i');


        // 3. Telegramga yuborish
        Http::post("https://api.telegram.org/bot{$token}/sendMessage", data: [
            'chat_id' => 8124664417,
            'parse_mode' => 'Markdown',
            'text' => $text,
        ]);

        return response()->json(['message' => __('messages.success')], 200);
    }
}