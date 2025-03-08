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
                                {{-- <p class="text-gray-600">
                                    <strong>Ruta:</strong> {{ $salida->ruta }}
                                </p> --}}
                                <p class="text-gray-600">
                                    <strong>Número de pedido:</strong> {{ $salida->numero_pedido }}
                                </p>
                                {{-- <p class="text-gray-600">
                                    <strong>Se dirige a:</strong> {{ $salida->se_dirige }}
                                </p> --}}
                                <p class="text-gray-600">
                                    <strong>Guardia en turno:</strong> {{ $salida->guardia_turno }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Descripción del producto:</strong> {{ $salida->descripcion_producto }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Comentarios:</strong> {{ $salida->comentarios }}
                                </p>

                                <button type="button" onclick="abrirModal()" class="modal__button modal__button--submit">Terminar ruta</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Modal para agregar número de pedido -->
   <div class="modal" id="miModal">
    <div class="modal__overlay">
        <div class="modal__content">
            <h3 class="modal__title">Registrar Regreso</h3>
            <h4 class="modal__unidad" id="nombre-unidad">{{ __(' ') }}</h4>
            <!-- Formulario para agregar un nuevo pedido -->
            <form class="modal__form" onsubmit="event.preventDefault();">
                <input id="unidad_id_hidden_inicio" type="hidden" name="unidad_id_hidden" />
                <div class="modal__form-group">
                    <label for="fecha_entrada_i" class="modal__label">Fecha a la que regresa la unidad</label>
                    <input type="text" id="fecha_entrada_inicio" class="modal__input" placeholder="" pattern="\d+"  disabled required />
                </div>
                <div class="modal__form-group">
                    <label for="hora_entrada_i" class="modal__label">Hora a la que regresa la unidad</label>
                    <input type="text" id="hora_entrada_inicio" class="modal__input" placeholder="" pattern="\d+"  disabled required />
                </div>
                <div class="modal__form-group">
                    <label for="comentarios" class="modal__label">Comentarios</label>
                    <textarea type="text" id="comentarios" class="modal__input" placeholder="Escribe aquí cualquier información u observación adicional" pattern="\d+"   ></textarea>
                </div>

                <div class="modal__buttons">
                    <button type="button" onclick="cerrarModal()" class="modal__button modal__button--cancel">Cancelar</button>
                    <button type="submit" class="modal__button modal__button--submit" id="btn-scan_inicio">Escanear</button>
                    <button type="button" onclick="finalizar()" class="modal__button modal__button--submit">Finalizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{asset('js/modal_inicio.js')}}"></script>
<script src="https://unpkg.com/html5-qrcode"></script>
<script src="{{asset('js/qr.js')}}"></script>


</x-app-layout>
