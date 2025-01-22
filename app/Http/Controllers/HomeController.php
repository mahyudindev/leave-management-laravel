<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $totalKaryawan = User::count(); // Menghitung total karyawan
        return view('admin.dashboard', compact('totalKaryawan'));
    }
}
