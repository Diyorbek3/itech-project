<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;

class TelegramBotController extends Controller
{
    public function sendToGroup(Request $request)
    {
        try {
            $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
            $groupId = env('TELEGRAM_GROUP_ID');
            
            $message = "🆕 <b>Yangi ariza!</b>\n\n";
            $message .= "👤 <b>Ism:</b> " . $request->name . "\n";
            $message .= "📞 <b>Telefon:</b> " . $request->phone . "\n";
            $message .= "📚 <b>Kurs:</b> " . $request->course . "\n";
            $message .= "⏰ <b>Vaqt:</b> " . now()->format('d.m.Y H:i');
            
            $telegram->sendMessage([
                'chat_id' => $groupId,
                'text' => $message,
                'parse_mode' => 'HTML'
            ]);
            
            return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}