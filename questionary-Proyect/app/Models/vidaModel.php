<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vidaModel extends Model
{   
    protected $table='vidas';
    protected $fillable = [
        'id','vidas','user_id','max_vidas','last_updated' 
    ];
}
