<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    // Nama tabel (default sesuai migration)
    protected $table = 'jabatan';

    // Primary key (default sesuai migration)
    protected $primaryKey = 'id';

    // Atribut yang dapat diisi (fillable)
    protected $fillable = [
        'nama',
    ];

    // Relasi ke tabel Users
    public function users()
    {
        return $this->hasMany(User::class, 'jabatan', 'id');
    }
}
