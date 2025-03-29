<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        // Total Karyawan (only for HRD)
        if ($user->role === 'hrd') {
            $totalKaryawan = User::count();
            $data['totalKaryawan'] = $totalKaryawan;
        }

        // For HRD: Show leave requests that have been approved by manager
        if ($user->role === 'hrd') {
            $data['pending'] = Cuti::where('status_manager', 'approved')
                                 ->where('status_hrd', 'pending')
                                 ->count();
            $data['approved'] = Cuti::where('status_hrd', 'approved')->count();
            $data['rejected'] = Cuti::where('status_hrd', 'rejected')->count();
        }
        // For Manager: Show only their department's leave requests
        elseif ($user->role === 'manager') {
            $data['pending'] = Cuti::whereHas('user', function($query) use ($user) {
                                    $query->where('departemen_id', $user->departemen_id);
                                 })
                                 ->where('status_manager', 'pending')
                                 ->count();
            $data['approved'] = Cuti::whereHas('user', function($query) use ($user) {
                                    $query->where('departemen_id', $user->departemen_id);
                                 })
                                 ->where('status_manager', 'approved')
                                 ->count();
            $data['rejected'] = Cuti::whereHas('user', function($query) use ($user) {
                                    $query->where('departemen_id', $user->departemen_id);
                                 })
                                 ->where('status_manager', 'rejected')
                                 ->count();
        }

        // Add contract end notification
        $notification = null;
        if ($user && $user->tanggal_akhir_kerja) {
            try {
                $contractEndDate = Carbon::parse($user->tanggal_akhir_kerja);
                $daysUntilEnd = now()->diffInDays($contractEndDate);
                
                // Debug logging
                Log::info('Admin contract end calculation', [
                    'user_id' => $user->id,
                    'contract_end_date' => $contractEndDate->format('Y-m-d'),
                    'days_until_end' => $daysUntilEnd
                ]);

                // Show notification for 30 days before contract ends
                if ($daysUntilEnd >= 0 && $daysUntilEnd <= 30) {
                    if ($user->jumlah_cuti > 0) {
                        $notification = [
                            'type' => 'warning',
                            'message' => "Kontrak Anda akan berakhir dalam " . floor($daysUntilEnd) . " hari. Anda masih memiliki {$user->jumlah_cuti} hari cuti yang belum digunakan."
                        ];
                    }
                }
            } catch (\Exception $e) {
                Log::error('Error calculating admin contract end date', [
                    'error' => $e->getMessage()
                ]);
            }
        }
        
        // Add notification to data array
        $data['notification'] = $notification;

        return view('admin.dashboard', $data);
    }
}
