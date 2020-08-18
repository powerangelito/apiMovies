<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inning;
use Exception;
use Log;

class InningController extends Controller
{
    public function getAll()
    {
        $innings = Inning::all();

        return response()->json($innings);
    }

    public function add(Request $request)
    {
        try{
            //validate
            if(! $request->get('turno')){
                return response()->json('Debe de ingresa e turno', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
            }

            if(! $request->get('estado')){
                return response()->json('Debe de ingresa el estado', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
            }
            //save
            $inning = Inning::create($request->all());

            return response()->json("La creación del turno fue exitosa el ID es: {$inning->id}", 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
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

    public function get(Inning $id)
    {
        return response()->json($id);
    }

    public function edit(Inning $id, Request $request)
    {
        try{
            //validate
            if(! $request->get('turno')){
                return response()->json('Debe de ingresa el turno', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            }

            if(! $request->get('estado')){
                return response()->json('Debe de ingresa la estado', 400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
            }

            //save
            if($request->get('turno') != $id->turno){
                $id->turno = $request->get('turno');
            }

            if($request->get('estado') != $id->estado){
                $id->estado = $request->get('estado');
            }
            $id->save();

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

    public function delete(Inning $id)
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
