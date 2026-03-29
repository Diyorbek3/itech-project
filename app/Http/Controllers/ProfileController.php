<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user profile with edit form.
     */
    public function index()
    {
        $user = auth()->user();
        $data['email'] = $user->email;
        $data['username'] = $user->username;
        $data['first_name'] = $user->first_name;
        $data['last_name'] = $user->last_name;
        $data['avatar'] = $user->avatar;
        $data['hotelname'] = Session::get('htlname');
      
        return view('profile.index', ['data' => $data]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $vD = $request->validate(
            [
                'first_name' => 'required|regex:/^[a-zA-Z]+$/|max:64',
                'last_name' => 'required|regex:/^[a-zA-Z]+$/|max:64',
                'avatar' => 'nullable|image|mimes:jpg,png|max:1024',
            ],
            [
                'first_name.required' => 'First name is required.',
                'first_name.regex' => 'First name must contain only English alphabet characters.',
                'first_name.max' => 'First name must not exceed 64 characters.',
                'last_name.required' => 'Last name is required.',
                'last_name.regex' => 'Last name must contain only English alphabet characters.',
                'last_name.max' => 'Last name must not exceed 64 characters.',
                'avatar.image' => 'The avatar must be an image.',
                'avatar.mimes' => 'The avatar must be a file of type: jpg, png.',
                'avatar.max' => 'The avatar must not be larger than 1MB.',
            ]
        );
        
        try {
            $user = $request->user();
            $user->first_name = $vD['first_name'];
            $user->last_name = $vD['last_name'];
            
            if ($request->hasFile('avatar')) {
                $avatarFile = $request->file('avatar');
                $newFileName = $user->id . '.' . $avatarFile->getClientOriginalExtension();
                
                if ($user->avatar && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                    Storage::disk('public')->delete('avatars/' . $user->avatar);
                }
                
                $avatarFile->storeAs('avatars', $newFileName, 'public');
                $user->avatar = $newFileName;
            }
            
            $user->save();
            
            return response()->json(['status' => 'success', 'message' => 'Profile updated successfully!']);
            
        } catch (\Exception $e) {
            Log::error('Error during profile update', [
                'user' => auth()->id(),
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return response()->json(['status' => 'error', 'message' => 'An error occurred while updating the profile!'], 422);
        }
    }
    
    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $vD = $request->validate(
            [
                'old_password' => 'required',
                'password' => 'required|confirmed|min:8|max:64|regex:/^\S*$/',
            ],
            [
                'password.regex' => 'The password cannot contain spaces.',
                'old_password.required' => 'The old password field is required.',
                'password.required' => 'The password field is required.',
                'password.confirmed' => 'The password confirmation does not match.',
                'password.min' => 'The password must be at least 8 characters.',
                'password.max' => 'The password must not exceed 64 characters.',
            ]
        );
        
        try {
            $user = auth()->user();
            
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['status' => 'error', 'errors' => ['old_password' => ['The old password is incorrect.']]], 422);
            }
            
            $user->password = Hash::make($vD['password']);
            $user->save();
            
            return response()->json(['status' => 'success', 'message' => 'Password updated successfully!']);
            
        } catch (\Exception $e) {
            Log::error('Error during user password update', [
                'user' => auth()->id(),
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return response()->json(['status' => 'error', 'message' => 'An error occurred while updating the password'], 422);
        }
    }
}