<?php

namespace App\Http\Controllers;

use App\Models\MasterClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasterClassController extends Controller
{
    /**
     * Foydalanuvchilar ko'radigan asosiy sahifa
     * Bu yerda eng yangi qo'shilganlari birinchi tursin (latest ishlatish o'rinli)
     */
    public function index() {
        $masterClasses = MasterClass::latest()->paginate(6); 
        return view('career.index', compact('masterClasses'));
    }

    /**
     * Qo'shish formasi
     */
    public function create() {
        return view('master_classes.create');
    }
        
    /**
     * Adminlar uchun boshqaruv sahibasi
     * Tahrirlashda joyi o'zgarmasligi uchun orderBy('id', 'desc') qilamiz
     */
    public function adminIndex() {
        // latest() o'rniga orderBy('id', 'desc') ishlating
        $masterClasses = MasterClass::orderBy('id', 'desc')->paginate(10);
        return view('master_classes.admin_index', compact('masterClasses'));
    }

    /**
     * Yangi master-klassni saqlash
     */
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

        // Qo'shgandan keyin admin panelga qaytish maqsadga muvofiq
        return redirect()->route('master_class.admin_index')->with('success', 'Muvaffaqiyatli qo\'shildi!');
    }

    /**
     * Tahrirlash sahifasi
     */
    public function edit($id)
    {
        $mc = MasterClass::findOrFail($id);
        return view('master_classes.edit', compact('mc'));
    }

    /**
     * Ma'lumotlarni yangilash
     */
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

        // Tahrirlashdan keyin admin panelga qaytish (career.index ga emas)
        return redirect()->route('master_class.admin_index')->with('success', 'Master-klass muvaffaqiyatli yangilandi!');
    }

    /**
     * O'chirish
     */
    public function destroy($id) {
        $item = MasterClass::findOrFail($id);
        
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        
        $item->delete();
        return back()->with('success', 'Master-klass o\'chirildi!');
    }
}