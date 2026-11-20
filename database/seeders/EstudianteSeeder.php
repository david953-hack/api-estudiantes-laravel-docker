<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('estudiantes')->insert([
            [
                'nombre' => 'Ana Pérez',
                'correo' => 'ana@example.com',
                'programa' => 'Ingeniería de Sistemas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Carlos Gómez',
                'correo' => 'carlos@example.com',
                'programa' => 'Administración de Empresas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Laura Rodríguez',
                'correo' => 'laura@example.com',
                'programa' => 'Contaduría Pública',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Andrés Martínez',
                'correo' => 'andres@example.com',
                'programa' => 'Ingeniería Industrial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sofía Torres',
                'correo' => 'sofia@example.com',
                'programa' => 'Psicología',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
