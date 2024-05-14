<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use Illuminate\Support\Facades\Validator;
use App\Helpers\JwtAuth;
use \Firebase\JWT\JWT;

class MedicoController extends Controller
{
    public function index()
    {
        $medico = Medico::with(["citas"])->get();

        if (count($medico) === 0) {
            $response = [
                "status" => 200,
                "message" => "El sistema no cuenta con medicos",
            ];
        } else {
            $response = [
                "status" => 200,
                "message" => "Usuarios obtenidos correctamente",
                "data" => $medico
            ];
        }

        return response()->json($response, 200);
    }

    public function store(request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'numColegiado' => 'required',
                'cedula' => 'required',
                'nombre' => 'required',
                'especialidad' => 'required',
                'telefono' => 'required',
                'email' => 'required | email',
                'contrasena' => 'required'
            ]
        );

        if ($validator->fails()) {
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
                'email' => $request->email,
                'contrasena' => $request->contrasena
            ]
        );

        if (!$medico) {
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
        $medico = Medico::with(["citas"])->where("idMedico", "=", $id)->first();

        if (!$medico) {
            return response()->json(['message' => 'Medico no encontrado'], 404);
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

        if (!$medico) {
            $data = [
                'message' => 'Medico no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make(
            $request->all(),
            [
                'numColegiado' => 'required',
                'cedula' => 'required',
                'nombre' => 'required',
                'especialidad' => 'required',
                'telefono' => 'required',
                'email' => 'required | email',
                'contrasena' => 'required'
            ]
        );
        if ($validator->fails()) {
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
        $medico->contrasena = $request->contrasena;

        $medico->save();

        $data = [
            'message' => 'Datos del medico actualizados.',
            'medico' => $medico,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function loginMed(Request $request)
    {
        $rules = ['cedula' => 'required', 'contrasena' => 'required'];
        $isValid = validator($request->all(), $rules);

        if (!$isValid->fails()) {
            $jwt =  new JwtAuth();
            $response = $jwt->getTokenMed($request->cedula, $request->contrasena);
            return response()->json($response);
        } else {
            $response = array(
                'message' => 'Error al validar los datos',
                'errors' => $isValid->errors(),
                'status' => 406,
            );
            return response()->json($response, 406);
        }
    }


    public function verCitas(Request $request)
    {
        // Obtener el token JWT del encabezado de la solicitud
        $token = $request->bearerToken();

        // Verificar si se proporcionó un token
        if (!$token) {
            return response()->json(['error' => 'Token no proporcionado'], 401);
        }

        try {
            $options = new \stdClass();
            $options->algorithms = ['HS256'];
            
            $decoded = JWT::decode($token, env('JWT_SECRET'), $options);

            // Verificar si el payload contiene la cédula del médico
            if (!isset($decoded->cedulaMedico)) {
                return response()->json(['error' => 'No se encontró la cédula del médico en el token'], 401);
            }

            // Obtener la cédula del médico del payload
            $cedulaMedico = $decoded->cedulaMedico;

            // Ahora puedes usar $cedulaMedico en tu consulta para obtener las citas del médico
            // Supongamos que tienes un modelo de Cita y quieres obtener todas las citas para este médico
            $cita = Medico::where('cedulaMedico', $cedulaMedico)->get();

            // Devolver las citas como respuesta
            return response()->json($cita);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        }
    }
}
