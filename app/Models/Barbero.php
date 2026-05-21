<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barbero extends Model
{
    use HasFactory;

    protected $table = 'barberos';

    protected $fillable = [
        'user_id',
        'especialidad',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
