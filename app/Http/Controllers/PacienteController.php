<?php

namespace App\Http\Controllers;

use App\Models\paciente;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() //Get all, devuelve todos los elementos 
    {
        $pacientes = Paciente::with(["expediente"])->get();

        if ($pacientes->isEmpty()) {
            $response = [
                "status" => 200,
                "message" => "El sistema no cuenta con pacientes",

            ];
        } else {
            $response = [
                "status" => 200,
                "message" => "usuarios obtenidos correctamente",
                "data" => $pacientes

            ];
        }


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
        $validator = validator::make($request->all(), [
            "idPaciente" => 'required',
            "cedula" => 'required',
            "nombre" => 'required',
            "edad" => 'required',
            "direccion" => 'required',
            "telefono" => 'required',
            "email" => 'required|email',
            "contrasena" => "required"
        ]);

        if ($validator->fails()) {
            $data = [
                'menssage' => 'error en la validacion de datos',
                'errors ' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }else{
            $Paciente =  paciente::create([
                "idPaciente" => $request -> idPaciente,
                "cedula" => $request -> cedula,
                "nombre" => $request -> nombre,
                "edad" => $request -> edad,
                "direccion" => $request -> direccion,
                "telefono" => $request -> telefono,
                "email" => $request -> email,
                "contrasena" => $request -> contrasena,

            ]);
        }
if ($Paciente) {
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        return 'Id: ' . $id;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //
    }
}
