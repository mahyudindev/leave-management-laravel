<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';


    protected $primaryKey = 'id';


    protected $fillable = [
        'id_user',
        'tanggal_awal',
        'tanggal_akhir',
        'jumlah',
        'jenis_cuti',
        'ket',
        'status',
    ];

    // Relasi ke tabel Users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi ke tabel JenisCuti
    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class, 'jenis_cuti', 'id');
    }

    // Filter data cuti berdasarkan status
    public static function filterByStatus($status)
    {
        return self::where('status', $status)->get();
    }

    // Pengajuan cuti: Kurangi jumlah cuti di User
    public function applyCuti($jumlahCuti)
    {
        $user = $this->user; // Relasi ke User
        if ($user->jumlah_cuti >= $jumlahCuti) {
            $user->jumlah_cuti -= $jumlahCuti;
            $user->save();

            $this->jumlah = $jumlahCuti;
            $this->status = 'Pending';
            $this->save();

            return true; // Berhasil
        }

        return false; // Gagal, jumlah cuti tidak cukup
    }
}
