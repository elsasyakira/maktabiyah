<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['umat_id', 'user_id', 'status', 'ket', 'pengisi', 'tempat', 'bulan'];

    public function tausiyah()
    {
        return $this->belongsTo(Tausiyah::class, 'umat_id');
    }

    public function umat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
