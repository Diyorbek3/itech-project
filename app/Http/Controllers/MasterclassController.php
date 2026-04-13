<?php

namespace App\Http\Controllers;

use App\Models\MasterClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http; // <--- MUHIM: buni qo'shing
use Carbon\Carbon; // Sanani formatlash uchun

class MasterClassController extends Controller
{
    /**
     * Ro'yxatdan o'tish (Telegramga yuborish)
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required',
            'masterclass_id' => 'required|exists:master_classes,id'
        ]);

        $mc = MasterClass::find($request->masterclass_id);

        $token = "8663915534:AAE9pdupJqYuKXLAjLElNV_Ql1ewaop_TLE";
        $chat_id = "8124664417";
        
        $text = "🚀 **Yangi ariza (Masterclass)**\n\n";
        $text .= "🎓 Kurs: " . ($mc ? $mc->title : 'Noma\'lum') . "\n";
        $text .= "👤 Ism: " . $request->name . "\n";
        $text .= "📞 Tel: " . $request->phone . "\n";

        // Laravel Http client orqali yuborish
        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'Markdown'
        ]);

        return response()->json(['message' => 'Muvaffaqiyatli ro\'yxatdan o\'tdingiz!']);
    }

    /**
     * AJAX uchun: Modalga ma'lumot qaytarish
     */
    public function show($id) 
    {
        $masterClass = MasterClass::findOrFail($id);
        
        return response()->json([
            'title' => $masterClass->title,
            'description' => $masterClass->description,
            'date' => Carbon::parse($masterClass->event_date)->format('d-M, Y'),
            'time' => Carbon::parse($masterClass->event_date)->format('H:i'),
            'image' => asset('storage/' . $masterClass->image),
        ]);
    }

    // --- Qolgan metodlar (Index, Store, Update va h.k.) o'zgarishsiz qoladi ---
    
    public function index() {
        $masterClasses = MasterClass::latest()->paginate(6); 
        return view('career.index', compact('masterClasses'));
    }

    public function create() {
        return view('master_classes.create');
    }
        
    public function adminIndex() {
        $masterClasses = MasterClass::orderBy('id', 'desc')->paginate(10);
        return view('master_classes.admin_index', compact('masterClasses'));
    }

    public function store(Request $request) {
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

    public function edit($id) {
        $mc = MasterClass::findOrFail($id);
        return view('master_classes.edit', compact('mc'));
    }

    public function update(Request $request, $id) {
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

    public function destroy($id) {
        $item = MasterClass::findOrFail($id);
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return back()->with('success', 'O\'chirildi!');
    }
}