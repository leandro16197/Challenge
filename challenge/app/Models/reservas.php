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
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function evento()
    {
        return $this->belongsTo(eventoModel::class);
    }
}
