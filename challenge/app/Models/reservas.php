<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservas extends Model
{
    protected $table='reservas';

    protected $fillable=[
        'id',
        'user_id',
        'evento_id',
        'cantidad'
    ];
  
   // relación inversa OneToMany: Una reserva pertenece a un solo evento
   public function evento()
   {
       return $this->belongsTo(EventoModel::class, 'evento_id');
   }

   // relación inversa OneToMany: Una reserva pertenece a un solo usuario
   public function usuario()
   {
       return $this->belongsTo(User::class, 'user_id');
   }
}
