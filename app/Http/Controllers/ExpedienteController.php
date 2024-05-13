<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreExpedienteRequest;
use App\Http\Requests\UpdateExpedienteRequest;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //Get all, devuelve todos los elementos 
    {
        $expediente = Expediente::all();
        $response = [
            "status" => 200,
            "message" => "Expediente obtenido correctamente",
            "data" => $expediente

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
                $expediente = new Expediente();
                $expediente->name = $data['name'];
                $expediente->save();
    
                $response = array(
                    'status' => 201,
                    'message' => 'Expediente creado',
                    'Expediente' => $expediente
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
    public function show(Expediente $expediente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expediente $expediente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expediente $expediente)
    {
        //
    }
}
