<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cuti;

class HomeController extends Controller
{
    public function index()
    {
        $totalKaryawan = User::count(); // Menghitung total karyawan
        $pending = Cuti::where('status', 'pending')->count(); // Menghitung status pending
        $approved = Cuti::whereIn('status', ['approved_manager', 'approved_hrd'])->count(); // Menghitung status approved
        $rejected = Cuti::whereIn('status', ['rejected_manager', 'rejected_hrd'])->count(); // Menghitung status rejected

        return view('admin.dashboard', compact('totalKaryawan', 'pending', 'approved', 'rejected'));
    }
}