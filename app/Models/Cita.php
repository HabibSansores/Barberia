<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cita extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre_cliente',
        'telefono',
        'email',
        'servicio',
        'barbero',
        'fecha',
        'hora',
        'estado'
    ];

    protected $dates = ['deleted_at'];
}
