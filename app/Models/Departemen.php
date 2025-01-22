<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    // Nama tabel (default sesuai migration)
    protected $table = 'departemen';

    // Primary key (default sesuai migration)
    protected $primaryKey = 'id';

    // Atribut yang dapat diisi (fillable)
    protected $fillable = [
        'nama',
    ];

    // Relasi ke tabel Users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Fungsi custom: Pencarian departemen berdasarkan nama
    public static function searchByName($name)
    {
        return self::where('nama', 'LIKE', '%' . $name . '%')->get();
    }
}