<?php

namespace App\Http\Controllers\Guardia; // Namespace actualizado

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
}
