<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $courses = Course::all();
        } catch (\Exception $e) {
            $courses = collect([]);
        }

        $feedbacks = $this->getFeedbacksForHomepage();

        return view('homepage', compact('feedbacks', 'courses'));
    }

    private function getFeedbacksForHomepage()
    {
        try {
            $feedbacks = DB::table('feedback')
                ->select(
                    'feedback.id',
                    'feedback.name',
                    'feedback.email',
                    'feedback.message',
                    'feedback.created_at'
                )
                ->where('feedback.status', 'active')
                ->orderBy('feedback.created_at', 'desc')
                ->limit(10)
                ->get();

            $formattedFeedbacks = [];
            foreach ($feedbacks as $feedback) {
                $date = '';
                if ($feedback->created_at) {
                    try {
                        if (is_string($feedback->created_at)) {
                            $date = Carbon::parse($feedback->created_at)->format('d.m.Y');
                        } else {
                            $date = $feedback->created_at->format('d.m.Y');
                        }
                    } catch (\Exception $e) {
                        $date = date('d.m.Y');
                    }
                } else {
                    $date = date('d.m.Y');
                }

                $name = $feedback->name;

                // Avatar yaratish
                $avatar = 'https://ui-avatars.com/api/?background=667eea&color=fff&name=' . urlencode($name);

                $formattedFeedbacks[] = (object) [
                    'id' => $feedback->id,
                    'name' => $name,
                    'avatar' => $avatar,
                    'message' => $feedback->message,
                    'date' => $date
                ];
            }

            return $formattedFeedbacks;

        } catch (\Exception $e) {
            Log::error('Error getting feedbacks for homepage', ['error' => $e->getMessage()]);
            return [];
        }
    }

    public function getFeedbacksApi(Request $request)
    {
        try {
            $limit = $request->get('limit', 10);
            $offset = $request->get('offset', 0);

            $feedbacks = DB::table('feedback')  // 🔥 'feedback'
                ->leftJoin('users', 'feedback.user_id', '=', 'users.id')
                ->select(
                    'feedback.id',
                    'feedback.name as feedback_name',
                    'feedback.email as feedback_email',
                    'feedback.message',
                    'feedback.created_at',
                    'users.name as user_name',
                    'users.email as user_email'
                )
                ->where('feedback.status', 'active')  // 🔥 'active'
                ->orderBy('feedback.created_at', 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get();

            $formattedFeedbacks = [];
            foreach ($feedbacks as $feedback) {
                $date = '';
                if ($feedback->created_at) {
                    try {
                        if (is_string($feedback->created_at)) {
                            $date = Carbon::parse($feedback->created_at)->format('d.m.Y');
                        } else {
                            $date = $feedback->created_at->format('d.m.Y');
                        }
                    } catch (\Exception $e) {
                        $date = date('d.m.Y');
                    }
                } else {
                    $date = date('d.m.Y');
                }

                $formattedFeedbacks[] = [
                    'id' => $feedback->id,
                    'name' => $feedback->user_name ?? $feedback->feedback_name,
                    'avatar' => $this->getDefaultAvatar($feedback->user_email ?? $feedback->feedback_email),
                    'message' => $feedback->message,
                    'position' => $feedback->user_id ? 'Наш студент' : 'Посетитель сайта',
                    'date' => $date
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $formattedFeedbacks,
                'total' => DB::table('feedback')->count()  // 🔥 'feedback'
            ]);

        } catch (\Exception $e) {
            Log::error('API get feedbacks error', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении отзывов'
            ], 500);
        }
    }

    public function sendToTelegram(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        if (empty($name) || empty($email) || empty($message)) {
            return response()->json(['status' => 'error'], 400);
        }

        DB::table('feedback')->insert([  // 🔥 'feedback'
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $token = env('TELEGRAM_BOT_TOKEN');
        $chat_id = env('TELEGRAM_CHAT_ID');

        if ($token && $chat_id) {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chat_id,
                'text' => "Yangi xabar:\nIsm: $name\nEmail: $email\nXabar: $message",
            ]);
        }

        return response()->json(['message' => 'OK'], 200);
    }

    private function getDefaultAvatar($email)
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?d=mp';
    }
}