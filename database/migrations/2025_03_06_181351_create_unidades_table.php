<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id('id_unidad'); // Primary key autoincremental
            $table->string('placa', 10)->unique(); // Placa de la unidad (única)
            $table->string('nombre_unidad', 100); // Nombre de la unidad
            $table->enum('tipo', ['utilitaria', 'reparto']); // Tipo de unidad
            $table->string('numero_serie', 50)->unique(); // Número de serie (único)
            $table->string('numero_motor', 50)->unique(); // Número de motor (único)
            $table->enum('estado', ['activo', 'inactivo', 'mantenimiento'])->default('activo'); // Estado de la unidad
            $table->text('adicional')->nullable(); // Campo adicional (opcional)
            $table->foreignId('sucursal_id')->constrained('sucursales', 'id_sucursal')->onDelete('cascade'); // Llave foránea
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidades');
    }
}
