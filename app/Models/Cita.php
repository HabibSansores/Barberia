<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cita extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cliente_id',
        'barber_id',
        'service_id',
        'nombre_cliente',
        'telefono',
        'email',
        'servicio',
        'barbero',
        'fecha',
        'hora',
        'estado',
        'motivo_cancelacion'
    ];

    protected $dates = ['deleted_at'];

    public function client()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function barber()
    {
        return $this->belongsTo(User::class, 'barber_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}

