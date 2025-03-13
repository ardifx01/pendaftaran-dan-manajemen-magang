<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $dates = ['tanggal'];
    protected $fillable = ['mahasiswa_id', 'status', 'keterangan', 'tanggal', 'jam', 'hari'];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, function ($query, $search) {
         
    
            return $query->whereDate('tanggal', 'like', '%' . $search . '%')
                ->orWhere('hari', 'like', '%' . $search . '%')
                ->orWhere('keterangan', 'like', '%' . $search . '%')
                ->orWhere('status', 'like', '%' . $search . '%');
        });
    }



    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'nim_nisn');
    }
}
