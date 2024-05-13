<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::with(["expediente"])->get();

        if (count($pacientes) === 0) {
            $response = [
                "status" => 200,
                "message" => "El sistema no cuenta con pacientes",
            ];
        } else {
            $response = [
                "status" => 200,
                "message" => "Usuarios obtenidos correctamente",
                "data" => $pacientes
            ];
        }

        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "cedula" => 'required|unique:paciente',
            "nombre" => 'required',
            "edad" => 'required',
            "direccion" => 'required',
            "telefono" => 'required',
            "email" => 'required|email',
            "contrasena" => "required"
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $paciente = Paciente::create([
            "cedula" => $request->cedula,
            "nombre" => $request->nombre,
            "edad" => $request->edad,
            "direccion" => $request->direccion,
            "telefono" => $request->telefono,
            "email" => $request->email,
            "contrasena" => $request->contrasena,
        ]);

        if (!$paciente) {
            $data = [
                'message' => 'Error al guardar el paciente',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'Paciente creado correctamente',
            'paciente' =>  $paciente,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paciente = Paciente::find($id);
        
        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }
        
        return response()->json($paciente, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paciente = Paciente::find($id);
        
        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }
        
        $paciente->delete();

        return response()->json(['message' => 'Paciente eliminado correctamente'], 200);
    }
}
