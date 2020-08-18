<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'nombre', 'fecha_publicacion', 'image', 'estado'
    ];
}
