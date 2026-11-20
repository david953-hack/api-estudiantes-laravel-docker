<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EstudianteController;

// Verificar conexión con la base de datos
Route::get('/health', function () {
    try {
        DB::connection()->getPdo();

        return response()->json([
            'status' => 'ok',
            'database' => 'connected'
        ], 200);

    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'database' => 'disconnected'
        ], 503);
    }
});

// Listar todos los estudiantes
Route::get('/estudiantes', [EstudianteController::class, 'index']);

// Registrar un estudiante
Route::post('/estudiantes', [EstudianteController::class, 'store']);

// Consultar un estudiante por ID
Route::get('/estudiantes/{id}', [EstudianteController::class, 'show']);
