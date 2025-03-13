<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'nip'; 
    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                         ->orWhere('nip', 'like', '%' . $search . '%')
                         ->orWhere('alamat', 'like', '%' . $search . '%')
                         ->orWhereHas('devisi', function ($subquery) use ($search) {
                             $subquery->where('nama_devisi', 'like', '%' . $search . '%');
                         });
        });
        
    }

    public function user()
    {
        return $this->hasOne(User::class, 'admin_id', 'nip');
    }




    public function devisi()
    {
        return $this->belongsTo(Devisi::class);
    }

  
    
}
