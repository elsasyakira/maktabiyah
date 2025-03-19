<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tausiyah extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'umat_id', 'holaqoh', 'name'];

    public function umat()
    {
        return $this->belongsTo(Umat::class);
    }
}
