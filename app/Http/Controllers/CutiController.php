<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cuti;
use App\Models\JenisCuti;
use Carbon\Carbon;

class CutiController extends Controller
{
    public function riwayatCuti(Request $request)
    {
        $query = Auth::user()->cuti()->with('jenisCuti');

        if ($request->has('sort') && in_array($request->sort, ['tanggal_awal', 'tanggal_akhir'])) {
            $query->orderBy($request->sort, 'asc');
        }

        $riwayatCuti = $query->paginate(10);

        return view('users.history', compact('riwayatCuti'));
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

        // Set status based on user role
        $status = 'pending';
        $statusManager = 'pending';
        $statusHrd = 'pending';
        
        // If user is a manager, automatically approve at manager level
        if ($user->role === 'manager') {
            $statusManager = 'approved';
            $approvedAtManager = now();
        } else {
            $approvedAtManager = null;
        }

        Cuti::create([
            'id_user' => $user->id,
            'jenis_cuti' => $request->jenis_cuti,
            'tanggal_awal' => $tanggalAwal,
            'tanggal_akhir' => $tanggalAkhir,
            'jumlah' => $jumlahHari,
            'status' => $status,
            'status_manager' => $statusManager,
            'status_hrd' => $statusHrd,
            'approved_at_manager' => $approvedAtManager
        ]);

        $message = $user->role === 'manager' 
            ? 'Pengajuan cuti berhasil dikirim ke HRD.' 
            : 'Pengajuan cuti berhasil dikirim. Cek History Untuk Lihat Hasil.';

        return redirect()->back()->with('success', $message);
    }

    public function adminCuti($status = 'pending')
    {
        $user = auth()->user();
        $query = Cuti::with([
            'user' => function ($query) {
                $query->with('departemen');
            },
            'jenisCuti'
        ]);

        // Filter based on user role and status
        if ($user->role === 'manager') {
            // For managers: only show cuti from their department
            $query->whereHas('user', function($q) use ($user) {
                $q->where('departemen_id', $user->departemen_id);
            });
            
            if ($status === 'pending') {
                $query->where('status_manager', 'pending');
            } elseif ($status === 'approved') {
                $query->where('status_manager', 'approved');
            } elseif ($status === 'rejected') {
                $query->where('status_manager', 'rejected');
            }
        } elseif ($user->role === 'hrd') {
            if ($status === 'pending') {
                $query->where('status_manager', 'approved')
                      ->where('status_hrd', 'pending');
            } elseif ($status === 'approved') {
                $query->where('status_hrd', 'approved');
            } elseif ($status === 'rejected') {
                $query->where('status_hrd', 'rejected');
            }
        }

        $daftarCuti = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.cuti.index', compact('daftarCuti', 'status'));
    }

    public function updateCuti(Request $request, $id)
    {
        $cuti = Cuti::findOrFail($id);
        $action = $request->action;
        $notes = $request->input('notes', null);
        $user = auth()->user();
        $now = now();

        if ($action === 'reject' && !$notes) {
            return redirect()->back()->with('error', 'Catatan harus diisi jika pengajuan ditolak.');
        }

        $employee = $cuti->user;

        if ($action === 'approve') {
            if ($user->role === 'manager' && $cuti->status_manager === 'pending') {
                $cuti->status_manager = 'approved';
                $cuti->approved_at_manager = $now;
                $cuti->notes_manager = null;
            } elseif ($user->role === 'hrd' && $cuti->status_manager === 'approved' && $cuti->status_hrd === 'pending') {
                $cuti->status_hrd = 'approved';
                $cuti->approved_at_hrd = $now;
                $cuti->notes_hrd = null;
            }
        } elseif ($action === 'reject') {
            // Kembalikan jumlah cuti jika ditolak
            $employee->jumlah_cuti += $cuti->jumlah;
            $employee->save();
            
            if ($user->role === 'manager') {
                $cuti->status_manager = 'rejected';
                $cuti->notes_manager = $notes;
            } elseif ($user->role === 'hrd') {
                $cuti->status_hrd = 'rejected';
                $cuti->notes_hrd = $notes;
            }
        }

        // Update overall status
        if ($cuti->status_manager === 'rejected' || $cuti->status_hrd === 'rejected') {
            $cuti->status = 'rejected';
        } elseif ($cuti->status_manager === 'approved' && $cuti->status_hrd === 'approved') {
            $cuti->status = 'approved';
        } else {
            $cuti->status = 'pending';
        }

        $cuti->save();

        return redirect()->back()->with('success', "Cuti berhasil di-{$action}.");
    }
}
