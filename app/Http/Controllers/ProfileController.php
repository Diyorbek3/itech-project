<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
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
            'email'  => $user->email, // Ko'rish uchun qoladi, lekin o'zgartirilmaydi
            'name'   => $user->name,
            'avatar' => $user->avatar,
        ];
     
        return view('profile.index', compact('data'));
    }

    /**
     * Ism va Avatarni yangilash (Email olib tashlandi)
     */
    public function putUpdate(Request $request)
    {
        $user = Auth::user();

        // 1. Validatsiya (Email bu yerdan olib tashlandi)
        $request->validate([
            'name'   => 'required|string|max:128',
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Max 2MB
        ]);

        try {
            // Ismni yangilash
            $user->name = $request->name;

            // Rasm yuklangan bo'lsa
            if ($request->hasFile('avatar')) {
                
                // Eski rasmni o'chirish
                if ($user->avatar && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                    Storage::disk('public')->delete('avatars/' . $user->avatar);
                }

                // Yangi rasmni saqlash
                $file = $request->file('avatar');
                $newFileName = $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                
                $file->storeAs('avatars', $newFileName, 'public');
                
                $user->avatar = $newFileName;
            }

            $user->save();

            return response()->json([
                'success'    => true, 
                'message'    => 'Profil muvaffaqiyatli yangilandi',
                'name'       => $user->name,
                'avatar_url' => $user->avatar 
                                ? asset('storage/avatars/' . $user->avatar) 
                                : asset('images/avatar.png')
            ]);

        } catch (\Exception $e) {
            Log::error('Profile Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Tizimda xatolik yuz berdi'
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
     * Avatarni o'chirish
     */
    public function deleteAvatar()
    {
        $user = Auth::user();

        if ($user->avatar && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);
            $user->avatar = null;
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Rasm o\'chirildi',
            'default_url' => asset('storage/avatars/avatar.png')
        ]);
    }
}   