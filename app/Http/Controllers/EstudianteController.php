<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    // Consultar todos los estudiantes
    public function index()
    {
        $estudiantes = Estudiante::all();

        return response()->json([
            'mensaje' => 'Lista de estudiantes',
            'datos' => $estudiantes
        ], 200);
    }

    // Registrar un nuevo estudiante
    public function store(Request $request)
    {
        $datosValidados = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:estudiantes,correo',
            'programa' => 'required|string|max:255',
        ]);

        $estudiante = Estudiante::create($datosValidados);

        return response()->json([
            'mensaje' => 'Estudiante registrado correctamente',
            'datos' => $estudiante
        ], 201);
    }

    // Consultar un estudiante por su ID
    public function show($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            return response()->json([
                'mensaje' => 'Estudiante no encontrado'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Estudiante encontrado',
            'datos' => $estudiante
        ], 200);
    }
}
