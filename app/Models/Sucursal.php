<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales'; // Nombre de la tabla
    protected $primaryKey = 'id_sucursal'; // Clave primaria

    protected $fillable = [
        'nombre_sucursal', // Campos asignables
    ];
}
