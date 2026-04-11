<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function sendContact(Request $request)
    {
        try {
            // Ma'lumotlarni tekshirish
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255'
            ]);
            
            // Log faylga yozish (tekshirish uchun)
            \Log::info('Contact form submitted:', [
                'name' => $request->name,
                'email' => $request->email,
                'time' => now()
            ]);
            
            // Agar Telegramga yubormoqchi bo'lsangiz:
            // $token = "8586485983:AAF-7NhRKL72j3zXWUdznuHFv3rHCh1SIVc";
            // $chatId = "-1003836558266";
            // $text = "🆕 YANGI ARIZA!\n\n👤 Ism: " . $request->name . "\n📧 Email: " . $request->email;
            // $url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chatId}&text=" . urlencode($text);
            // file_get_contents($url);
            
            return response()->json([
                'success' => true,
                'message' => 'Arizangiz muvaffaqiyatli yuborildi!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xatolik yuz berdi: ' . $e->getMessage()
            ], 500);
        }
    }
}