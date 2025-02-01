<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class imgModel extends Model
{

    protected $table = 'fondo_ims';
    protected $fillable = ['imagen_path'];
}
