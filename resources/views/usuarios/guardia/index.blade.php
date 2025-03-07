<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio Guardia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <!-- Mostrar las unidades pendientes en cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                        @foreach ($unidadesPendientes as $salida)
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <h3 class="text-xl font-semibold mb-2">
                                    {{ $salida->unidad->nombre_unidad }} ({{ $salida->unidad->placa }})
                                </h3>
                                <p class="text-gray-600">
                                    <strong>Fecha de salida:</strong> {{ $salida->fecha_salida }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Hora de salida:</strong> {{ $salida->hora_salida }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Conductor:</strong> {{ $salida->conductor }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Ruta:</strong> {{ $salida->ruta }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Número de pedido:</strong> {{ $salida->numero_pedido }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Se dirige a:</strong> {{ $salida->se_dirige }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Guardia en turno:</strong> {{ $salida->guardia_turno }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Descripción del producto:</strong> {{ $salida->descripcion_producto }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Comentarios:</strong> {{ $salida->comentarios }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
