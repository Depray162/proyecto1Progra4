<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

use App\Models\paciente;
use App\Models\Medico;

class JwtAuth
{
    private $key;

    function __construct()
    {
        $this->key = "wasdxyz02468auuu";
    }

    public function getTokenPac($cedula, $contrasena)
    {
        $paciente = paciente::where(['cedula' => $cedula, 'contrasena' => hash('sha256', $contrasena)])->first();

        if (is_object($paciente)) {
            $token = array(
                'iss' => $paciente->idPaciente,
                'cedula' => $paciente->cedula,
                'nombre' => $paciente->nombre,
                'tipo' => 'paciente',
                'exp' => time() + (1200000) //Equivale a 20 minutos
            );
            $response = JWT::encode($token, $this->key, 'HS256');
        } else {
            $response = array(
                'message' => 'Datos de autentificacion incorrectos',
                'status' => 401,
            );
        }
        return $response;
    }

    public function verifyTokenPac($jwt, $getId = false)
    {
        $authFlag = false;

        if (isset($jwt)) {
            try {
                $decoded = JWT::decode($jwt, new Key($this->key, 'HS256'));
            } catch (\DomainException $ex) {
                $authFlag = false;
            } catch (ExpiredException $ex) {
                $authFlag = false;
            }
            if (!empty($decoded) && is_object($decoded) && isset($decoded->iss) && $decoded->tipo == 'paciente') {
                $authFlag = true;
            }
            if ($getId && $authFlag) {
                return $decoded;
            }
        }
        return $authFlag;
    }

    public function getTokenMed($cedula, $contrasena)
    {
        $medico = Medico::where(['cedula' => $cedula, 'contrasena' => hash('sha256', $contrasena)])->first();

        if (is_object($medico)) {
            $token = array(
                'iss' => $medico->idMedico,
                'cedula' => $medico->cedula,
                'nombre' => $medico->nombre,
                'tipo' => 'medico',
                'exp' => time() + (1200000) //Equivale a 20 minutos
            );
            $response = JWT::encode($token, $this->key, 'HS256');
        } else {
            $response = array(
                'message' => 'Datos de autentificación incorrectos',
                'status' => 401,
            );
        }
        return $response;
    }

    public function verifyTokenMed($jwt, $getId = false)
    {
        $authFlag = false;

        if (isset($jwt)) {
            try {
                $decoded = JWT::decode($jwt, new Key($this->key, 'HS256'));
            } catch (\DomainException $ex) {
                $authFlag = false;
            } catch (ExpiredException $ex) {
                $authFlag = false;
            }
            if (!empty($decoded) && is_object($decoded) && isset($decoded->iss) && $decoded->tipo == 'medico') {
                $authFlag = true;
            }
            if ($getId && $authFlag) {
                return $decoded;
            }
        }
        return $authFlag;
    }
}
