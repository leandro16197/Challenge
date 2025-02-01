<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class eventoModel extends Model
{
    protected $table='evento';

    protected $fillable=[
        'nombre',
        'description',
        'fecha_evento',
        'capacidad_maxima'
    ];

    // relación OneToMany: Un evento tiene muchas reservas
    public function reservas()
    {
        return $this->hasMany(Reservas::class, 'evento_id');
    }

    // relación ManyToMany con User
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'reservas', 'evento_id', 'user_id')
                    ->withPivot('cantidad','id') 
                    ->withTimestamps();
    }
}
