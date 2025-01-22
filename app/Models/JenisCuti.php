<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'jenis_cuti';

    // Primary key
    protected $primaryKey = 'id';

    // Atribut yang dapat diisi
    protected $fillable = [
        'nama_cuti',
    ];

    // Relasi ke tabel Cuti
    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'jenis_cuti', 'id');
    }
}
