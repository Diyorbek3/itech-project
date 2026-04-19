<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Ro'yxatdan o'tish sahifasini ko'rsatish
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Ro'yxatdan o'tish so'rovini qayta ishlash va bazaga saqlash
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validatsiya
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Foydalanuvchini yaratish va 'avatar' ustuniga default qiymat berish
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => 'avatar.png', // DB not null bo'lgani uchun 'avatar.png' qaytarildi
        ]);

        // 3. Registratsiya hodisasini ishga tushirish
        event(new Registered($user));

        // 4. Avtomatik login qilish
        Auth::login($user);

        // 5. Bosh sahifaga yo'naltirish
        return redirect('/'); 
    }
}