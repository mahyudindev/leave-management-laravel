<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        return view('admin.dashboard', $data);
    }
}
