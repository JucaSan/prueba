<x-app-layout>
    <x-slot name="header">
        <h2 class="header__title">
            {{ __('Registrar salida de unidad reparto') }}
        </h2>
    </x-slot>

    <div class="form-utilitaria">
        <form method="POST" action="{{ route('guardia.reparto.store') }}" class="form-unidades" enctype="multipart/form-data">
            @csrf

            <!-- Título del formulario -->
            <h2 class="form-unidades__title">{{ __('Registro de salida de unidades') }}</h2>

            <!-- Contenedor de dos columnas -->
            <div class="form-unidades__columns">
                <!-- Columna izquierda -->
                <div class="form-unidades__column">
                    <!-- Fecha de salida (automática) -->
                    <div class="form-group">
                        <label for="fecha_salida" class="form-group__label">{{ __('Fecha de salida') }}</label>
                        <input id="fecha_salida" class="form-group__input" type="date" name="fecha_salida" required readonly />
                    </div>

                    <!-- Hora de salida (automática y en tiempo real) -->
                    <div class="form-group">
                        <label for="hora_salida" class="form-group__label">{{ __('Hora de salida') }}</label>
                        <input id="hora_salida" class="form-group__input" type="text" name="hora_salida" required readonly />
                    </div>

                    <!-- Unidad -->
                    <div class="form-group">
                        <label for="unidad_id" class="form-group__label">{{ __('Unidad') }}</label>
                        <select id="unidad_id" class="form-group__input" name="unidad_id" required>
                            <option value="">Seleccione una unidad</option>
                            @foreach ($unidadesReparto as $unidad)
                                <option value="{{ $unidad->id_unidad }}">{{ $unidad->nombre_unidad }} - {{ $unidad->placa }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ruta -->
                    <div class="form-group">
                        <label for="ruta" class="form-group__label">{{ __('Ruta') }}</label>
                        <input id="ruta" class="form-group__input" type="text" name="ruta" required placeholder="Ruta asignada" />
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="form-unidades__column">
                    <!-- Número de pedido -->
                    <div class="form-group">
                        <label for="numero_pedido" class="form-group__label">{{ __('Número de pedido') }}</label>
                        <input id="numero_pedido" class="form-group__input" type="text" name="numero_pedido" required placeholder="Número de pedido" />
                    </div>

                    <!-- Se dirige -->
                    <div class="form-group">
                        <label for="se_dirige" class="form-group__label">{{ __('Se dirige') }}</label>
                        <input id="se_dirige" class="form-group__input" type="text" name="se_dirige" required placeholder="Destino" />
                    </div>

                    <!-- Conductor -->
                    <div class="form-group">
                        <label for="conductor" class="form-group__label">{{ __('Conductor') }}</label>
                        <input id="conductor" class="form-group__input" type="text" name="conductor" required placeholder="Nombre del conductor" />
                    </div>

                    <!-- Guardia en turno -->
                    <div class="form-group">
                        <label for="guardia_turno" class="form-group__label">{{ __('Guardia en turno') }}</label>
                        <input id="guardia_turno" class="form-group__input" type="text" name="guardia_turno" required placeholder="Nombre del guardia" />
                    </div>
                </div>
            </div>

            <!-- Fotografía de la unidad (múltiples imágenes, máximo 5) -->
            <div class="form-group">
                <label for="fotografia_unidad" class="form-group__label">{{ __('Fotografía de la unidad') }}</label>
                <input id="fotografia_unidad" class="form-group__input" type="file" name="fotografia_unidad[]" accept="image/*" multiple required />
                <small class="form-group__text">{{ __('Puedes subir hasta 5 imágenes.') }}</small>
            </div>

            <!-- Descripción de producto saliente -->
            <div class="form-group">
                <label for="descripcion_producto" class="form-group__label">{{ __('Descripción de producto saliente') }}</label>
                <textarea id="descripcion_producto" class="form-group__input form-group__input--textarea" name="descripcion_producto" rows="3" placeholder="Descripción del producto"></textarea>
            </div>
            <div class="form-group">
                <label for="comentarios" class="form-group__label">{{ __('Comentarios') }}</label>
                <textarea id="comentarios" class="form-group__input form-group__input--textarea" name="comentarios" rows="3" placeholder="Escribe cualquier observacion adicional ejemplo: Viene otro conductor" ></textarea>
            </div>

            <!-- Botones al final del formulario -->
            <div class="form-buttons">
                <button type="button" class="form-buttons__btn form-buttons__btn--scan" id="btn-scan">
                    {{ __('Escanear automóvil') }}
                </button>
                <button type="submit" class="form-buttons__btn form-buttons__btn--submit">
                    {{ __('Enviar') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Incluye SweetAlert2 y html5-qrcode -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>

    <!-- Modal para agregar número de pedido -->
<div class="modal">
    <div class="modal__overlay">
        <div class="modal__content">
            <h3 class="modal__title">Agregar Número de Pedido</h3>

            <!-- Lista de pedidos agregados -->
            <ul class="modal__list">
                <!-- Los pedidos se agregarán aquí dinámicamente -->
            </ul>

            <!-- Formulario para agregar un nuevo pedido -->
            <form class="modal__form" onsubmit="event.preventDefault(); agregarPedido();">
                <div class="modal__form-group">
                    <label for="nuevo_pedido" class="modal__label">Número de Pedido</label>
                    <input type="text" id="nuevo_pedido" class="modal__input" placeholder="Ingrese el número de pedido" pattern="\d+" title="Solo se permiten números" required />
                </div>
                <div class="modal__buttons">
                    <button type="button" onclick="cerrarModal()" class="modal__button modal__button--cancel">Cancelar</button>
                    <button type="button" onclick="finalizar()" class="modal__button modal__button--submit">Finalizar</button>
                    <button type="submit" class="modal__button modal__button--submit">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/pedidos.js')}}"></script>
<script src="{{asset('js/qr.js')}}"></script>

</x-app-layout>
