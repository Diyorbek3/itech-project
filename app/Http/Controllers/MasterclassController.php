<?php

namespace App\Http\Controllers;

use App\Models\MasterClass;
use App\Models\MasterclassRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class MasterClassController extends Controller
{
    /**
     * Masterclassga ro'yxatdan o'tish (Telegram + Database)
     */
    public function register(Request $request)
    {
        // Validatsiya
        $request->validate([
            'name' => 'required|min:2|max:255',
            'phone' => 'required|min:9|max:20',
            'masterclass_id' => 'required|exists:master_classes,id'
        ]);

        // Masterclass ma'lumotlarini olish
        $mc = MasterClass::find($request->masterclass_id);

        // EMAIL NI Olish (agar user tizimga kirgan bo'lsa)
        $email = null;
        if (auth()->check()) {
            $email = auth()->user()->email;  // Auth userning emaili
        } else {
            $email = $request->email ?? 'Kiritilmagan';
        }

        // Agar email bo'sh bo'lsa
        if (empty($email)) {
            $email = 'Kiritilmagan';
        }

        // Database ga saqlash
        $registration = MasterclassRegistration::create([
            'masterclass_id' => $request->masterclass_id,
            'user_id' => auth()->check() ? auth()->id() : null,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $email,
            'status' => 'pending',
            'telegram_sent' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // ========== TELEGRAMGA XABAR YUBORISH ==========
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID_MASTERCLASS');

        if ($token && $chatId) {
            $text = "🚀 **Yangi ariza (Masterclass)**\n\n";
            $text .= "🆔 ID: " . $registration->id . "\n";
            $text .= "🎓 Kurs: " . ($mc ? $mc->title : 'Noma\'lum') . "\n";
            $text .= "👤 Ism: " . $request->name . "\n";
            $text .= "📞 Tel: " . $request->phone . "\n";
            $text .= "📧 Email: " . $email . "\n";
            $text .= "⏳ Status: Kutilmoqda (pending)\n";
            $text .= "📅 Vaqt: " . now()->format('d.m.Y H:i:s');
            $text .= "\n\n📊 Dashboard: " . url('/dashboard');

            try {
                Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $text,
                    'parse_mode' => 'Markdown'
                ]);

                $registration->telegram_sent = true;
                $registration->save();

            } catch (\Exception $e) {
                \Log::error('Masterclass Telegram xatosi: ' . $e->getMessage());
            }
        } else {
            \Log::warning('Telegram sozlamalari topilmadi (Masterclass)');
        }

        return response()->json([
            'success' => true,
            'message' => 'Muvaffaqiyatli ro\'yxatdan o\'tdingiz! Tez orada siz bilan bog\'lanamiz.',
            'registration_id' => $registration->id
        ]);
    }

    // ========== MASTERCLASS CRUD METODLARI ==========

    public function index()
    {
        $masterClasses = MasterClass::latest()->paginate(6);
        return view('career.index', compact('masterClasses'));
    }

    public function create()
    {
        return view('master_classes.create');
    }

    public function adminIndex()
    {
        $masterClasses = MasterClass::orderBy('id', 'desc')->paginate(10);
        return view('master_classes.admin_index', compact('masterClasses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'telegram_link' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('master-classes', 'public');
        }

        MasterClass::create($data);
        return redirect()->route('master_class.admin_index')->with('success', 'Muvaffaqiyatli qo\'shildi!');
    }

    public function edit($id)
    {
        $mc = MasterClass::findOrFail($id);
        return view('master_classes.edit', compact('mc'));
    }

    public function update(Request $request, $id)
    {
        $mc = MasterClass::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'telegram_link' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            if ($mc->image) {
                Storage::disk('public')->delete($mc->image);
            }
            $data['image'] = $request->file('image')->store('master-classes', 'public');
        }

        $mc->update($data);
        return redirect()->route('master_class.admin_index')->with('success', 'Yangilandi!');
    }

    public function destroy($id)
    {
        $item = MasterClass::findOrFail($id);
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return back()->with('success', 'O\'chirildi!');
    }
}