<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MovieInning;
use App\Movie;
use App\Inning;

class MovieInnginsController extends Controller
{
    public function getAll()
    {
        $turns = MovieInning::all();

        return response()->json($turns);
    }

    public function assign(Movie $movie, Inning $innign)
    {
        if($movie->estado == 0){
            return response()->json('La pelicula no puede ser asigna ya que esta desactivada', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
    JSON_UNESCAPED_UNICODE);
        }

        if($innign->estado == 0){
            return response()->json('El turno no puedo ser asignado ya que esta desactivado', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
    JSON_UNESCAPED_UNICODE);
        }

        try {
            $where = [
                'id_pelicula' => $movie->id,
                'id_turno' => $innign->id
            ];

            $getAssign = MovieInning::where($where)->first();
            if($getAssign){
                return response()->json('El turno no pude repetirse para la misma pelicula', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
    JSON_UNESCAPED_UNICODE);
            }

            $assign = MovieInning::create([
                'id_pelicula' => $movie->id,
                'id_turno' => $innign->id
            ]);

            return response()->json("La asignación se realizo correctamente con el ID: {$assign->id}", 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getLine());
            Log::error($e->getFile());
            return response()->json("Ocurrio un problema al realizar la asignación del turno de la pelicula {$movie->id}", 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
    }
}
