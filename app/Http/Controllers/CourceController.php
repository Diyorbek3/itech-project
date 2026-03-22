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
        return view('cource.backend'); // Bu to'g'ri, view faylingiz shu yerda bo'lishi kerak
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
}