<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // User ma'lumotlarini DB dan olish
        $user = DB::table('users')->where('id', Auth::id())->first();
        
        return view('profile.index', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        // Email o'zgarganligini tekshirish
        $currentUser = DB::table('users')->where('id', Auth::id())->first();
        
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'updated_at' => now(),
        ];
        
        // Qo'shimcha maydonlarni qo'shish (agar mavjud bo'lsa)
        if (isset($validated['surname'])) {
            $updateData['surname'] = $validated['surname'];
        }
        if (isset($validated['phone'])) {
            $updateData['phone'] = $validated['phone'];
        }
        if (isset($validated['country'])) {
            $updateData['country'] = $validated['country'];
        }
        if (isset($validated['city'])) {
            $updateData['city'] = $validated['city'];
        }
        if (isset($validated['address'])) {
            $updateData['address'] = $validated['address'];
        }
        if (isset($validated['bio'])) {
            $updateData['bio'] = $validated['bio'];
        }
        
        // Email o'zgargan bo'lsa, verified_at ni null qilish
        if ($currentUser->email !== $validated['email']) {
            $updateData['email_verified_at'] = null;
        }
        
        // Ma'lumotlarni yangilash
        DB::table('users')
            ->where('id', Auth::id())
            ->update($updateData);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update user avatar.
     */
    public function updateAvatar(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $userId = Auth::id();
            
            // Eski avatarni olish
            $oldAvatar = DB::table('users')
                ->where('id', $userId)
                ->value('avatar');
            
            // Eski avatarni o'chirish (agar mavjud bo'lsa va default bo'lmasa)
            if ($oldAvatar && !str_contains($oldAvatar, 'ui-avatars.com')) {
                $oldPath = str_replace('/storage/', '', $oldAvatar);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            
            // Yangi avatarni saqlash
            $file = $request->file('avatar');
            $fileName = time() . '_' . $userId . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('avatars', $fileName, 'public');
            
            // Avatarni bazaga saqlash
            DB::table('users')
                ->where('id', $userId)
                ->update([
                    'avatar' => '/storage/' . $path,
                    'updated_at' => now()
                ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Avatar muvaffaqiyatli yangilandi',
                'avatar_url' => '/storage/' . $path
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Avatar yuklashda xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete user avatar.
     */
    public function deleteAvatar(): \Illuminate\Http\JsonResponse
    {
        try {
            $userId = Auth::id();
            
            // Avatarni olish
            $avatar = DB::table('users')
                ->where('id', $userId)
                ->value('avatar');
            
            // Fizik faylni o'chirish
            if ($avatar && !str_contains($avatar, 'ui-avatars.com')) {
                $path = str_replace('/storage/', '', $avatar);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            
            // Bazadan avatarni o'chirish
            DB::table('users')
                ->where('id', $userId)
                ->update([
                    'avatar' => null,
                    'updated_at' => now()
                ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Avatar o\'chirildi'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Avatar o\'chirishda xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            $userId = Auth::id();
            
            // Avatarni o'chirish
            $avatar = DB::table('users')
                ->where('id', $userId)
                ->value('avatar');
            
            if ($avatar && !str_contains($avatar, 'ui-avatars.com')) {
                $path = str_replace('/storage/', '', $avatar);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            
            // Userni o'chirish
            DB::table('users')->where('id', $userId)->delete();
            
            Auth::logout();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return Redirect::to('/');
            
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Hisobni o\'chirishda xatolik yuz berdi');
        }
    }
}