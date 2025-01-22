<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanCutiExport;

class LaporanCutiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('Y-m')); // Default bulan saat ini

        $laporan = Cuti::with('user') // Relasi ke tabel user
            ->where('status', 'Approved')
            ->whereYear('created_at', date('Y', strtotime($bulan)))
            ->whereMonth('created_at', date('m', strtotime($bulan)))
            ->get();

        return view('admin.laporan-cuti', compact('laporan', 'bulan'));
    }

    public function export(Request $request)
    {
        $bulan = $request->input('bulan', now()->format('Y-m')); // Default bulan saat ini
        return Excel::download(new LaporanCutiExport($bulan), 'laporan_cuti.xlsx');
    }
}
