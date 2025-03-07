<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Datos de ejemplo
        $sucursales = [
            ['nombre_sucursal' => 'Sucursal Central'],
            ['nombre_sucursal' => 'Sucursal Norte'],
            ['nombre_sucursal' => 'Sucursal Sur'],
        ];

        // Insertar datos en la tabla
        foreach ($sucursales as $sucursal) {
            Sucursal::create($sucursal);
        }
    }
}
