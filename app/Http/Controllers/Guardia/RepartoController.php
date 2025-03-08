<?php

namespace App\Http\Controllers\Guardia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unidad;
use App\Models\SalidaUnidad;
use Illuminate\Support\Facades\DB;
use Exception;

class RepartoController extends Controller
{
    // Método para mostrar el formulario
    public function create()
    {
        // Filtrar unidades de tipo "reparto"
        $unidadesReparto = Unidad::where('tipo', 'reparto')->get();

        // Pasar las unidades a la vista
        return view('usuarios.guardia.reparto', compact('unidadesReparto'));
    }

    // Método para procesar el formulario
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha_salida' => 'required|date',
            'hora_salida' => 'required',
            'unidad_id_hidden' => 'required|integer|exists:unidades,id_unidad', // Validar como entero
            'ruta' => 'required|string|max:100',
            'numero_pedido' => 'required|string|max:50',
            'se_dirige' => 'required|string|max:100',
            'conductor' => 'required|string|max:100',
            'guardia_turno' => 'required|string|max:100',
            'descripcion_producto' => 'required|string',
            'comentarios' => 'nullable|string',
        ]);

        // Iniciar una transacción de base de datos
        DB::beginTransaction();

        try {
            // Guardar los datos en la tabla salidas_unidades
            SalidaUnidad::create([
                'fecha_salida' => $request->fecha_salida,
                'hora_salida' => $request->hora_salida,
                'unidad_id' => $request->unidad_id_hidden, // Usar el ID del campo oculto
                'ruta' => $request->ruta,
                'numero_pedido' => $request->numero_pedido,
                'se_dirige' => $request->se_dirige,
                'conductor' => $request->conductor,
                'guardia_turno' => $request->guardia_turno,
                'descripcion_producto' => $request->descripcion_producto,
                'comentarios' => $request->comentarios,
            ]);

            // Actualizar el estado de la unidad a "activo"
            $unidad = Unidad::find($request->unidad_id_hidden);
            if ($unidad) {
                $unidad->estado = 'activo';
                $unidad->save();
            }

            // Confirmar la transacción
            DB::commit();

            // Redirigir con mensaje de éxito
            return redirect()->route('guardia.reparto')->with('success', 'Registro de salida guardado correctamente y unidad activada.');
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Redirigir con mensaje de error
            return redirect()->route('guardia.reparto')->with('error', 'Hubo un error al registrar la salida: ' . $e->getMessage());
        }
    }
}
