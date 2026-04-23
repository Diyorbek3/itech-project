<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    // ========== STATIC VIEWLAR ==========
    public function python() { return view('cource.python'); }
    public function frontend() { return view('cource.frontend'); }
    public function backend() { return view('cource.backend'); }
    public function cybersecurity() { return view('cource.cybersecurity'); }
    public function computerLiteracy() { return view('cource.computer-literacy'); }
    public function aiDeveloper() { return view('cource.ai-developer'); }
    public function algorithm() { return view('cource.algorithm'); }
    public function office() { return view('cource.office'); }
    public function robotics() { return view('cource.robotics'); }
    public function digitalKids() { return view('cource.digital-kids'); }
    public function systemEngineering() { return view('cource.system-engineering'); }
    public function devops() { return view('cource.devops'); }
    public function dataAnalytics() { return view('cource.data-analytics'); }
    public function networkAdmin() { return view('cource.network-admin'); }
    public function accounting() { return view('cource.accounting'); }

    // ========== DATABASE KURSLARI ==========
    
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|min:3',
                'short_description' => 'nullable|string',
                'full_description' => 'nullable|string',
                'duration' => 'nullable|string',
                'student_count' => 'nullable|integer',
                'has_certificate' => 'nullable|boolean',
                'word_link' => 'nullable|url',
                'excel_link' => 'nullable|url',
                'powerpoint_link' => 'nullable|url',
                'archive_link' => 'nullable|url',
                'document_link' => 'nullable|url',
                'curriculum' => 'nullable|string',
                'target_audience' => 'nullable|string',
                'teachers' => 'nullable|string',
                'price' => 'nullable|numeric',
                'start_in' => 'nullable|string',
                'schedule' => 'nullable|string',
                'language' => 'nullable|string',
                'has_mentor_support' => 'nullable|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $data = $request->except('image', '_token');
            $data['has_certificate'] = $request->has('has_certificate') ? 1 : 0;
            $data['has_mentor_support'] = $request->has('has_mentor_support') ? 1 : 0;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('courses', $imageName, 'public');
                $data['image'] = $imageName;
            }

            $course = Course::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Kurs muvaffaqiyatli qo\'shildi',
                'course' => $course
            ]);

        } catch (\Exception $e) {
            Log::error('Kurs qo\'shishda xatolik: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    public function tableRows()
    {
        $courses = Course::all();
        return view('courses.table_rows', compact('courses'));
    }

    public function edit($id)
    {
        try {
            $course = Course::findOrFail($id);
            return response()->json([
                'success' => true,
                'course' => $course
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kurs topilmadi'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);

            $request->validate([
                'title' => 'required|min:3',
                'short_description' => 'nullable|string',
                'full_description' => 'nullable|string',
                'duration' => 'nullable|string',
                'student_count' => 'nullable|integer',
                'has_certificate' => 'nullable|boolean',
                'word_link' => 'nullable|url',
                'excel_link' => 'nullable|url',
                'powerpoint_link' => 'nullable|url',
                'archive_link' => 'nullable|url',
                'document_link' => 'nullable|url',
                'curriculum' => 'nullable|string',
                'target_audience' => 'nullable|string',
                'teachers' => 'nullable|string',
                'price' => 'nullable|numeric',
                'start_in' => 'nullable|string',
                'schedule' => 'nullable|string',
                'language' => 'nullable|string',
                'has_mentor_support' => 'nullable|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $data = $request->except('image', '_token', '_method');
            $data['has_certificate'] = $request->has('has_certificate') ? 1 : 0;
            $data['has_mentor_support'] = $request->has('has_mentor_support') ? 1 : 0;

            if ($request->hasFile('image')) {
                if ($course->image && Storage::disk('public')->exists('courses/' . $course->image)) {
                    Storage::disk('public')->delete('courses/' . $course->image);
                }
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('courses', $imageName, 'public');
                $data['image'] = $imageName;
            }

            $course->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Kurs muvaffaqiyatli yangilandi',
                'course' => $course
            ]);

        } catch (\Exception $e) {
            Log::error('Kurs yangilashda xatolik: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            
            if ($course->image && Storage::disk('public')->exists('courses/' . $course->image)) {
                Storage::disk('public')->delete('courses/' . $course->image);
            }
            
            $course->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kurs muvaffaqiyatli o\'chirildi'
            ]);

        } catch (\Exception $e) {
            Log::error('Kurs o\'chirishda xatolik: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    // ========== KURSGA YOZILISH (TELEGRAM BILAN) ==========
    public function enrollSubmit(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'message' => 'nullable|string',
                'course_name' => 'required|string',
                'course_id' => 'nullable|integer'
            ]);

            // 1. DATABASE GA SAQLASH
            $registration = CourseRegistration::create([
                'course_id' => $request->course_id,
                'user_id' => auth()->check() ? auth()->id() : null,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'message' => $request->message,
                'status' => 'pending',
                'telegram_sent' => false
            ]);

            Log::info('Yangi kursga yozilish:', [
                'id' => $registration->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'course_name' => $request->course_name,
            ]);

            // 2. TELEGRAMGA YUBORISH
            $token = env('TELEGRAM_BOT_TOKEN');
            $chatId = env('TELEGRAM_CHAT_ID_COURSES');
            
            if ($token && $chatId) {
                $text = "📚 *Yangi ariza (Kurs)*\n\n";
                $text .= "🆔 ID: " . $registration->id . "\n";
                $text .= "📖 Kurs: " . $request->course_name . "\n";
                $text .= "👤 Ism: " . $request->name . "\n";
                $text .= "📞 Telefon: " . $request->phone . "\n";
                $text .= "📧 Email: " . $request->email . "\n";
                if ($request->message) {
                    $text .= "💬 Xabar: " . $request->message . "\n";
                }
                $text .= "⏳ Status: Kutilmoqda\n";
                $text .= "📅 Vaqt: " . now()->format('d.m.Y H:i:s');

                $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $text,
                    'parse_mode' => 'Markdown'
                ]);
                
                if ($response->successful()) {
                    $registration->telegram_sent = true;
                    $registration->save();
                    Log::info('Telegramga yuborildi');
                } else {
                    Log::warning('Telegram xatosi: ' . $response->body());
                }
            } else {
                Log::warning('Telegram sozlamalari topilmadi');
            }

            return response()->json([
                'success' => true,
                'message' => 'Arizangiz qabul qilindi! Tez orada bog\'lanamiz.'
            ]);

        } catch (\Exception $e) {
            Log::error('Kursga yozilish xatolik: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Xatolik: ' . $e->getMessage()
            ], 500);
        }
    }
}