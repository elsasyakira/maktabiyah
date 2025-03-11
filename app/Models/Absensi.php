<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'tanggal', 'name', 'status', 'ket', 'umat_id', 'user_id'];

    public function umat() {
        return $this->belongsTo(Umat::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
