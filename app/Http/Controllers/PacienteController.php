<?php

namespace App\Http\Controllers;

use App\Models\paciente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //Get all, devuelve todos los elementos 
    {
        $pacientes = Paciente::all();
        $response = [
            "status" => 200,
            "message" => "usuarios obtenidos correctamente",
            "data" => $pacientes

        ];
        return response()->json($response, 200);
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

    //Metodo post para crear un registro
    public function store(Request $request)
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
                $paciente = new paciente();
                $paciente->name = $data['name'];
                $paciente->save();
    
                $response = array(
                    'status' => 201,
                    'message' => 'Paciente creado',
                    'paciente' => $paciente
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
    

    /**
     * Display the specified resource.
     */
    public function show(paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(paciente $paciente)
    {
        //
    }
}
