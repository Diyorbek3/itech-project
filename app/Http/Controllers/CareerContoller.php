<?php

namespace App\Http\Controllers;

use App\Models\MasterclassRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\LengthAwarePaginator;

class CareerController extends Controller
{
    public function index()
    {
        try {
            $masterClasses = DB::table('master_classes')
                ->orderBy('id', 'desc')
                ->paginate(6);
        } catch (\Exception $e) {
            $masterClasses = new LengthAwarePaginator([], 0, 6);
            Log::warning("Master classes xatolik: " . $e->getMessage());
        }

        return view('career.index', compact('masterClasses'));
    }

    public function getMasterclass($id)
    {
        try {
            $masterclass = DB::table('master_classes')->where('id', $id)->first();
            
            if (!$masterclass) {
                return response()->json(['error' => 'Masterclass topilmadi'], 404);
            }
            
            if ($masterclass->image && !str_starts_with($masterclass->image, 'http')) {
                $masterclass->image_url = asset('storage/' . $masterclass->image);
            } else {
                $masterclass->image_url = $masterclass->image ?? null;
            }
            
            return response()->json($masterclass);
        } catch (\Exception $e) {
            Log::error('Get masterclass error: ' . $e->getMessage());
            return response()->json(['error' => 'Xatolik yuz berdi'], 500);
        }
    }

    public function registerForMasterclass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'masterclass_id' => 'required|integer',
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string|min:9|max:20',
            'email' => 'nullable|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ma\'lumotlarni to\'g\'ri kiriting',
                'errors' => $validator->errors()
            ], 422);
        }

        $masterclass = DB::table('master_classes')->where('id', $request->masterclass_id)->first();
        
        if (!$masterclass) {
            return response()->json([
                'success' => false,
                'message' => 'Masterclass topilmadi'
            ], 404);
        }
        
        // DATABASE GA SAQLASH
        try {
            $registration = MasterclassRegistration::create([
                'masterclass_id' => $request->masterclass_id,
                'user_id' => auth()->check() ? auth()->id() : null,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'telegram_sent' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Log::info('Masterclass registration saved. ID: ' . ($registration->id ?? 'unknown'));

        } catch (\Exception $e) {
            Log::error('Masterclass registration save error: ' . $e->getMessage());
        }
        
        // Telegramga yuborish
        $token = env('TELEGRAM_BOT_TOKEN', '8586485983:AAF-7NhRKL72j3zXWUdznuHFv3rHCh1SIVc');
        $chatId = env('TELEGRAM_CHAT_ID', '-1003836558266');
        
        $text = "🎓 MASTERCLASSGA YANGI ARIZA!\n\n";
        $text .= "📚 Masterclass: " . ($masterclass->title ?? 'Noma\'lum') . "\n";
        $text .= "👤 Ism: " . $request->name . "\n";
        $text .= "📞 Telefon: " . $request->phone . "\n";
        if ($request->email) {
            $text .= "📧 Email: " . $request->email . "\n";
        }
        $text .= "⏰ Vaqt: " . now()->format('d.m.Y H:i');

        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'parse_mode' => 'HTML',
                'text' => $text
            ]);
        } catch (\Exception $e) {
            Log::error('Telegram send error: ' . $e->getMessage());
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Siz muvaffaqiyatli ro\'yxatdan o\'tdingiz! Tez orada siz bilan bog\'lanamiz.'
        ]);
    }

    private function sendToTelegram($data, $type)
    {
        // Bu metod boshqa xabarlar uchun
        return ['success' => true];
    }
}