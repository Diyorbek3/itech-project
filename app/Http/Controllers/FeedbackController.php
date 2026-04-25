<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'message' => 'required|string|min:2',
            ]);

            $validated['created_by'] = auth()->user()->id;
            $feedback = Feedback::create($validated);


            return response()->json([
                'success' => true,
                'message' => 'Fikringiz uchun rahmat!'
            ]);
        } catch (\Exception $e) {
            Log::error('Feedback error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function index()
    {
        $feedbacks = Feedback::latest()->get();
        return response()->json($feedbacks);
    }
}