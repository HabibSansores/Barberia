<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
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
}
