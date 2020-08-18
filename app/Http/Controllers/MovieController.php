<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Exception;
use Log;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAll()
    {
        $movies = Movie::all();

        return response()->json($movies);
    }

    public function add(Request $request)
    {
        try{
            //validate
            if(!$request->get('nombre')){
                return response()->json('Debe de ingresa el nombre', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
            }

            if(!$request->get('fecha_publicacion')){
                return response()->json('Debe de ingresa la fecha de publicacion', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
            }

            if(!$request->get('estado')){
                return response()->json('Debe de ingresa el estado', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
            }
            //save
            $movie = Movie::create($request->all());

            //image
            if($request->file('image')){
                $movie->image = $request->file('image')->store('movies', 'public');
                $movie->save();
            }
            return response()->json("La creación del pelicula fue exitosa el ID es: {$movie->id}", 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getLine());
            Log::error($e->getFile());
            return response()->json("Ocurrieron problemas al agregar una pelicula", 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
    }

    public function get(Movie $id)
    {
        return response()->json($id);
    }

    public function edit(Movie $id, Request $request)
    {
        try{
            //validate
            if(!$request->get('nombre')){
                return response()->json('Debe de ingresa el nombre', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            }

            if(!$request->get('fecha_publicacion')){
                return response()->json('Debe de ingresa la fecha de publicacion', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            }

            if(!$request->get('estado')){
                return response()->json('Debe de ingresa el estado', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            }

            //save
            if($request->get('nombre') != $id->nombre){
                $id->nombre = $request->get('nombre');
            }

            if($request->get('fecha_publicacion') != $id->fecha_publicacion){
                $id->fecha_publicacion = $request->get('fecha_publicacion');
            }

            if($request->get('estado') != $id->estado){
                $id->estado = $request->get('estado');
            }
            $id->save();

            //image
            if($request->file('image')){
                $id->image = $request->file('image')->store('movies', 'public');
                $id->save();
            }
            return response()->json("El ID: {$id->id} se actualizo correctamente", 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getLine());
            Log::error($e->getFile());
            return response()->json("Ocurrieron problemas para editar ID: {$id->id}", 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
    }

    public function delete(Movie $id)
    {
        try{
            $id->estado = 0;
            $id->save();
            return response()->json("La eliminación del ID: {$id->id}, fue correcta", 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
        catch(Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getLine());
            Log::error($e->getFile());
            return response()->json("Ocurrieron problemas para eliminar el ID: {$id->id}", 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
        }
    }
}
