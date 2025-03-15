<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cuti;
use App\Models\JenisCuti;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalTerpakai = Cuti::where('id_user', $user->id)
            ->where('status', 'Approved')
            ->sum('jumlah');
        $jumlahCuti = $user ? $user->jumlah_cuti : 'Data tidak tersedia';
    
        return view('users.dashboard', [
            'jumlahCuti' => $jumlahCuti,
            'totalTerpakai' => $totalTerpakai
        ]);
    }

    public function pengajuanCuti()
    {
        $jenisCuti = JenisCuti::all();
        return view('users.pengajuan', [
            'jenisCuti' => $jenisCuti
        ]);
    }

    public function ajukanCuti(Request $request)
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
            'status' => 'Pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan cuti berhasil dikirim Cek History Untuk Lihat Hasil.');
    }

    public function riwayatCuti(Request $request)
    {
        $query = Auth::user()->cuti()->with('jenisCuti');

        if ($request->has('sort') && in_array($request->sort, ['tanggal_awal', 'tanggal_akhir'])) {
            $query->orderBy($request->sort, 'asc');
        }

        $riwayatCuti = $query->paginate(10);

        return view('users.history', compact('riwayatCuti'));
    }

    public function adminCuti($status)
    {
        $allowedStatuses = ['Pending', 'Approved', 'Rejected'];
        if (!in_array($status, $allowedStatuses)) {
            abort(404);
        }

        $daftarCuti = Cuti::with('user', 'jenisCuti')
            ->where('status', $status)
            ->paginate(10);

        return view('admin.cuti.index', compact('daftarCuti', 'status'));
    }

    public function updateCuti(Request $request, $id)
    {
        $cuti = Cuti::findOrFail($id);
        $action = $request->action;
        $notes = $request->input('notes', null);

        if ($action === 'reject' && !$notes) {
            return redirect()->back()->with('error', 'Catatan harus diisi jika pengajuan ditolak.');
        }

        $user = $cuti->user;

        if ($action === 'approve') {
            if ($cuti->status === 'Pending') {
                $cuti->status = 'Approved';
                $cuti->notes = null;
            }
        } elseif ($action === 'reject') {
            if ($cuti->status === 'Pending') {
                // Kembalikan jumlah cuti jika ditolak
                $user->jumlah_cuti += $cuti->jumlah;
                $user->save();
            }
            $cuti->status = 'Rejected';
            $cuti->notes = $notes;
        }

        $cuti->save();

        return redirect()->back()->with('success', "Cuti berhasil di-{$action}.");
    }
}
