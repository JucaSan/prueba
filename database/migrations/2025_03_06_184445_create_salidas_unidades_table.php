<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidasUnidadesTable extends Migration
{
    public function up()
    {
        Schema::create('salidas_unidades', function (Blueprint $table) {
            $table->id('id_salida'); // Primary key autoincremental
            $table->date('fecha_salida'); // Fecha de salida
            $table->time('hora_salida'); // Hora de salida
            $table->date('fecha_entrada')->nullable(); // Fecha de entrada (puede ser nulo)
            $table->time('hora_entrada')->nullable(); // Hora de entrada (puede ser nulo)
            $table->foreignId('unidad_id')->constrained('unidades', 'id_unidad')->onDelete('cascade'); // Llave foránea a la tabla unidades
            $table->string('ruta', 100); // Ruta asignada
            $table->string('numero_pedido', 50); // Número de pedido
            $table->string('se_dirige', 100); // Destino
            $table->string('conductor', 100); // Nombre del conductor
            $table->string('guardia_turno', 100); // Guardia en turno
            $table->text('descripcion_producto'); // Descripción del producto
            $table->text('comentarios')->nullable(); // Comentarios (puede ser nulo)
            $table->json('fotografia_unidad')->nullable(); // Rutas de las imágenes (almacenadas como JSON)
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('salidas_unidades');
    }
}
