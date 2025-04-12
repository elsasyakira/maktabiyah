<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nas',
        'syubah',
        'holaqoh',
        'farah',
    ];

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'umat_id');
    }

    public function tausiyahs() 
    {
        return $this->hasMany(Tausiyah::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
