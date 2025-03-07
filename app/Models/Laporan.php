<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'laporan',
        'user_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
