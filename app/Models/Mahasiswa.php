<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Mahasiswa extends Model
{
    use HasFactory;


    protected $table = 'mahasiswa';
    protected $fillable = ["nama", "email", "nim_nisn", "sekolah_univ", "jurusan", "alamat", "no_telp", "no_guru", "image", "tanggal_masuk", "tanggal_keluar"];
    protected $primaryKey = 'nim_nisn';

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, function ($query, $search) {

            return $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('sekolah_univ', 'like', '%' .  $search . '%')
                ->orWhere('nim_nisn', 'like', '%' .  $search . '%')
                ->orWhere('alamat', 'like', '%' .  $search . '%');
        });
    }

    public function absensi()

    {
        return $this->hasMany(Absensi::class, 'mahasiswa_id');
    }

    public function jurnal()

    {
        return $this->hasMany(Jurnal::class, 'mahasiswa_id');
    }


    public function user()
    {
        return $this->hasOne(User::class, 'mahasiswa_id', 'nim_nisn');
    }
}
