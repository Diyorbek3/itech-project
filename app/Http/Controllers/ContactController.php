<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function sendContact(Request $request)
    {
        // Validatsiya
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20'
        ], [
            'name.required' => 'Ism kiritish majburiy',
            'email.required' => 'Email kiritish majburiy',
            'email.email' => 'To\'g\'ri email kiriting',
            'phone.required' => 'Telefon kiritish majburiy'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        // DATABASE GA SAQLASH
        try {
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            Log::info('Kontakt saqlandi:', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ]);

        } catch (\Exception $e) {
            Log::error('Kontakt saqlashda xatolik: ' . $e->getMessage());
        }

        // Telegramga yuborish
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        $text = "🆕 YANGI ARIZA!\n\n";
        $text .= "👤 Ism: " . $request->name . "\n";
        $text .= "📧 Email: " . $request->email . "\n";
        $text .= "📞 Telefon: " . $request->phone . "\n";
        $text .= "⏰ Vaqt: " . now()->format('d.m.Y H:i');

        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'parse_mode' => 'HTML',
                'text' => $text
            ]);
        } catch (\Exception $e) {
            Log::error('Telegramga yuborishda xatolik: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Arizangiz qabul qilindi!'
        ]);
    }
}