<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the security question view.
     */
    public function showSecurityQuestion(Request $request): View|RedirectResponse
    {
        $email = session('reset_email');

        if (!$email) {
            return redirect()->route('password.request');
        }

        $user = User::where('email', $email)->first();

        if (!$user || !$user->security_question) {
            return redirect()->route('password.request');
        }

        return view('auth.security-question', [
            'question' => $user->security_question,
            'email' => $email
        ]);
    }

    /**
     * Verify the security question answer.
     */
    public function verifySecurityQuestion(Request $request): RedirectResponse
    {
        $request->validate([
            'answer' => ['required', 'string'],
        ]);

        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('password.request');
        }

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($request->answer, $user->security_answer)) {
            return back()->withErrors(['answer' => __('messages.invalid_security_answer')]);
        }

        // Answer is correct
        session(['security_verified' => true]);

        return redirect()->route('password.reset');
    }

    /**
     * Display the password reset view.
     */
    public function create(Request $request): View|RedirectResponse
    {
        if (!session('security_verified')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password', ['email' => session('reset_email')]);
    }

    /**
     * Handle an incoming new password request.
     */
    public function store(Request $request): RedirectResponse
    {
        if (!session('security_verified')) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $email = session('reset_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request');
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));

        // Clear session
        session()->forget(['reset_email', 'security_verified']);

        return redirect()->route('login')->with('status', __('messages.password_reset_success'));
    }
}
