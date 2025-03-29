<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';

    protected $fillable = [
        'id_user',
        'tanggal_awal',
        'tanggal_akhir',
        'jumlah',
        'jenis_cuti',
        'status',
        'status_manager',
        'status_hrd',
        'approved_at_manager',
        'approved_at_hrd',
        'notes_manager',
        'notes_hrd',
    ];

    protected $casts = [
        'tanggal_awal' => 'date',
        'tanggal_akhir' => 'date',
        'approved_at_manager' => 'datetime',
        'approved_at_hrd' => 'datetime',
    ];

    // Relasi ke tabel Users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke tabel JenisCuti
    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class, 'jenis_cuti');
    }

    // Relasi ke tabel Departemen melalui user
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id', 'id')
            ->whereHas('user', function ($query) {
                $query->where('id', $this->id_user);
            });
    }

    // Filter data cuti berdasarkan status
    public static function filterByStatus($status)
    {
        return self::where('status', $status)->get();
    }

    // Mengurangi jumlah cuti user saat pengajuan
    public static function applyCuti($userId, $jenisCutiId, $tanggalAwal, $tanggalAkhir)
    {
        $user = User::find($userId);

        if (!$user) {
            return ['success' => false, 'message' => 'User tidak ditemukan'];
        }

        $jumlahHari = (new \Carbon\Carbon($tanggalAwal))->diffInDays(new \Carbon\Carbon($tanggalAkhir)) + 1;

        if ($user->jumlah_cuti >= $jumlahHari) {
            // Kurangi jumlah cuti user
            $user->jumlah_cuti -= $jumlahHari;
            $user->save();

            // Simpan pengajuan cuti
            self::create([
                'id_user' => $userId,
                'jenis_cuti' => $jenisCutiId,
                'tanggal_awal' => $tanggalAwal,
                'tanggal_akhir' => $tanggalAkhir,
                'jumlah' => $jumlahHari,
                'status' => 'Pending',
                'status_manager' => 'pending',
                'status_hrd' => 'pending',
                'approved_at_manager' => null,
                'approved_at_hrd' => null,
            ]);

            return ['success' => true, 'message' => 'Pengajuan cuti berhasil'];
        }

        return ['success' => false, 'message' => 'Jumlah hari cuti tidak mencukupi'];
    }

    // Helper method untuk mengecek status approval
    public function isApprovedByManager(): bool
    {
        return $this->status_manager === 'approved';
    }

    public function isApprovedByHRD(): bool
    {
        return $this->status_hrd === 'approved';
    }

    public function isRejectedByManager(): bool
    {
        return $this->status_manager === 'rejected';
    }

    public function isRejectedByHRD(): bool
    {
        return $this->status_hrd === 'rejected';
    }

    public function isPendingManagerApproval(): bool
    {
        return $this->status_manager === 'pending';
    }

    public function isPendingHRDApproval(): bool
    {
        return $this->status_manager === 'approved' && $this->status_hrd === 'pending';
    }

    public function updateStatus()
    {
        if ($this->status_manager === 'rejected' || $this->status_hrd === 'rejected') {
            $this->status = 'rejected';
        } elseif ($this->status_manager === 'approved' && $this->status_hrd === 'approved') {
            $this->status = 'approved';
        } else {
            $this->status = 'pending';
        }
    }
}
