<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\MasterclassRegistration;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Umumiy sonlar
        $totalContacts = Contact::count();
        $totalMasterclass = MasterclassRegistration::count();
        $totalAll = $totalContacts + $totalMasterclass;

        // Oxirgi 7 kun uchun ma'lumotlar
        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            
            $contactsCount = Contact::whereDate('created_at', $dateStr)->count();
            $masterclassCount = MasterclassRegistration::whereDate('created_at', $dateStr)->count();
            
            $last7Days->push([
                'date' => $date->format('d M'),
                'contacts' => $contactsCount,
                'masterclass' => $masterclassCount,
                'total' => $contactsCount + $masterclassCount
            ]);
        }

        // Oylik ma'lumotlar (grafik uchun)
        $monthlyData = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthStr = $month->format('Y-m');
            
            $contactsCount = Contact::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $masterclassCount = MasterclassRegistration::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            
            $monthlyData->push([
                'month' => $month->format('M Y'),
                'contacts' => $contactsCount,
                'masterclass' => $masterclassCount,
                'total' => $contactsCount + $masterclassCount
            ]);
        }

        return view('admin.dashboard', compact(
            'totalContacts', 
            'totalMasterclass', 
            'totalAll',
            'last7Days',
            'monthlyData'
        ));
    }
}