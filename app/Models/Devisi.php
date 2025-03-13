<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devisi extends Model
{
    use HasFactory;

    protected $table = 'devisi';
    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {  
        $query->when($filters['search'] ?? false, function ($query, $search) {

            return $query->where('nama_devisi', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' .  $search . '%');
        });
    }

    public function admin()   
    {
        return $this->hasMany(Admin::class);
    }

}
