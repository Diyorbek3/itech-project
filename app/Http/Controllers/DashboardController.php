<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Feedback;
use App\Models\MasterclassRegistration;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ========== ASOSIY SONLAR ==========
        $totalContacts = Contact::count();
        $totalMasterclass = MasterclassRegistration::count();
        $totalCourseRegistrations = CourseRegistration::count();  // KURS YOZILISHLAR
        $totalFeedbacks = Feedback::count();  // FEEDBACKLAR
        $totalAll = $totalContacts + $totalMasterclass + $totalCourseRegistrations;

        // ========== MASTERCLASS STATUSLARI ==========
        $pendingCount = MasterclassRegistration::where('status', 'pending')->count();
        $approvedCount = MasterclassRegistration::where('status', 'approved')->count();
        $rejectedCount = MasterclassRegistration::where('status', 'rejected')->count();
        $cancelledCount = MasterclassRegistration::where('status', 'cancelled')->count();

        $totalWithStatus = $pendingCount + $approvedCount + $rejectedCount + $cancelledCount;
        $pendingPercent = $totalWithStatus > 0 ? round(($pendingCount / $totalWithStatus) * 100) : 0;
        $approvedPercent = $totalWithStatus > 0 ? round(($approvedCount / $totalWithStatus) * 100) : 0;

        // ========== KURS STATUSLARI ==========
        $coursePendingCount = CourseRegistration::where('status', 'pending')->count();
        $courseApprovedCount = CourseRegistration::where('status', 'approved')->count();
        $courseRejectedCount = CourseRegistration::where('status', 'rejected')->count();

        // ========== MASTERCLASS YOZILISHLAR ==========
        $masterclassRegistrations = MasterclassRegistration::with('masterclass')
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        // ========== KURS YOZILISHLAR (COURSE REGISTRATIONS) ==========
        $courseRegistrations = CourseRegistration::with('course')
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

     

        // ========== KURSLAR ==========
        $courses = Course::orderBy('created_at', 'desc')->get();

        // ========== TELEGRAM STATISTIKASI ==========
        $telegramSentCount = MasterclassRegistration::where('telegram_sent', true)->count();
        $telegramNotSentCount = MasterclassRegistration::where('telegram_sent', false)
            ->orWhereNull('telegram_sent')
            ->count();

        // ========== OXIRGI 7 KUN (FEEDBACK VA KURS QO'SHILDI) ==========
        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateStr = $date->format('Y-m-d');

            $last7Days->push([
                'date' => $date->format('d M'),
                'contacts' => Contact::whereDate('created_at', $dateStr)->count(),
                'masterclass' => MasterclassRegistration::whereDate('created_at', $dateStr)->count(),
                'courses' => CourseRegistration::whereDate('created_at', $dateStr)->count(),
                'feedbacks' => Feedback::whereDate('created_at', $dateStr)->count(),
                'total' => Contact::whereDate('created_at', $dateStr)->count() +
                    MasterclassRegistration::whereDate('created_at', $dateStr)->count() +
                    CourseRegistration::whereDate('created_at', $dateStr)->count()
            ]);
        }

        // ========== OYLIK MA'LUMOTLAR ==========
        $monthlyData = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $startDate = $month->copy()->startOfMonth();
            $endDate = $month->copy()->endOfMonth();

            $monthlyData->push([
                'month' => $month->format('M Y'),
                'contacts' => Contact::whereBetween('created_at', [$startDate, $endDate])->count(),
                'masterclass' => MasterclassRegistration::whereBetween('created_at', [$startDate, $endDate])->count(),
                'courses' => CourseRegistration::whereBetween('created_at', [$startDate, $endDate])->count(),
                'feedbacks' => Feedback::whereBetween('created_at', [$startDate, $endDate])->count(),
                'total' => Contact::whereBetween('created_at', [$startDate, $endDate])->count() +
                    MasterclassRegistration::whereBetween('created_at', [$startDate, $endDate])->count() +
                    CourseRegistration::whereBetween('created_at', [$startDate, $endDate])->count()
            ]);
        }

        return view('admin.dashboard', compact(
            'totalContacts',
            'totalMasterclass',
            'totalCourseRegistrations',
            'totalFeedbacks',
            'totalAll',
            'last7Days',
            'monthlyData',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'cancelledCount',
            'pendingPercent',
            'approvedPercent',
            'masterclassRegistrations',
            'courseRegistrations',
        
            'courses',
            'telegramSentCount',
            'telegramNotSentCount',
            'coursePendingCount',
            'courseApprovedCount',
            'courseRejectedCount'
        ));
    }

    // ========== MASTERCLASS STATUS YANGILASH ==========
    public function updateStatus(Request $request, $id)
    {
        $registration = MasterclassRegistration::findOrFail($id);
        $registration->status = $request->status;
        $registration->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status muvaffaqiyatli yangilandi',
                'status' => $registration->status
            ]);
        }

        return redirect()->back()->with('success', 'Status yangilandi');
    }

    // ========== KURS STATUS YANGILASH ==========
    public function updateCourseStatus(Request $request, $id)
    {
        $registration = CourseRegistration::findOrFail($id);
        $registration->status = $request->status;
        $registration->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Kurs statusi muvaffaqiyatli yangilandi',
                'status' => $registration->status
            ]);
        }

        return redirect()->back()->with('success', 'Kurs statusi yangilandi');
    }

    // ========== MASTERCLASS BATAFSIL ==========
    public function showRegistration($id)
    {
        $registration = MasterclassRegistration::with('masterclass')->findOrFail($id);

        return response()->json([
            'id' => $registration->id,
            'name' => $registration->name,
            'phone' => $registration->phone,
            'email' => $registration->email,
            'masterclass_title' => $registration->masterclass->title ?? 'Noma\'lum',
            'created_at' => $registration->created_at->format('d.m.Y H:i:s'),
            'status' => $registration->status,
            'telegram_sent' => $registration->telegram_sent
        ]);
    }

    // ========== KURS BATAFSIL ==========
    public function showCourseRegistration($id)
    {
        $registration = CourseRegistration::with('course')->findOrFail($id);

        return response()->json([
            'id' => $registration->id,
            'name' => $registration->name,
            'phone' => $registration->phone,
            'email' => $registration->email,
            'course_title' => $registration->course->title ?? 'Noma\'lum',
            'created_at' => $registration->created_at->format('d.m.Y H:i:s'),
            'status' => $registration->status,
            'telegram_sent' => $registration->telegram_sent
        ]);
    }

    // ========== FEEDBACK O'CHIRISH ==========
    public function deleteFeedback($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return response()->json([
            'success' => true,
            'message' => 'Feedback muvaffaqiyatli o\'chirildi'
        ]);
    }
}