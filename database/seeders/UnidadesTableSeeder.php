<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unidad;

class UnidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Datos de ejemplo
        $unidades = [
            [
                'placa' => 'ABC123',
                'nombre_unidad' => 'Unidad 1',
                'tipo' => 'reparto',
                'numero_serie' => '123456789',
                'numero_motor' => '987654321',
                'estado' => 'activo',
                'adicional' => 'Ninguno',
                'sucursal_id' => 1, // ID de la sucursal a la que pertenece
            ],
            [
                'placa' => 'XYZ789',
                'nombre_unidad' => 'Unidad 2',
                'tipo' => 'reparto',
                'numero_serie' => '287654321',
                'numero_motor' => '723456789',
                'estado' => 'activo',
                'adicional' => 'Ninguno',
                'sucursal_id' => 2, // ID de la sucursal a la que pertenece
            ],
            [
                'placa' => 'LFU495',
                'nombre_unidad' => 'Unidad 3',
                'tipo' => 'reparto',
                'numero_serie' => '787654554',
                'numero_motor' => '023955823',
                'estado' => 'activo',
                'adicional' => 'Ninguno',
                'sucursal_id' => 2, // ID de la sucursal a la que pertenece
            ],
            [
                'placa' => 'LFK445',
                'nombre_unidad' => 'Unidad 4',
                'tipo' => 'utilitaria',
                'numero_serie' => '187654539',
                'numero_motor' => '928885823',
                'estado' => 'activo',
                'adicional' => 'Ninguno',
                'sucursal_id' => 1, // ID de la sucursal a la que pertenece
            ],
            [
                'placa' => 'LLV655',
                'nombre_unidad' => 'Unidad 5',
                'tipo' => 'utilitaria',
                'numero_serie' => '927011554',
                'numero_motor' => '223751823',
                'estado' => 'activo',
                'adicional' => 'Ninguno',
                'sucursal_id' => 3, // ID de la sucursal a la que pertenece
            ],
        ];

        // Insertar datos en la tabla
        Unidad::insert($unidades);
    }
}
