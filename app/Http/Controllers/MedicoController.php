<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Medico;
use Illuminate\Support\Facades\Validator;

class MedicoController extends Controller
{
    public function index() //funcion para mostrar todos los datos
    {
        $medico=Medico::all();
        $response = [
            "status" => 200,
            "message" => "Medicos obtenidos correctamente",
            "data" => $medico
        ]; 
        return response()->json($response, 200);
    } 

    public function store(request $request)
    {

       $validator= Validator::make($request->all(), 
        [
            'numColegiado' => 'required',
            'cedula' => 'required',
            'nombre' => 'required',
            'especialidad' => 'required',
            'telefono' => 'required',
            'email' => 'required | email'
        ]);

        if ($validator->fails())
        {
            $data = 
            [
                'message' => 'Error en la validacion de los datos',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $medico = Medico::create(
            [
            'numColegiado' => $request->numColegiado,
            'cedula' => $request->cedula,
            'nombre' => $request->nombre,
            'especialidad' => $request->especialidad,
            'telefono' => $request->telefono,
            'email' => $request->email
        ]);

        if(!$medico) {
            $data = [
                'message' => 'Error al crear el registro de Medico',
                'status' => 500
            ];
            return response()->json($data, 500);
        } else {
            $data = [
                'medico' => $medico,
                'status' => 201
            ];
            return response()->json($data, 201);
        }

    }

    public function show($id)
    {
        $medico = Medico::find($id);
        
        if (!$medico) {
            return response()->json(['message' => 'medico no encontrado'], 404);
        }
        
        return response()->json($medico, 200);
    }
   
    public function destroy($id)
    {
        $medico = medico::find($id);
        
        if (!$medico) {
            return response()->json(['message' => 'Medico no encontrado'], 404);
        }
        
        $medico->delete();

        return response()->json(['message' => 'Medico eliminado correctamente'], 200);
    }

    public function update(Request $request, $id)
    {

        $medico = Medico::find($id);

        if(!$medico)
        {
            $data = [
                'message' => 'Medico no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator= Validator::make($request->all(), 
        [
            'numColegiado' => 'required',
            'cedula' => 'required',
            'nombre' => 'required',
            'especialidad' => 'required',
            'telefono' => 'required',
            'email' => 'required | email'
        ]);
        if ($validator->fails())
        {
            $data = 
            [
                'message' => 'Error en la validacion de los datos',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $medico->numColegiado = $request->numColegiado;
        $medico->cedula = $request->cedula; 
        $medico->nombre = $request->nombre; 
        $medico->especialidad = $request->especialidad; 
        $medico->telefono = $request->telefono;
        $medico->email = $request->email; 

        $medico->save();

        $data = [
            'message' => 'Datos del medico actualizados.',
            'medico' => $medico,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
}


