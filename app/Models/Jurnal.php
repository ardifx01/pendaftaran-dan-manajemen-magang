<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $fillable = ['id','mahasiswa_id','tanggal','hari','kegiatan'];
    protected $table = 'jurnal';


    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, function ($query, $search) {
         
    
            return $query->whereDate('tanggal', 'like', '%' . $search . '%')
                ->orWhere('kegiatan', 'like', '%' . $search . '%')
                ->orWhere('hari', 'like', '%' . $search . '%');
     
        });
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'nim_nisn');
    }


}
