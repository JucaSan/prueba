<?php
namespace App\Http\Controllers\Guardia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalidaUnidad;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Filtrar las salidas de unidades que no tienen fecha de entrada
        // y que pertenecen a la sucursal del usuario
        $unidadesPendientes = SalidaUnidad::whereNull('fecha_entrada')
            ->whereHas('unidad', function ($query) use ($user) {
                $query->where('sucursal_id', $user->sucursal_id);
            })
            ->with('unidad') // Cargar la relación con la unidad
            ->get();

        // Pasar las unidades pendientes a la vista
        return view('usuarios.guardia.index', compact('unidadesPendientes'));
    }

    public function finalizarRuta(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'unidad_id' => 'required|integer|exists:unidades,id_unidad',
            'fecha_entrada' => 'required|date',
            'hora_entrada' => 'required',
            'comentarios' => 'nullable|string',
        ]);

        // Buscar la salida de la unidad
        $salidaUnidad = SalidaUnidad::where('unidad_id', $request->unidad_id)
            ->whereNull('fecha_entrada')
            ->first();

        if ($salidaUnidad) {
            // Actualizar la fecha y hora de entrada
            $salidaUnidad->update([
                'fecha_entrada' => $request->fecha_entrada,
                'hora_entrada' => $request->hora_entrada,
                'comentarios' => $request->comentarios,
            ]);

            // Cambiar el estado de la unidad a "inactivo"
            $salidaUnidad->unidad->update(['estado' => 'inactivo']);

            return response()->json(['success' => 'Ruta finalizada correctamente.']);
        }

        return response()->json(['error' => 'No se encontró la unidad o ya fue finalizada.'], 404);
    }
}