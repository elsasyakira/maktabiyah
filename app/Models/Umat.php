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

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
