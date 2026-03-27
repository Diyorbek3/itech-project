<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CourceController extends Controller
{
    public function python()
    {
        return view('cource.python');
    }

    public function frontend()
    {
        return view('cource.frontend');
    }
    
    public function backend() 
    {
        return view('cource.backend');
    }   

    public function cybersecurity() 
    {
        return view('cource.cybersecurity');
    }

    public function computerLiteracy() 
    {
        return view('cource.computer-literacy');
    }

    public function aiDeveloper() 
    {
        return view('cource.ai-developer');
    }

    // ========== YANGI QO'SHILGAN KURSLAR ==========
    public function algorithm()
    {
        return view('cource.algorithm');
    }

    public function office()
    {
        return view('cource.office');
    }

    public function robotics()
    {
        return view('cource.robotics');
    }

    public function digitalKids()
    {
        return view('cource.digital-kids');
    }

    public function systemEngineering()
    {
        return view('cource.system-engineering');
    }

    public function devops()
    {
        return view('cource.devops');
    }

    public function dataAnalytics()
    {
        return view('cource.data-analytics');
    }

    public function networkAdmin()
    {
        return view('cource.network-admin');
    }
    // ========== YANGI QO'SHILGAN KURSLAR TUGADI ==========

    // ========== QO'SHILGAN METOD ==========
    public function enrollSubmit(Request $request)
    {
        // Validatsiya
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'nullable|string',
            'course_name' => 'required|string',
        ]);

        // Ma'lumotlarni log qilish
        Log::info('Yangi kursga yozilish:', [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'course' => $request->course_name,
            'message' => $request->message,
            'ip' => $request->ip(),
            'time' => now(),
        ]);

        // Sessionga success message
        session()->flash('success', 'Arizangiz qabul qilindi! Tez orada bog\'lanamiz.');

        // Qaytish
        return redirect()->back();
    }
    // ========== QO'SHILGAN METOD TUGADI ==========
}