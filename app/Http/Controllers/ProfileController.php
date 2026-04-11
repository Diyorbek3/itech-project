<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Profil sahifasini ko'rsatish
     */
    public function index()
    {
        $user = Auth::user();
        
        $data = [
            'email'  => $user->email, 
            'name'   => $user->name,
            'avatar' => $user->avatar,
        ];
     
        return view('profile.index', compact('data'));
    }

    /**
     * Ism va Avatarni yangilash (Xotirani tejash va keshni yangilash bilan)
     */
    public function putUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'   => 'required|string|max:128',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', 
        ]);

        try {
            $user->name = $request->name;

            if ($request->hasFile('avatar')) {
                // 1. Storage diskda 'avatars' papkasi borligini tekshirish
                if (!Storage::disk('public')->exists('avatars')) {
                    Storage::disk('public')->makeDirectory('avatars');
                }

                // 2. XOTIRANI TEJASH: Eski rasmni o'chirish (default rasm bo'lmasa)
                if ($user->avatar && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                    Storage::disk('public')->delete('avatars/' . $user->avatar);
                }

                // 3. Yangi faylni olish va nomlash
                $file = $request->file('avatar');
                // Fayl nomi unikalligi uchun vaqt va user ID dan foydalanamiz
                $newFileName = 'user_' . $user->id . '_' . time() . '.jpg';
                
                // 4. Rasmni 'public' diskiga yuklash
                Storage::disk('public')->putFileAs('avatars', $file, $newFileName);
                
                $user->avatar = $newFileName;
            }

            $user->save();

            // Brauzer keshini chetlab o'tish uchun vaqt qo'shamiz (?v=123)
            $newAvatarUrl = asset('storage/avatars/' . $user->avatar) . '?v=' . time();

            return response()->json([
                'success'    => true, 
                'message'    => 'Ma\'lumotlar muvaffaqiyatli yangilandi',
                'avatar_url' => $newAvatarUrl
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Xatolik yuz berdi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Parolni yangilash
     */
    public function putNewPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password'     => 'required|confirmed|min:8|max:64',
        ], [
            'password.confirmed' => 'Yangi parollar mos kelmadi',
            'password.min'       => 'Yangi parol kamida 8 ta belgidan iborat bo\'lishi kerak'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'success' => false, 
                'message' => 'Eski parolingiz noto\'g\'ri kiritildi'
            ], 422);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'success' => true, 
            'message' => 'Parol muvaffaqiyatli o\'zgartirildi'
        ]);
    }

    /**
     * Avatarni o'chirish (Serverdan ham o'chadi)
     */
    public function deleteAvatar()
    {
        $user = Auth::user();

        if ($user->avatar) {
            if (Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }
            
            $user->avatar = null;
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Rasm o\'chirildi',
            'default_url' => asset('images/avatar.png') // Default rasm manzili
        ]);
    }
}