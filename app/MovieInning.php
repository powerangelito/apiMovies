<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieInning extends Model
{
    protected $fillable = [
        'id_pelicula', 'id_turno'
    ];
}
