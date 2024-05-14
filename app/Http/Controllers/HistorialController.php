<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historial;
use Illuminate\Support\Facades\Validator;

class HistorialController extends Controller
{
    public function index() //funcion para mostrar todos los datos
    {
        $historial=Historial::all();
        $response = [
            "status" => 200,
            "message" => "Historias medicas obtenidas correctamente",
            "data" => $historial
        ]; 
        return response()->json($response, 200);
    } 

    public function store(request $request)
    {

       $validator= Validator::make($request->all(), 
        [
            'hora' => 'required',
            'presionArterial' => 'required',
            'peso' => 'required',
            'altura' => 'required',
            'temperatura' => 'required',
            'diagnostico' => 'required',
            'idCita' => 'required',
            'idExpediente' => 'required'
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

        $historial = Historial::create(
            [
            'idHistorial' => $request->idHistorial,
            'hora' => $request->hora,
            'presionArterial' => $request->presionArterial,
            'peso' => $request->peso,
            'altura' => $request->altura,
            'temperatura' => $request->temperatura,
            'diagnostico' => $request->diagnostico,
            'idCita' => $request->idCita,
            'idExpediente' => $request->idExpediente
        ]);

        if(!$historial) {
            $data = [
                'message' => 'Error al crear el historial medico',
                'status' => 500
            ];
            return response()->json($data, 500);
        } else {
            $data = [
                'historial' => $historial,
                'status' => 201
            ];
            return response()->json($data, 201);
        }

    }

    public function show($id)
    {
        $historial = Historial::find($id);
        
        if (!$historial) {
            return response()->json(['message' => 'historial no encontrado'], 404);
        }
        
        return response()->json($historial, 200);
    }
   
    public function destroy($id)
    {
        $historial = Historial::find($id);
        
        if (!$historial) {
            return response()->json(['message' => 'Historial no encontrado'], 404);
        }
        
        $historial->delete();

        return response()->json(['message' => 'Historial medico eliminado correctamente'], 200);
    }

    public function update(Request $request, $id)
    {

        $historial = Historial::find($id);

        if(!$historial)
        {
            $data = [
                'message' => 'Historial medico no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator= Validator::make($request->all(), 
        [
            'hora' => 'required',
            'presionArterial' => 'required',
            'peso' => 'required',
            'altura' => 'required',
            'temperatura' => 'required',
            'diagnostico' => 'required'
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

        $historial->hora = $request->hora; 
        $historial->presionArterial = $request->presionArterial; 
        $historial->peso = $request->peso; 
        $historial->altura = $request->altura;
        $historial->temperatura = $request->temperatura;
        $historial->diagnostico = $request->diagnostico; 



        $historial->save();

        $data = [
            'message' => 'Datos del historial medico actualizados.',
            'historial' => $historial,
            'status'=> 200
        ];
        return response()->json($data, 200);
    }
}
