<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\MasterclassRegistration;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Asosiy sonlar
        $totalContacts = Contact::count();
        $totalMasterclass = MasterclassRegistration::count();
        $totalAll = $totalContacts + $totalMasterclass;

        // Status bo'yicha statistika
        $pendingCount = MasterclassRegistration::where('status', 'pending')->count();
        $approvedCount = MasterclassRegistration::where('status', 'approved')->count();
        $rejectedCount = MasterclassRegistration::where('status', 'rejected')->count();
        $cancelledCount = MasterclassRegistration::where('status', 'cancelled')->count();

        // Status foizlari
        $totalWithStatus = $pendingCount + $approvedCount + $rejectedCount + $cancelledCount;
        $pendingPercent = $totalWithStatus > 0 ? round(($pendingCount / $totalWithStatus) * 100) : 0;
        $approvedPercent = $totalWithStatus > 0 ? round(($approvedCount / $totalWithStatus) * 100) : 0;

        // Barcha registratsiyalar
        $allRegistrations = MasterclassRegistration::with('masterclass')
            ->orderBy('created_at', 'desc')
            ->get();

        // Telegram statistikasi
        $telegramSentCount = MasterclassRegistration::where('telegram_sent', true)->count();
        $telegramNotSentCount = MasterclassRegistration::where('telegram_sent', false)
            ->orWhereNull('telegram_sent')
            ->count();

        // Oxirgi 7 kun
        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateStr = $date->format('Y-m-d');

            $last7Days->push([
                'date' => $date->format('d M'),
                'contacts' => Contact::whereDate('created_at', $dateStr)->count(),
                'masterclass' => MasterclassRegistration::whereDate('created_at', $dateStr)->count(),
                'total' => Contact::whereDate('created_at', $dateStr)->count() +
                    MasterclassRegistration::whereDate('created_at', $dateStr)->count(),
                'pending' => MasterclassRegistration::whereDate('created_at', $dateStr)->where('status', 'pending')->count(),
                'approved' => MasterclassRegistration::whereDate('created_at', $dateStr)->where('status', 'approved')->count()
            ]);
        }

        // Oylik ma'lumotlar
        $monthlyData = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);

            $monthlyData->push([
                'month' => $month->format('M Y'),
                'contacts' => Contact::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count(),
                'masterclass' => MasterclassRegistration::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count(),
                'total' => Contact::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count() +
                    MasterclassRegistration::whereYear('created_at', $month->year)
                        ->whereMonth('created_at', $month->month)
                        ->count()
            ]);
        }

        return view('admin.dashboard', compact(
            'totalContacts',
            'totalMasterclass',
            'totalAll',
            'last7Days',
            'monthlyData',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'cancelledCount',
            'pendingPercent',
            'approvedPercent',
            'allRegistrations',  // Bu yerda o'zgaradi
            'telegramSentCount',
            'telegramNotSentCount'
        ));
    }

    // ========== STATUS YANGILASH METODI ==========
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

    // ========== BATAFSIL MA'LUMOT OLISH METODI ==========
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
}