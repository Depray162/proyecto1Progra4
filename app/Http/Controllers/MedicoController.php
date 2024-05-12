<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Medico;

class MedicoController extends Controller
{
    public function idex() //funcion para mostrar todos los datos
    {
        $medicos=Medico::all();
        $response = [
            "status" => 200,
            "message" => "Medicos obtenidos correctamente",
            "data" => $medicos
        ]; 
        return response()->json($response, 200);
    } 

    public function store(request $request)
    {
        $data_input = $request->input('data', null);
    
        if ($data_input) {
            $data = json_decode($data_input, true);
            $data = array_map('trim', $data);
            $rules = [
                'name' => 'required|alpha' //validar que los datos que se están ingresando sean string
            ];
            $isValid = \validator($data, $rules);
    
            if (!$isValid->fails()) {
                $medico = new medico();
                $medico->name = $data['name'];
                $medico->save();
    
                $response = array(
                    'status' => 201,
                    'message' => 'Medico creado',
                    'medico' => $medico
                );
            } else {
                $response = array(
                    'status' => 406,
                    'message' => 'Datos inválidos',
                    'errors' => $isValid->errors()
                );
            }
        } else {
            $response = array(
                'status' => 400,
                'message' => 'No se encontró el objeto data'
            );
        }
    
        return response()->json($response, $response['status']);
    }


    public function show($id)
    {
        $data=Medico::find($id);
        if(is_object($data)){
            $data=$data->load('citas');
            $response = array(
                'status' => 200,
                'message' => 'Datos del Medico',
                'medico' => $data
            );
        } else $response = array(
            'status' => 404,
            'message' => 'No se encontró el Medico'
        );
        return response()->json($response,$response['status']);
    }

    public function destroy ($id)
    {
        if(isset($id)){
            $delete=Medico::where('id', $id)->delete();
            if($delete)
            {
                $response = array(
                    'status' => 200,
                    'message' => 'Medico eliminado',
                    'medico' => $data
                );
            } else $response = array(
                'status' => 400,
                'message' => 'No se pudo eliminar el Medico, compruebe si existe.'
            );
        } else $response = array(
            'status' => 406,
            'message' => 'Falta el identificador del Medico'
        );

        return response()->json($response,$response['status']);
    }
}

