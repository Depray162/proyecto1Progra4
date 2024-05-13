<?php

namespace App\Http\Controllers;

use App\Models\cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CitaController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = cita::all();

        if ($citas->isEmpty()) {
            $response = [
                'message' => 'Citas no existentes',
                'status' => 200
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Citas obtenidas correctamente',
                'status' => 200,
                'data' => $citas
            ];
            return response()->json($response, 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'motivo' => 'required',
            'area' => 'required',
            'fechaSolicitud' => 'required',
            'fechaCita' => 'required',
            'horaCita' => 'required',
            'idPaciente' => 'exist',
            'idMedico'=> 'exist',
        ]);

        if ($validator->fails()) {
            $response = [
                'message' => 'Error al validar los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($response, 400);
        }

        $cita = cita::create([
            'motivo' => $request->motivo,
            'area' => $request->area,
            'fechaSolicitud' => $request->fechaSolicitud,
            'fechaCita' => $request->fechaCita,
            'horaCita' => $request->horaCita,
        ]);

        if (!$cita) {
            $response = [
                'message' => 'Error al crear la cita',
                'status' => 500,
            ];
            return response()->json($response, 500);
        }

        $response = [
            'message' => 'Cita creada correctamente',
            'cita' => $cita,
            'status' => 201
        ];
        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cita = cita::find($id);

        if (!$cita) {
            $response = [
                'message' => 'Cita no encontrada',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $response = [
            'message' => 'Cita encontrada correctamente',
            'cita' => $cita,
            'status' => 200
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cita = cita::find($id);

        if (!$cita) {
            $response = [
                'message' => 'Cita no encontrada',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $validator = Validator::make($request->all(), [
            'motivo' => 'required',
            'area' => 'required',
            'fechaSolicitud' => 'required',
            'fechaCita' => 'required',
            'horaCita' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'message' => 'Error al validar los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($response, 400);
        }

        $cita->motivo = $request->motivo;
        $cita->area = $request->area;
        $cita->fechaSolicitud = $request->fechaSolicitud;
        $cita->fechaCita = $request->fechaCita;
        $cita->horaCita = $request->horaCita;

        $cita->save();

        $response = [
            'message' => 'Cita actualizada correctamente',
            'cita' => $cita,
            'status' => 200
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cita = cita::find($id);

        if (!$cita) {
            $response = [
                'message' => 'Cita no encontrada',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $cita->delete();

        $response = [
            'message' => 'Cita eliminada correctamente',
            'status' => 200
        ];
        return response()->json($response, 200);
    }
}
