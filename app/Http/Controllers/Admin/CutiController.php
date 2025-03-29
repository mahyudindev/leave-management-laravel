<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\JenisCuti;
use Carbon\Carbon;

class CutiController extends Controller
{
    public function create()
    {
        $jenisCuti = JenisCuti::all();
        return view('admin.cuti.create', [
            'jenisCuti' => $jenisCuti
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_cuti' => 'required|exists:jenis_cuti,id',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $tanggalAwal = Carbon::parse($request->tanggal_awal);
        $tanggalAkhir = Carbon::parse($request->tanggal_akhir);
        $jumlahHari = $tanggalAwal->diffInDays($tanggalAkhir) + 1;

        $user = Auth::user();

        if ($jumlahHari > $user->jumlah_cuti) {
            return back()->with('error', 'Jumlah hari cuti melebihi sisa cuti Anda.');
        }

        // Kurangi jumlah cuti saat pengajuan
        $user->jumlah_cuti -= $jumlahHari;
        $user->save();

        Cuti::create([
            'id_user' => $user->id,
            'jenis_cuti' => $request->jenis_cuti,
            'tanggal_awal' => $tanggalAwal,
            'tanggal_akhir' => $tanggalAkhir,
            'jumlah' => $jumlahHari,
            'status' => 'waiting',
            'status_manager' => 'approved',
            'status_hrd' => 'pending'
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Pengajuan cuti berhasil dikirim ke HRD.');
    }
}
