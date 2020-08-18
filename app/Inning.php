<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inning extends Model
{
    protected $fillable = [
        'turno', 'estado'
    ];
}
