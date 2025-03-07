<x-app-layout>
    <x-slot name="header">
        <h2 class="header__title">
            {{ __('Registrar entrada de unidad visita') }}
        </h2>
    </x-slot>

    <div class="form-utilitaria">
        <form method="POST" action="{{ route('login') }}" class="form-unidades" enctype="multipart/form-data">
            @csrf

            <!-- Título del formulario -->
            <h2 class="form-unidades__title">{{ __('Registro de entrada de unidades de visita') }}</h2>

            <!-- Contenedor de dos columnas -->
            <div class="form-unidades__columns">
                <!-- Columna izquierda -->
                <div class="form-unidades__column">
                    <!-- Fecha de entrada (automática) -->
                    <div class="form-group">
                        <label for="fecha_entrada" class="form-group__label">{{ __('Fecha de entrada') }}</label>
                        <input id="fecha_entrada" class="form-group__input" type="date" name="fecha_entrada" required readonly />
                    </div>

                    <!-- Hora de entrada (automática y en tiempo real) -->
                    <div class="form-group">
                        <label for="hora_entrada" class="form-group__label">{{ __('Hora de entrada') }}</label>
                        <input id="hora_entrada" class="form-group__input" type="text" name="hora_entrada" required readonly />
                    </div>

                    <!-- Unidad -->
                    <div class="form-group">
                        <label for="auto" class="form-group__label">{{ __('Auto') }}</label>
                        <input id="auto" class="form-group__input" type="text" name="auto" required placeholder="Número de unidad" />
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="form-unidades__column">
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

                    <!-- Visita Sucursal (Sí/No) -->
                    <div class="form-group">
                        <label for="VisitaSucursal" class="form-group__label">{{ __('Visita Sucursal') }}</label>
                        <select id="VisitaSucursal" class="form-group__input" name="VisitaSucursal" required>
                            <option value="Sí">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Fotografía de la unidad (múltiples imágenes, máximo 5) -->
            <div class="form-group">
                <label for="fotografia_identificacion" class="form-group__label">{{ __('Fotografía de identificación') }}</label>
                <input id="fotografia_identificacion" class="form-group__input" type="file" name="fotografia_identificacion" accept="image" required />
            </div>

            <!-- Descripción de producto saliente -->
            <div class="form-group">
                <label for="observaciones" class="form-group__label">{{ __('Observaciones') }}</label>
                <textarea id="observaciones" class="form-group__input form-group__input--textarea" name="observaciones" rows="3" placeholder=""></textarea>
            </div>

            <!-- Botones al final del formulario -->
            <div class="form-buttons">
                <button type="submit" class="form-buttons__btn form-buttons__btn--submit">
                    {{ __('Enviar') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Incluye SweetAlert2 y html5-qrcode -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/completar_campos.js')}}"></script>
</x-app-layout>