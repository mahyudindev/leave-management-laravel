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
    // Method untuk menampilkan dashboard
    public function index()
    {
        // Mengambil data jumlah cuti dari user yang sedang login
        $user = Auth::user(); // Mendapatkan user yang sedang login

        // Pastikan user ditemukan dan ambil jumlah cuti
        $jumlahCuti = $user ? $user->jumlah_cuti : 'Data tidak tersedia';

        return view('users.dashboard', [
            'jumlahCuti' => $jumlahCuti
        ]);
    }

    // Method untuk menampilkan halaman pengajuan cuti
    public function pengajuanCuti()
    {
        $jenisCuti = JenisCuti::all();
        return view('users.pengajuan', [
            'jenisCuti' => $jenisCuti
        ]);
    }

    // Method untuk menyimpan pengajuan cuti
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
            return back()->withErrors(['jumlah_cuti' => 'Jumlah hari cuti melebihi sisa cuti Anda.']);
        }

        Cuti::create([
            'id_user' => $user->id,
            'jenis_cuti' => $request->jenis_cuti,
            'tanggal_awal' => $tanggalAwal,
            'tanggal_akhir' => $tanggalAkhir,
            'jumlah' => $jumlahHari,
            'status' => 'Pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan cuti berhasil dikirim dan berstatus Pending.');
    }

    public function riwayatCuti(Request $request)
{
    $query = Auth::user()->cuti()->with('jenisCuti');

    // Sorting
    if ($request->has('sort') && in_array($request->sort, ['tanggal_awal', 'tanggal_akhir'])) {
        $query->orderBy($request->sort, 'asc');
    }

    // Pagination
    $riwayatCuti = $query->paginate(10);

    return view('users.history', compact('riwayatCuti'));
}

public function adminCuti($status)
{
    $allowedStatuses = ['Pending', 'Approved', 'Rejected'];
    if (!in_array($status, $allowedStatuses)) {
        abort(404); // Status tidak valid
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

    if ($action === 'approve') {
        // Pastikan hanya update jika status sebelumnya bukan Approved
        if ($cuti->status !== 'Approved') {
            // Kurangi jumlah cuti user
            $user = $cuti->user;
            $user->jumlah_cuti -= $cuti->jumlah;
            $user->save();

            $cuti->status = 'Approved';
        }
    } elseif ($action === 'reject') {
        $cuti->status = 'Rejected';
    }

    $cuti->save();

    return redirect()->back()->with('success', "Cuti berhasil di-{$action}.");
}


}
