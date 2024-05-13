<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expedientes = Expediente::all();

        if ($expedientes->isEmpty()) {
            $response = [
                "status" => 200,
                "message" => "El sistema no cuenta con expedientes",
            ];
        } else {
            $response = [
                "status" => 200,
                "message" => "Expedientes obtenidos correctamente",
                "data" => $expedientes
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
            "idExpediente" => 'required',
            "tipoSangre" => 'required',
            "alergia" => 'required', // Corregido el nombre del campo
            "padecimiento" => 'required',
            "medicamento" => 'required',
            "PacienteID" => 'required|exists:paciente,idPaciente' // Validar que el PacienteID existe en la tabla de pacientes
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $expediente = Expediente::create([
            "idExpediente" => $request->idExpediente,
            "tipoSangre" => $request->tipoSangre,
            "alergia" => $request->alergia,
            "padecimiento" => $request->padecimiento,
            "medicamento" => $request->medicamento,
            "PacienteID" => $request->PacienteID
        ]);

        return response()->json([
            'message' => 'Expediente creado correctamente',
            'expediente' =>  $expediente,
            'status' => 201
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $expediente = Expediente::find($id);

        if (!$expediente) {
            return response()->json(['message' => 'Expediente no encontrado'], 404);
        }

        return response()->json($expediente, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $expediente = Expediente::find($id);

        if (!$expediente) {
            return response()->json(['message' => 'Expediente no encontrado'], 404);
        }

        $expediente->delete();

        return response()->json(['message' => 'Expediente eliminado correctamente'], 200);
    }
}
