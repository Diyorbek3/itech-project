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

}