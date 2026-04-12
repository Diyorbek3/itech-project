<?php

namespace App\Http\Controllers;

use App\Models\MasterClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasterClassController extends Controller
{
    // Hamma ko'radigan sahifa
    public function index() {
        $masterClasses = MasterClass::latest()->paginate(6); 
        return view('career.index', compact('masterClasses'));
    }

    // Qo'shish formasi
    public function create() {
        return view('master_classes.create');
    }
        
    // Adminlar uchun boshqaruv sahifasi
    public function adminIndex() {
        $masterClasses = MasterClass::latest()->paginate(10);
        return view('master_classes.admin_index', compact('masterClasses'));
    }

    // Saqlash mantiqi (Yangi master-klass qo'shish)
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
        return redirect()->route('career.index')->with('success', 'Muvaffaqiyatli qo\'shildi!');
    }

    // Tahrirlash sahifasini ochish
    public function edit($id)
    {
        $mc = MasterClass::findOrFail($id);
        return view('master_classes.edit', compact('mc'));
    }

    // Tahrirlangan ma'lumotni saqlash (UPDATE)
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

        // Agar yangi rasm yuklangan bo'lsa
        if ($request->hasFile('image')) {
            // Eski rasmni diskdan o'chiramiz
            if ($mc->image) {
                Storage::disk('public')->delete($mc->image);
            }
            // Yangi rasmni saqlaymiz va yo'lini $data massiviga yozamiz
            $data['image'] = $request->file('image')->store('master-classes', 'public');
        }

        // Barcha ma'lumotlarni (shu jumladan telegram_link va yangi rasm yo'lini) bitta yangilaymiz
        $mc->update($data);

        return redirect()->route('career.index')->with('success', 'Master-klass muvaffaqiyatli yangilandi!');
    }

    // O'chirish
    public function destroy($id) {
        $item = MasterClass::findOrFail($id);
        
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        
        $item->delete();
        return back()->with('success', 'Master-klass o\'chirildi!');
    }
}