<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidades'; // Nombre de la tabla
    protected $primaryKey = 'id_unidad'; // Clave primaria

    protected $fillable = [
        'placa',
        'nombre_unidad',
        'tipo',
        'numero_serie',
        'numero_motor',
        'estado',
        'adicional',
        'sucursal_id', // Llave foránea
    ];

    public $timestamps = false; // Desactiva los timestamps

    // Relación con la tabla sucursales
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id', 'id_sucursal');
    }
}
