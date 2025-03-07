<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención de nombres de Laravel)
    protected $table = 'sucursales';

    // Clave primaria (opcional si sigue la convención de nombres de Laravel)
    protected $primaryKey = 'id_sucursal';

    // Campos asignables (mass assignable)
    protected $fillable = [
        'nombre_sucursal', // Campos que se pueden asignar masivamente
    ];

    // Relación con los usuarios
    public function users()
    {
        return $this->hasMany(User::class, 'sucursal_id', 'id_sucursal');
    }
}
