<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaUnidad extends Model
{
    use HasFactory;

    protected $table = 'salidas_unidades'; // Nombre de la tabla
    protected $primaryKey = 'id_salida'; // Clave primaria

    protected $fillable = [
        'fecha_salida',
        'hora_salida',
        'fecha_entrada',
        'hora_entrada',
        'unidad_id',
        'ruta',
        'numero_pedido',
        'se_dirige',
        'conductor',
        'guardia_turno',
        'descripcion_producto',
        'comentarios',
        // 'fotografia_unidad', // Eliminado
    ];

    // Relación con la tabla unidades
    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id', 'id_unidad');
    }
}
