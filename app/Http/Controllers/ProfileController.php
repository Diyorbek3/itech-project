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
            'security_question' => $user->security_question,
        ];
     
        return view('profile.index', compact('data'));
    }

    /**
     * Ism, Email va Avatarni yangilash
     */
    public function putUpdate(Request $request)
    {
        $user = Auth::user();

        // Validatsiya: email o'ziniki bo'lsa xato bermasligi uchun ID istisno qilindi
        $request->validate([
            'name'   => 'required|string|max:128',
            'email'  => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', 
        ]);

        try {
            // Ma'lumotlarni yangilash
            $user->name = $request->name;
            $user->email = $request->email; 

            if ($request->hasFile('avatar')) {
                // 1. Papka borligini tekshirish
                if (!Storage::disk('public')->exists('avatars')) {
                    Storage::disk('public')->makeDirectory('avatars');
                }

                // 2. Eski rasmni o'chirish
                if ($user->avatar && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                    Storage::disk('public')->delete('avatars/' . $user->avatar);
                }

                // 3. Yangi faylni nomlash va saqlash
                $file = $request->file('avatar');
                $newFileName = 'user_' . $user->id . '_' . time() . '.jpg';
                Storage::disk('public')->putFileAs('avatars', $file, $newFileName);
                
                $user->avatar = $newFileName;
            }

            $user->save();

            // Kesh muammosini oldini olish uchun URL
            $newAvatarUrl = $user->avatar 
                ? asset('storage/avatars/' . $user->avatar) . '?v=' . time() 
                : asset('images/avatar.png');

            return response()->json([
                'success'    => true, 
                'message'    => 'Ma\'lumotlar muvaffaqiyatli yangilandi',
                'avatar_url' => $newAvatarUrl,
                'user_name'  => $user->name,
                'user_email' => $user->email
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Xatolik: ' . $e->getMessage()
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
                'message' => 'Eski parolingiz noto\'g\'ri'
            ], 422);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'success' => true, 
            'message' => 'Parol o\'zgartirildi'
        ]);
    }

    /**
     * Xavfsizlik savolini yangilash
     */
    public function putUpdateSecurity(Request $request)
    {
        $request->validate([
            'security_question' => 'required|string|max:255',
            'security_answer'   => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->security_question = $request->security_question;
        $user->security_answer = Hash::make($request->security_answer);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Xavfsizlik savoli saqlandi'
        ]);
    }

    /**
     * Avatarni o'chirish
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
            'default_url' => asset('images/avatar.png')
        ]);
    }
}