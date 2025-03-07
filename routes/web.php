<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Guardia\RepartoController; // Importa el controlador
use App\Http\Controllers\Guardia\DashboardController; // Importa el controlador
// ─────────────────────────────────────────────────────────────────────
// RUTA DE BIENVENIDA
// ─────────────────────────────────────────────────────────────────────
// Página principal accesible para cualquier usuario
Route::get('/', function () {
    return view('welcome');
});

// ─────────────────────────────────────────────────────────────────────
// REDIRECCIÓN SEGÚN EL ROL DEL USUARIO AUTENTICADO
// ─────────────────────────────────────────────────────────────────────
// Esta ruta se ejecuta después del inicio de sesión, redirigiendo
// a los usuarios según su rol.
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        $user = Auth::user();

        switch ($user->role) {
            case \App\Http\Middleware\RoleManager::ROLE_ADMIN:
                return redirect()->route('dashboard');
            case \App\Http\Middleware\RoleManager::ROLE_GUARDIA:
                return redirect()->route('guardia');
            case \App\Http\Middleware\RoleManager::ROLE_RECEPCIONISTA:
                return redirect()->route('recepcionista');
            case \App\Http\Middleware\RoleManager::ROLE_ENCARGADO_SUCURSAL:
                return redirect()->route('encargado_sucursal');
            case \App\Http\Middleware\RoleManager::ROLE_LOGISTICA:
                return redirect()->route('logistica');
            case \App\Http\Middleware\RoleManager::ROLE_MONITORISTA:
                return redirect()->route('monitorista');
            default:
                return redirect()->route('login'); // Si el rol no es válido, redirige a login
        }
    })->name('home');
});

// ─────────────────────────────────────────────────────────────────────
// RUTAS PROTEGIDAS POR AUTENTICACIÓN Y VERIFICACIÓN DE CORREO
// ─────────────────────────────────────────────────────────────────────
// Solo los usuarios autenticados y con correo verificado pueden acceder
Route::middleware(['auth', 'verified'])->group(function () {

    // ─── Ruta para Administradores ────────────────────────────
    Route::get('/admin', function () {
        return view('/usuarios/admin/index');
    })->middleware('rolemanager:admin')->name('dashboard');

    // ─── Ruta para Guardias ───────────────────────────────────
    Route::middleware('rolemanager:guardia')->group(function () {
        Route::get('/guardia', [DashboardController::class, 'index'])->name('guardia');

        // Rutas específicas para el guardia
        // Rutas específicas para el guardia
        Route::get('/guardia/reparto', [RepartoController::class, 'create'])->name('guardia.reparto');
        Route::post('/guardia/reparto', [RepartoController::class, 'store'])->name('guardia.reparto.store');

        Route::get('/guardia/utilitaria', function () {
            return view('/usuarios/guardia/utilitaria');
        })->name('guardia.utilitaria');

        Route::get('/guardia/visita', function () {
            return view('/usuarios/guardia/visita');
        })->name('guardia.visita');
    });

    // ─── Ruta para Recepcionistas ─────────────────────────────
    Route::get('/recepcionista', function () {
        return view('/usuarios/recepcionista/index');
    })->middleware('rolemanager:recepcionista')->name('recepcionista');

    // ─── Ruta para Encargado de sucursal ────────────────────────────
    Route::get('/encargado_sucursal', function () {
        return view('/usuarios/encargado_sucursal/index');
    })->middleware('rolemanager:encargado_sucursal')->name('encargado_sucursal');

    // ─── Ruta para logística ───────────────────────────────────
    Route::get('/logistica', function () {
        return view('/usuarios/logistica/index');
    })->middleware('rolemanager:logistica')->name('logistica');

    // ─── Ruta para monitorista ─────────────────────────────
    Route::get('/monitorista', function () {
        return view('/usuarios/monitorista/index');
    })->middleware('rolemanager:monitorista')->name('monitorista');

    // ─── Rutas de Perfil ──────────────────────────────────────
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ─────────────────────────────────────────────────────────────────────
// INCLUSIÓN DE RUTAS DE AUTENTICACIÓN GENERADAS POR BREEZE
// ─────────────────────────────────────────────────────────────────────
require __DIR__.'/auth.php';
